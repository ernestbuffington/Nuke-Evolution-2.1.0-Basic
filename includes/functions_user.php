<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   #$#BASE
 Nuke-Evo Version       :   #$#VER
 Nuke-Evo Build         :   #$#BUILD
 Nuke-Evo Patch         :   #$#PATCH
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   #$#DATE

 Copyright (c) 2010 by The Nuke Evolution Development Team
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS "NOT" ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE "NOT" ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

/**
 * Get a user's field from the DB
 *
 * @author JeFFb68CAM
 *
 * @param string $field_name The field to retrieve
 * @param string $user Username or User_id
 * @param bool $is_name Is the $user a username
 * @return string
 */
// recoded by ReOrGaNiSaTiOn
// This function is called by mainfile.php to fill $userinfo
// and from other files to get specific informations about an user
// it makes no sense to cache all users (maybe this can be thousands)
// but for actual page we can make the informations static
function get_user_field($field_name, $user, $is_name = false) {
    global $db;
    static $actual_user;
    if (!$user) return NULL;

    if ($is_name || !is_numeric($user))  {
        $where  = "`username` = '".str_replace("\'", "''", $user)."'";
        $search = 'username';
    } else {
        $where  = "`user_id` = '".$user."'";
        $search = 'user_id';
    }
    if (!isset($actual_user[$user])) {
        $sql = "SELECT * FROM "._USERS_TABLE." WHERE $where";
        $actual_user[$user] = $db->sql_ufetchrow($sql);
        // We also put the groups data in the array.
        $result = $db->sql_query('SELECT g.group_id, g.group_name, g.group_single_user FROM ('.GROUPS_TABLE.' AS g INNER JOIN '.USER_GROUP_TABLE.' AS ug ON (ug.group_id=g.group_id AND ug.user_id="'.$actual_user[$user]['user_id'].'" AND ug.user_pending=0))', true);
        while (list($g_id, $g_name, $single) = $db->sql_fetchrow($result)) {
            $actual_user[$user]['groups'][$g_id] = ($single) ? '' : $g_name;
        }
        $db->sql_freeresult($result);
    }
    if (!isset($actual_user[$user]['user_id'])) {
        return NULL;
    }
    $actual_user[$user]['user_ip'] = identify::get_ip();
    $actual_user[$user]['user_email_dec'] = encode_mail($actual_user[$user]['user_email']);
    if($field_name == '*') {
        return $actual_user[$user];
    }
    if(is_array($field_name)) {
        $data = array();
        foreach($field_name as $fld) {
            $data[$fld] = $actual_user[$user][$fld];
        }
        return $data;
    }
    return $actual_user[$user][$field_name];
}

/**
 * Gets a admin field from the DB
 *
 * @author JeFFb68CAM
 *
 * @param string $field_name The field to get
 * @param string $admin The admin name/aid
 * @return string
 */
function get_admin_field($field_name, $admin) {
    global $db, $debugger;
    static $fields = array();
    if (!$admin) {
        return array();
    }

    if(!isset($fields[$admin]) || !is_array($fields[$admin])) {
        $fields[$admin] = $db->sql_ufetchrow("SELECT * FROM "._AUTHOR_TABLE." WHERE `aid` = '" .  str_replace("\'", "''", $admin) . "'");
    }

    if($field_name == '*') {
        return $fields[$admin];
    }
    if(is_array($field_name)) {
        $data = array();
        foreach($field_name as $fld) {
            $data[$fld] = $fields[$admin][$fld];
        }
        return $data;
    }

    return $fields[$admin][$field_name];
}

/**
 * Checks to see if a user is a module admin
 *
 * @author Quake
 *
 * @param string $module_name Module name
 * @return bool
 */
function is_mod_admin($module_name='super') {

    global $db, $aid, $admin, $_GETVAR;
    static $auth = array();

    if(!is_admin()) return 0;
    if (is_god_admin()) { return TRUE; }
    if(isset($auth[$module_name])) return $auth[$module_name];

    if(!isset($aid)) {
        if(!is_array($admin)) {
            $aid = base64_decode($admin);
            $aid = explode(":", $aid);
            $aid = $aid[0];
        } else {
            $aid = $admin[0];
        }
    }
    $admdata = get_admin_field('*', $aid);
    $auth_user = 0;
    $module_name = $_GETVAR->fixQuotes($module_name);
    if($module_name != 'super') {
        list($admins) = $db->sql_ufetchrow("SELECT `admins` FROM "._MODULES_TABLE." WHERE `title`='$module_name'");
        $adminarray = explode(",", $admins);
        for ($i=0, $maxi=count($adminarray); $i < $maxi; $i++) {
            if ((isset($admdata['aid']) && ($admdata['aid'] == $adminarray[$i])) && !empty($admins)) {
                $auth_user = 1;
            }
        }
    }
    $auth[$module_name] = (((isset($admdata['radminsuper']) && $admdata['radminsuper'] == 1) || $auth_user == 1) ? TRUE : FALSE);
    return $auth[$module_name];

}

/**
 * Get all admins for a module
 *
 * @author ReOrGaNiSaTiOn (based on is_mod_admin from Quake)
 *
 * @param string $module_name Module name
 * super = only Superuser
 * module_name = only Admins with privileges for this module
 * all with module_name = Superuser + Module-Admins
 * @return array of admin-names with email-address by default only Superuser
 */
function get_mod_admins($module_name='super', $all='') {

    global $db, $_GETVAR;
    static $admins = array();


    if ( $all =='') {
        if(isset($admins[$module_name])) {return $admins[$module_name];}
    }

    if($module_name == 'super' || $all != '') {
        $result1 = $db->sql_query("SELECT `aid`, `email` FROM `"._AUTHOR_TABLE."` WHERE `radminsuper`='1'");
        $num = 0;
        while (list($admin, $email) = $db->sql_fetchrow($result1)) {
            $admins[$module_name][$num]['aid'] = $admin;
            $admins[$module_name][$num]['email'] = $email;
            $num++;
        }
        $db->sql_freeresult($result1);
    }
    $module_name = $_GETVAR->fixQuotes($module_name);
    if($module_name != 'super') {
        list($admin) = $db->sql_ufetchrow("SELECT `admins` FROM `"._MODULES_TABLE."` WHERE `title`='".$module_name."'");
        $adminarray = explode(",", $admin);
        $num = ($all !='') ? $num : 0;
        for ($i=0, $maxi=count($adminarray); $i < $maxi; $i++) {
            $row = $db->sql_fetchrow($db->sql_query("SELECT `aid`, `email` FROM `"._AUTHOR_TABLE."` WHERE `aid`='".$adminarray[$i]."'"));
            if (!empty($row['aid'])) {
                $admins[$module_name][$num]['aid'] = $row['aid'];
                $admins[$module_name][$num]['email'] = $row['email'];
            }
            $num++;
        }
    }
    return (isset($admins[$module_name]) ? $admins[$module_name] : array());
}

function check_priv_mess($user_id) {
    global $db;
    if (empty($user_id) || !is_numeric($user_id)) {
        return FALSE;
    }
    $pms = $db->sql_ufetchrow("SELECT COUNT(privmsgs_id) as no FROM ".PRIVMSGS_TABLE." WHERE privmsgs_to_userid='".$user_id."' AND (privmsgs_type='5' OR privmsgs_type='1')");
    return $pms['no'];
}

// avatar_resize function by JeFFb68CAM (based off phpBB mod)
// recoded & removed cache-function and added static variable (ReOrGaNiSaTiOn)
function avatar_resize($avatar_url) {
    global $evoconfig;
    static $loaded_avatars;
    if(!isset($loaded_avatars[$avatar_url])) {
        $loaded_avatars[$avatar_url] = array();
        list($avatar_width, $avatar_height) = @getimagesize($avatar_url);
        if ($avatar_width > $evoconfig['avatar_max_width'] && $avatar_height <= $evoconfig['avatar_max_height']) {
            $cons_width  = $evoconfig['avatar_max_width'];
            $cons_height = round((($evoconfig['avatar_max_width'] * $avatar_height) / $avatar_width), 0);
        }
        elseif($avatar_width <= $evoconfig['avatar_max_width'] && $avatar_height > $evoconfig['avatar_max_height']) {
            $cons_width  = round((($evoconfig['avatar_max_height'] * $avatar_width) / $avatar_height), 0);
            $cons_height = $evoconfig['avatar_max_height'];
        }
        elseif($avatar_width > $evoconfig['avatar_max_width'] && $avatar_height > $evoconfig['avatar_max_height']) {
            if($avatar_width >= $avatar_height) {
                $cons_width = $evoconfig['avatar_max_width'];
                $cons_height = round((($evoconfig['avatar_max_width'] * $avatar_height) / $avatar_width), 0);
            }
            elseif($avatar_width < $avatar_height) {
                $cons_width = round((($evoconfig['avatar_max_height'] * $avatar_width) / $avatar_height), 0);
                $cons_height = $evoconfig['avatar_max_height'];
            }
        } else {
            $cons_width = $avatar_width;
            $cons_height = $avatar_height;
        }
        $width  = (empty($cons_width) ? '' : 'width="'.$cons_width.'"');
        $height = (empty($cons_height) ? '' : 'height="'.$cons_height.'"');
        $loaded_avatars[$avatar_url] = '<img src="' . $avatar_url . '" '.$width.' '.$height.' alt="" border="0" />';
    }
    return $loaded_avatars[$avatar_url];
}

// GetRank function by ReOrGaNiSaTiOn
function GetRank($user_id) {
    global $db, $evoconfig, $userinfo;
    static $rankData;
    static $ranks;

    if(is_array($rankData) && (isset($rankData[$user_id]) && !empty($rankData[$user_id]))) { return $rankData[$user_id]; }
    if ( $user_id == $userinfo['user_id'] ) {
         $user_rank  = $userinfo['user_rank'];
         $user_posts = $userinfo['user_posts'];
    } else {
        list($user_rank, $user_posts) = $db->sql_ufetchrow("SELECT user_rank, user_posts FROM "._USERS_TABLE." WHERE user_id = '" . $user_id . "' LIMIT 1");
    }
    if ( !is_array($ranks) || empty($ranks) ) {
        $ranks  = array();
        $result = $db->sql_query("SELECT * FROM ".RANKS_TABLE." ORDER BY rank_min DESC");
        while ( $row = $db->sql_fetchrow($result) ) {
            $ranks[$row['rank_id']] = $row;
        }
        $db->sql_freeresult($result);
    }
    $rankData[$user_id] = array();
    if ( (isset($ranks[$user_rank]['rank_id']) && ($user_rank == $ranks[$user_rank]['rank_id'])) && isset($ranks[$user_rank]['rank_special']) ) {
        $rankData[$user_id]['image'] = ($ranks[$user_rank]['rank_image']) ? '<img src="'.NUKE_HREF_BASE_DIR .$ranks[$user_rank]['rank_image'].'" alt="'.$ranks[$user_rank]['rank_title'].'" title="'.$ranks[$user_rank]['rank_title'].'" border="0" />' : '';
        $rankData[$user_id]['title'] = $ranks[$user_rank]['rank_title'];
        $rankData[$user_id]['id'] = $ranks[$user_rank]['rank_id'];
        return $rankData[$user_id];
    } else {
        foreach ( $ranks as $row ) {
            if ($user_posts >= $row['rank_min'] && !$row['rank_special']) {
                $rankData[$user_id]['image'] = ($row['rank_image']) ? '<img src="'.NUKE_HREF_BASE_DIR .$row['rank_image'].'" alt="'.$row['rank_title'].'" title="'.$row['rank_title'].'" border="0" />' : '';
                $rankData[$user_id]['title'] = $row['rank_title'];
                $rankData[$user_id]['id'] = $row['rank_id'];
                return $rankData[$user_id];
            }
        }
    }
    return array();
}

// GetAvatar function by ReOrGaNiSaTiOn
function GetAvatar($user_id) {
    global $db, $evoconfig, $userinfo, $userwork, $mode;
    static $avatarData;

    if(is_array($avatarData) && (isset($avatarData[$user_id]) && !empty($avatarData[$user_id])) ) { return $avatarData[$user_id]; }
    if ( $user_id == $userinfo['user_id'] && !defined('IN_PROFILE') ) {
         $user_avatar       = $userinfo['user_avatar'];
         $user_avatar_type  = $userinfo['user_avatar_type'];
         $user_avatar_allow = $userinfo['user_allowavatar'];
         $user_avatar_show  = $userinfo['user_showavatars'];
    } elseif (defined('IN_ADMIN_USERS') || (defined('IN_PROFILE') && $mode != 'viewprofile')) {
         $user_avatar       = $userwork['user_avatar'];
         $user_avatar_type  = $userwork['user_avatar_type'];
         $user_avatar_allow = $userwork['user_allowavatar'];
         $user_avatar_show  = $userwork['user_showavatars'];
    } else {
         $row = $db->sql_ufetchrow("SELECT user_avatar, user_avatar_type, user_allowavatar, user_showavatars FROM "._USERS_TABLE." WHERE user_id = '" . $user_id . "' LIMIT 1");
         $user_avatar       = $row['user_avatar'];
         $user_avatar_type  = $row['user_avatar_type'];
         $user_avatar_allow = $row['user_allowavatar'];
         $user_avatar_show  = $row['user_showavatars'];
    }
    $poster_avatar = '';
    if ( $user_id != ANONYMOUS && $user_avatar_allow && $user_avatar_show && !empty($user_avatar)) {
        switch( $user_avatar_type ) {
            case USER_AVATAR_UPLOAD:
                $poster_avatar = ( $evoconfig['allow_avatar_upload'] ) ? avatar_resize($evoconfig['avatar_path'] . '/' . $user_avatar) : '';
                break;
            case USER_AVATAR_REMOTE:
                $poster_avatar = avatar_resize($user_avatar);
                break;
            case USER_AVATAR_GALLERY:
                $poster_avatar = ( $evoconfig['allow_avatar_local'] ) ? avatar_resize($evoconfig['avatar_gallery_path'] . '/' . $user_avatar) : '';
                break;
        }
    }
    $default_member_avatar = evo_image('avatar_member.png', 'Forums');
    $default_guest_avatar  = evo_image('avatar_guest.png', 'Forums');
    if ( empty($poster_avatar) && $user_id != ANONYMOUS) {
        $poster_avatar = '<img src="'.  $default_member_avatar .'" alt="" border="0" />';
    }
    if ( $user_id == ANONYMOUS ) {
        $poster_avatar = '<img src="'.  $default_guest_avatar .'" alt="" border="0" />';
    }
    $avatarData[$user_id] = $poster_avatar;
    return ($poster_avatar);
}

// add_group_attributes
/**
 * centralized function for stripping or adding group informations to an user
 * must be called AFTER the group or colorgroup is added into database !!
 *
 * @access private
 * @param
 *      user_id     = ID of the user where the action has to be done
 *      group_id    = UserGroup or ColorGroup the user is added or a change has been done
 *      loop        = internal variable for calling function itself
 *      only_color  = if only Usercolor informations should be changed
 *      is_color_group  = is given group_id an usergroup id or an colorgroup id
 *      is_remove   = is this function called from remove_group_attributes
 * @return array
 */

function add_group_attributes($user_id=0, $group_id=0, $loop=0, $only_color=0, $is_color_group=0, $is_remove=0, $is_update=0) {
    global $db, $evoconfig;

    if ( (($user_id == 0) && ($group_id == 0)) || ($user_id == ANONYMOUS)) {
        return false; // Nothing have to be done
    }
    if ($is_color_group) {
        // Let's get the colorgroup informations of the group we are working on
        $row_color = $db->sql_ufetchrow("SELECT `group_weight`, `group_color`, `group_id` FROM `".AUC_TABLE."` WHERE `group_id` = '".$group_id."'");
        if ($row_color['group_id'] < 0) {
            $row_color['group_weight'] = 999999;
        }
    } else {
        // We have to add users to a usergroup. So let's select all users from this group
        $row_group = $db->sql_ufetchrowset("SELECT `user_id` FROM `".USER_GROUP_TABLE."` WHERE `group_id`=".$group_id." AND `user_pending`=0");
        if (count($row_group < 1)) {
            // We didn't find anything, so return
            return FALSE;
        }
    }
    if ( (!$is_color_group) && ($user_id == 0) && ($group_id >= 0) && ($loop == 1)) {
        foreach ($row as $key => $row_group) {
            // go into a loop for all found users
            add_group_attributes($row['user_id'], $group_id, 0, $only_color, 0, 0);
        }
    } else if ( (!$is_color_group) && ($user_id >= 0) && ($group_id >=0)) {
        // We have a specific user where we have to change usergroup_attributes
        // To store the correct color, we must know all groups, the user is in and from those groups
        // the one with the highest priority from Colortable
        $row_color = $db->sql_ufetchrow("SELECT `bbauc`.`group_id`, `bbauc`.`group_color`, `bbauc`.`group_weight`
                        FROM `".AUC_TABLE."` AS `bbauc`
                        LEFT JOIN `".GROUPS_TABLE."` AS `bbg` ON `bbg`.`group_color` = `bbauc`.`group_id`
                        LEFT JOIN `".USER_GROUP_TABLE."` AS `bbug` ON `bbug`.`group_id` = `bbg`.`group_id`
                        WHERE `bbug`.`user_id` = '".$user_id."'
                        ORDER BY `bbauc`.`group_weight`
                        ASC LIMIT 0,1");
        if (!$only_color) {
            $sql_rank = "SELECT `group_rank` FROM `".GROUPS_TABLE."` WHERE `group_id` = '".$group_id."'";
            $row_rank = $db->sql_ufetchrow($sql_rank);
        } else {
            $row_rank['group_rank'] = '';
        }
        $sqlrg = '';
        if(!empty($row_rank['group_rank'])) {
            $sqlrg .= "`user_rank` = '".$row_rank['group_rank']."'";
        }
        if(!empty($row_color['group_color'])) {
            $sqlrg .= (empty($sqlrg) ? '' : ', ');
            $sqlrg .= "`user_color_gc` = '".$row_color['group_color']."',
                  `user_color_gi`  = CONCAT(`user_color_gi`, '--".$group_id."--')";
        }
        if (!empty($sqlrg)) {
            $db->sql_uquery("UPDATE `"._USERS_TABLE."` SET " . $sqlrg . " WHERE user_id = " . $user_id);
        }
        if ($loop != 0) {
            return true;
        }
    } elseif ( ($is_color_group) && ($user_id >= 0) && ($group_id >= 0) && ($loop == 0)) {
         $sqlrg = '';
         $dup   = FALSE;
         $hhg   = FALSE;
         $check_group = '';
         $group_weight  = 999999;
        // We have to add an user to a colorgroup or change his values.
        // We have to look if the given colorgroup has a higher priority than
        // a colorgroup the user allready is a member of
        // does the user have a color or is he a member of a colorgroup ?
        $row_user  = $db->sql_ufetchrow("SELECT `user_color_gc`, `user_color_gi` FROM `".USERS_TABLE."` WHERE `user_id`= '".$user_id."'");
        if (!empty($row_user['user_color_gi'])) {
            // there are informations about colorgroups the user is a member of
            $colors = explode('----', $row_user['user_color_gi']);
            $count_colors  = count($colors);
            $color_highest = '';
            $check_group   = '';
            $is_inside     = FALSE;
            for ($i=0; $i < $count_colors; $i++) {
                $colgroup = str_replace('-', '', $colors[$i]);
                // what we do here is to check, if user_color_gi is correct
                // maybe there could be an group inside (by accident or by manual change of database)
                // which doesn't exist any longer
                $is_group = $db->sql_ufetchrow("SELECT `group_weight`, `group_color`, `group_id` FROM `".AUC_TABLE."` WHERE `group_id` = '".$colgroup."'");
                if ($is_group['group_id'] > 0) {
                    $color_highest .= (empty($color_highest) ? $colgroup : ', '.$colgroup);
                    $check_group .= '--'.$colgroup.'--';
                    if ( $is_group['group_weight'] < $group_weight ) {
                        $temp_color['group_weight'] = $is_group['group_weight'];
                        $temp_color['group_color']  = $is_group['group_color'];
                        $temp_color['group_id']     = $is_group['group_id'];
                        $group_weight               = $is_group['group_weight'];
                    }
                    if ($group_id == $colgroup) {
                        $is_inside = TRUE;
                    }
                }
            }
            if (!empty($color_highest)) {
                $uhgc = $temp_color['group_color'];
                $uhcw = $group_weight;
                $hhg  = TRUE;
            } else {
                // We got no informations about a valid colorgroup
                $uhcw = 0;
                $hhg  = FALSE;
            }
        } else {
            // The user isn't a member of any colorgroup
            $uhcw = 0;
            $hhg  = FALSE;
            $is_inside = FALSE;
            if ($is_remove) {
                $temp_color['group_color'] = '';
                $row_user['user_color_gc'] = '';
                $check_group = '';
                $uhgc = '';
            }
        }
        if (!$is_inside) {
            $check_group = (!empty($check_group) ? $check_group.($is_remove ? '' : '--'.$group_id.'--') : ($is_remove ? '' : '--'.$group_id.'--'));
        } else {
            $check_group = (!empty($check_group) ? $check_group : ($is_remove ? '' : '--'.$group_id.'--'));
        }
        // OK, we now have the highest colorweight from usertable
        // if uhcw = 0 - the user isn't a member of an actual existing colorgroup (maybe by accident)
        // The only one check left now - is the actual color higher than the group adding or changing
        if ($is_update) {
            // We only have to take highest colorweigt we looked for before
            $dup = TRUE;
            $sqlrg = "`user_color_gc` = '".$uhgc."'";
        } elseif (!$hhg || $row_color['group_weight'] < $uhcw) {
            // The colorgroup we are working on has a higher priority
            // or we got on the check against existing groups no valid return
            // so we set the user to the color of the colorgroup we are working on
            $dup = TRUE;
            // even too, we have to add our colorgroup
            // if we gone through the check we have either existing valid colorgroups or an empty variable
            $sqlrg = "`user_color_gc` = '".($is_remove ? $uhgc : $row_color['group_color'])."',
                      `user_color_gi` = '".$check_group."'";
        } else {
            // the actual user colorgroup has a higher priority so we normally shouldn't change the user_color_gc
            // but in older installations there could be a failure - so we better have a look at
            // there were some sql-statements which slows down the thing, but really, how offen do we change the colorgroup ?
            if (strlen($row_user['user_color_gc']) > 1) {
                $user_color = $db->sql_ufetchrow("SELECT `group_weight`, `group_color`, `group_id` FROM `".AUC_TABLE."` WHERE `group_color` = '".$row_user['user_color_gc']."'");
                if ($user_color['group_id'] > 0) {
                    // there is a colorgroup for this color
                    // so last check - if inside the colorgroups is an invalid one
                    if ($check_group == $row_user['user_color_gi']) {
                        // everything is ok ...
                        return TRUE;
                    } else {
                        // uups .. it seems, that there are invalid colorgroups inside the user colorgroups
                        // so we update those informations
                        $sqlrg = "`user_color_gi` = '".$check_group."'";
                        if ($dup) {
                            // we have a change of the user_color_gc too
                            $sqlrg .= ", `user_color_gc` = '".$temp_color['group_color']."'";
                        }
                        $dup = TRUE;
                    }
                } else {
                    // there is no colorgroup for this color
                    // so we set user to the hightest color of a group he is member of
                    $dup = TRUE;
                    $sqlrg = "`user_color_gc` = '".$temp_color['group_color']."'";
                }
            } else {
                // It seems, that the user is a member of a colorgroup but have no user_color_gc
                // so we set user to the hightest color of a group he is member of
                $dup = TRUE;
                $sqlrg = "`user_color_gc` = '".$temp_color['group_color']."'";
                if (!empty($check_group)) {
                    // it could be, that the user has colorgroups which no longer exists
                    // because we have to update the userstable ... why not update this too ?
                    $sqlrg .= ", `user_color_gi` = '".$check_group."'";
                }
            }
        }
        if (!empty($sqlrg)) {
            $db->sql_uquery("UPDATE `"._USERS_TABLE."` SET " . $sqlrg . " WHERE user_id = '" . $user_id ."'");
            return TRUE;
        }
    }
    return FALSE;
}

function remove_group_attributes($user_id=0, $group_id=0, $loop=0, $only_color=0) {
    global $db, $evoconfig, $cache;

    if ( (($user_id == 0) && ($group_id == 0)) || ($user_id == ANONYMOUS)) {
        return false; // Nothing have to be done
    }
    if (($user_id == 0) && ($group_id != 0) && ($loop == 0)) {
        // We have to remove group_attributes from a whole group. So let's select all users from this group
        $sql = "SELECT `user_id` FROM `".USER_GROUP_TABLE."` WHERE `group_id`=".$group_id;
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result)) {
            remove_group_attributes($row['user_id'], $group_id, 0);
        }
    } elseif (($user_id != 0)) {
        // We have a specific user where we have to change group_attributes
        // Let's get the user informations
        $row_color  = $db->sql_ufetchrow("SELECT `user_color_gc`, `user_color_gi` FROM `".USERS_TABLE."` WHERE `user_id`= '".$user_id."'");
        if (!empty($row_color['user_color_gi'])) {
            $colorgroup = str_replace('--'. $group_id .'--', '', $row_color['user_color_gi']);
            $colorgroup = (strlen($colorgroup) < 5 ? '' : $colorgroup);
            $sqlrg      = "`user_color_gi` = '".$colorgroup."', `user_color_gc`=''";
        } else {
            $sqlrg      = '';
        }
        if (!$only_color) {
            $row_rank   = $db->sql_ufetchrow("SELECT `bbg`.`group_rank` FROM `".GROUPS_TABLE."` AS `bbg` RIGHT JOIN `".USER_GROUP_TABLE."` AS `bbug` ON `bbg`.`group_id` = `bbug`.`group_id` WHERE `bbug`.`user_id` = '".$user_id."' AND  `bbg`.`group_rank` > 0 ORDER BY `bbg`.`group_id` DESC LIMIT 0,1");
            $rank       = (empty($row_rank['group_rank']) ? '' : $row_rank['group_rank']);
            $sqlrg     .= ", `user_rank`  = '".$rank."'";
        }
        if (!empty($sqlrg)) {
            $db->sql_uquery("UPDATE `"._USERS_TABLE."` SET " . $sqlrg . " WHERE user_id = " . $user_id);
            $result = add_group_attributes($user_id, $group_id, 0, $only_color, 1, 1);
        }
        if ($result) {
            return TRUE;
        }
    }
    return false;
}

// GetColorGroups function by JeFFb68CAM
// called by several files - so it makes sense to cache it (ReOrGaNiSaTiOn)
function GetColorGroups($in_admin = false) {
    global $db, $cache;
    static $ColorGroupsCache;
    if ( (($ColorGroupsCache = $cache->load('ColorGroups', 'config')) === false) || empty($ColorGroupsCache) ) {
        $ColorGroupsCache = '';
        $result = $db->sql_query("SELECT `group_id`, `group_name`, `group_color`, `group_weight` FROM `".AUC_TABLE."` WHERE `group_id`>'0' ORDER BY `group_weight` ASC");
        $back = ($in_admin) ? '&amp;menu=1' : '';
        while (list($group_id, $group_name, $group_color, $group_weight) = $db->sql_fetchrow($result)) {
            $ColorGroupsCache .= '&nbsp;[&nbsp;<strong><a href="'. append_sid('auc_listing.php?id='. $group_id.$back) .'"><span class="genmed" style="color:#'. $group_color .';">'. $group_name .'</span></a></strong>&nbsp;]&nbsp;';
        }
        $db->sql_freeresult($result);
        $cache->save('ColorGroups', 'config', $ColorGroupsCache);
    }
    return $ColorGroupsCache;
}

function UsernameColor($username, $old_name=false) {
    global $db, $evoconfig, $cache;
    static $cached_names;

    if($old_name) {
        $username = $old_name;
    }
    if(!$evoconfig['use_colors'] || empty($username)) {
        return $username;
    }
    $plain_username = $username;
    if(!empty($cached_names[$plain_username])) {
        return $cached_names[$plain_username];
    }
    if ((($cached_names = $cache->load('UserColors', 'config')) === false) || !is_array($cached_names)) {
      $cached_names = array();
      $result = $db->sql_query("SELECT `user_color_gc`, `username` FROM `" . _USERS_TABLE . "` WHERE `user_color_gc` != ''", TRUE);
      while(list($user_color, $uname) = $db->sql_fetchrow($result)) {
            $color_username = (strlen($user_color) == 6) ? '<span style="color: #'. $user_color .';"><strong>'. $uname .'</strong></span>' : $uname;
            $cached_names[$uname] = $color_username;
            $cache->save('UserColors', 'config', $cached_names);
      }
      $db->sql_freeresult($result);
    }
    if (!empty($cached_names[$plain_username])) {
        return $cached_names[$plain_username];
    } else {
        return $plain_username;
    }
}

function GroupColor($group_name, $short=0) {
    global $db, $evoconfig, $cache;
    static $cached_groups;
    if(!$evoconfig['use_colors']) return $group_name;
    $plaingroupname = ( $short !=0 ) ? $group_name.'_short' : $group_name;
    if (!empty($cached_groups[$plaingroupname])) {
        return $cached_groups[$plaingroupname];
    }
    if ((($cached_groups = $cache->load('GroupColors', 'config')) === false) || empty($cached_groups)) {
        $cached_groups = array();
        $sql = 'SELECT `auc`.`group_color` as `group_color`, `gr`.`group_name` as`group_name` FROM ( `'.GROUPS_TABLE.'` `gr` LEFT JOIN  `' . AUC_TABLE . '` `auc` ON `gr`.`group_color` =  `auc`.`group_id`) WHERE `gr`.`group_description` <> "Personal User" ORDER BY `gr`.`group_name` ASC';
        $result = $db->sql_query($sql);
        while (list($group_color, $groupcolor_name) = $db->sql_fetchrow($result)) {
            $colorgroup_short = (strlen($groupcolor_name) > 13) ? substr($groupcolor_name,0,10).'...' : $groupcolor_name;
            $colorgroup_name  = $groupcolor_name;
            $cached_groups[$groupcolor_name.'_short'] = (strlen($group_color) == 6) ? '<span style="color: #'. $group_color .'"><strong>'. $colorgroup_short .'</strong></span>' : $colorgroup_short;
            $cached_groups[$groupcolor_name] = (strlen($group_color) == 6) ? '<span style="color: #'. $group_color .'"><strong>'. $colorgroup_name .'</strong></span>' : $colorgroup_name;
        }
        $db->sql_freeresult($result);
        $cache->save('GroupColors', 'config', $cached_groups);
    }
    if (!empty($cached_groups[$plaingroupname])) {
        return $cached_groups[$plaingroupname];
    } else {
        return $plaingroupname;
    }
}


// Function: EvoKernel_UserContactImg by ReOrGaNiSaTiOn
// centralized function for getting back an array with all needed images and url's for user contact
// $user = should be an array with all user informations or user_id or username
// at the moment $lang and $images is only filled if coming from phpBB Forums
// for a later version this should be from a central position (language and theme dependend)
function EvoKernel_UserContactImg($user_in='') {
    global $db, $userinfo, $lang, $evoconfig, $images, $userinfo;

    $online_color  = 'style="color:green;"';
    $offline_color = 'style="color:red;"';
    $hidden_color  = 'style="color:black;"';
    $user = array();
    $user['profile_img'] = '';
    $user['profile']     = '';
    $user['search_img']  = '';
    $user['search']      = '';
    $user['email_img']   = '';
    $user['email']       = '';
    $user['www_img']     = '';
    $user['www']         = '';
    $user['icq_status_img'] = '';
    $user['icq_img']     = '';
    $user['icq']         = '';
    $user['icq_noscript']   = '';
    $user['aim_img']     = '';
    $user['aim']         = '';
    $user['msn_img']     = '';
    $user['msn']         = '';
    $user['yim_status_img'] = '';
    $user['yim_img']     = '';
    $user['yim_noscript']   = '';
    $user['yim']         = '';
    $user['pm_img']      = '';
    $user['pm']          = '';
    $user['online_status_img'] = '';
    $user['online_status']  = '';

    if (empty($user_in)) {
        return $user;
    } else if (!is_array($user_in)) {
        if (is_numeric($user_in)) {
            $userprofile = get_user_field('*', $user_in, false);
        } else {
            $userprofile = get_user_field('*', $user_in, true);
        }
    } else {
        $userprofile = $user_in;
    }
    $profile_url = "modules.php?name=Profile&amp;mode=viewprofile&amp;" . POST_USERS_URL . '=' . $userprofile['user_id'];
    $pm_url      = "modules.php?name=Private_Messages&amp;mode=post&amp;" . POST_USERS_URL . '=' . $userprofile['user_id'];
    $email_uri   = ( $evoconfig['board_email_form'] ) ? "modules.php?name=Profile&amp;mode=email&amp;" . POST_USERS_URL .'=' . $userprofile['user_id'] : 'mailto:' . $userprofile['user_email'];
    // Get ICQ
    if ( !empty($userprofile['user_icq']) ) {
        $user['icq_status_img'] = '<a href="http://wwp.icq.com/' . $userprofile['user_icq'] . '#pager"><img src="http://status.icq.com/online.gif?icq=' . $userprofile['user_icq'] . '&amp;img=5" width="12" height="12" border="0" /><\/a>';
        $user['icq_img']        = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $userprofile['user_icq'] . '"><img src="' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" /><\/a>';
        $user['icq']            = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $userprofile['user_icq'] . '">' . $lang['ICQ'] . '<\/a>';
        $user['icq_script']   = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $userprofile['user_icq'] . '">' . $lang['ICQ'] . '</a>';
        $user['icq_script'] = "
        <script language='JavaScript' type='text/javascript'>
        <!--
            if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
                document.write('".$user['icq_img']."');
            else
                document.write('<span style=\'position:absolute;height:20px\'><span style=\'position:absolute\'>".$user['icq_img']."<\/span><span style=\'position:absolute;left:3px;top:-1px\'>".$user['icq_status_img']."<\/span><\/span>');
        //-->
        </script>";
    }
    // Get Yahoo
    if ( !empty($userprofile['user_yim']) ) {
        $user['yim_status_img'] = '<img src="http://opi.yahoo.com/online?u=' . $userprofile['user_yim'] . '&amp;m=g&amp;t=0" width="12" height="12" border="0" \/>';
        $user['yim_img']        = '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $userprofile['user_yim'] . '&amp;.src=pg"><img src="' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /><\/a>';
        $user['yim']            = '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $userprofile['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '<\/a>';
        $user['yim_noscript']   = '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $userprofile['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>';
        $user['yim_script'] = "
        <script language='JavaScript' type='text/javascript'>
        <!--
            if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
                document.write('".$user['yim_img']."');
            else
                document.write('<span style=\'position:absolute;height:20px\'><span style=\'position:absolute\'>".$user['yim_img']."<\/span><span style=\'position:absolute;left:3px;top:-1px\'>".$user['yim_status_img']."<\/span><\/span>');
        //-->
        </script>";
    }
    // Get AIM
    if ( !empty($userprofile['user_aim']) ) {
        $user['aim_img'] = '<a href="aim:goim?screenname=' . $userprofile['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>';
        $user['aim']     = '<a href="aim:goim?screenname=' . $userprofile['user_aim'] . '&amp;message=Hello+Are+you+there?">' . $lang['AIM'] . '</a>';
    }
    // Get MSN
    if ( !empty($userprofile['user_msn']) ) {
        $user['msn_img'] = '<a href="' . $temp_url . '"><img src="' . $images['icon_msnm'] . '" alt="' . $lang['MSNM'] . '" title="' . $lang['MSNM'] . '" border="0" /></a>';
        $user['msn']     = '<a href="' . $temp_url . '">' . $lang['MSNM'] . '</a>';
    }
    // Get WWW
    if ( !empty($userprofile['user_website']) ) {
        $user['www_img'] = '<a href="' . $userprofile['user_website'] . '" onclick="window.open(this.href,\'_blank\'); return false;"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>';
        $user['www']     = '<a href="' . $userprofile['user_website'] . '" onclick="window.open(this.href,\'_blank\'); return false;">' . $lang['Visit_website'] . '</a>';
    }
    // Get Profile
    $user['profile_img'] = '<a href="' . $profile_url . '"><img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" /></a>';
    $user['profile']     = '<a href="' . $profile_url . '">' . $lang['Read_profile'] . '</a>';
    // Get Privat Message
    if (is_active('Private_Messages') && isset($userprofile['user_active']) && $userprofile['user_active']) {
        $user['pm_img']          = '<a href="' . $pm_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
        $user['pm']              = '<a href="' . $pm_url . '">' . $lang['Send_private_message'] . '</a>';
    }
    // Get E-Mail
    if ( isset($userprofile['user_viewemail']) && ($userprofile['user_viewemail'] || is_admin() )) {
        $user['email_img'] = '<a href="' . $email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
        $user['email']     = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';
    }
    // Get User Status
    $online1 = $db->sql_ufetchrow('SELECT COUNT(`uname`) AS is_online FROM `'._SESSION_TABLE.'` WHERE `uname`= "'.$userprofile['username'].'"');
    if ( $online1['is_online'] > 0 ) {
        if ( !$userprofile['user_allow_viewonline'] ) {
            $user['online_status_img'] = '<a href="' . append_sid("viewonline.php") . '"><img src="' . $images['icon_online'] . '" alt="' . sprintf($lang['is_online'], $userprofile['username']) . '" title="' . sprintf($lang['is_online'], $userprofile['username']) . '" /></a>';
            $user['online_status'] = '<strong><a href="' . append_sid("viewonline.php") . '" title="' . sprintf($lang['is_online'], $userprofile['username']) . '"' . $online_color . '>' . $lang['Online'] . '</a></strong>';
        } else if ( is_admin() || $userprofile['user_id'] == $userinfo['user_id'] ) {
            $user['online_status_img'] = '<a href="' . append_sid("viewonline.php") . '"><img src="' . $images['icon_hidden'] . '" alt="' . sprintf($lang['is_hidden'], $userprofile['username']) . '" title="' . sprintf($lang['is_hidden'], $userprofile['username']) . '" /></a>';
            $user['online_status'] = '<strong><em><a href="' . append_sid("viewonline.php") . '" title="' . sprintf($lang['is_hidden'], $userprofile['username']) . '"' . $hidden_color . '>' . $lang['Hidden'] . '</a></em></strong>';
        } else {
            $user['online_status_img'] = '<img src="' . $images['icon_offline'] . '" alt="' . sprintf($lang['is_offline'], $userprofile['username']) . '" title="' . sprintf($lang['is_offline'], $userprofile['username']) . '" />';
            $user['online_status'] = '<span title="' . sprintf($lang['is_offline'], $userprofile['username']) . '"' . $offline_color . '><strong>' . $lang['Offline'] . '</strong></span>';
        }
    } else {
        $user['online_status_img'] = '<img src="' . $images['icon_offline'] . '" alt="' . sprintf($lang['is_offline'], $userprofile['username']) . '" title="' . sprintf($lang['is_offline'], $userprofile['username']) . '" />';
        $user['online_status']     = '<span title="' . sprintf($lang['is_offline'], $userprofile['username']) . '"' . $offline_color . '><strong>' . $lang['Offline'] . '</strong></span>';
    }
    return $user;
}


// Function: EvoKernel_UserBanned by ReOrGaNiSaTiOn
// centralized function for checking if a user, bot, ip-adress, email or domain is banned
// $user = string where against the check is done
// $type = 'username'   $user is a name of a registered user
//         'userid'     $user is a user_id of a registered user
//         'ip_adress_v4'  $user is a ip-adress in the form xxx.xxx.xxx (IPv4)
//         'ip_adress_v6'  $user is a ip_adress in the form
//         'ip_adress'  $user is a ip adress  - but not identified as v4 or v6
//         'email'      $user is a full qualified email adress user@domain.root
//         'domain'     $user is a domain
//         'network_v4' $user is a network adress in the form xxx.xxx.xxx/99
//         'network_v6' $user is a network adress in the form 2001:0db8:1234:ffff:ffff:ffff:ffff:ffff::/999
//         'network'    $user is a network - but not identified as v4 or v6
//         'all'        $user is an array - checked against all types
function EvoKernel_UserBanned($user='', $type='username') {
    global $db, $cache, $userinfo, $dbresult;
    static $check, $checktype;

    if (is_admin()) {
        return FALSE; // at the moment we make no checks against admins of the board
    }
    $type     = strtolower($type);
    if (is_array($user) && isset($user['user_id']) && ($user['user_id'] > 0)) {
        $user = $user['user_id'];
    } else {
        if (empty($user)) {
            return TRUE; // there is no info given - so we decide to ban
        } else {
            $user = $userinfo['user_id'];
            $type = 'userid';
        }
    }
    if (!isset($checktype) || !is_array($checktype)) {
        $checktype = array('all', 'username', 'ip_adress', 'ip_adress', 'ip_adressv4', 'ip_adressv6', 'email', 'domain', 'network', 'networkv4', 'networkv6');
    }
    if (!isset($check) || !is_array($check)) {
        $check = array();
    }
    if (!in_array($type, $checktype)) {
        return FALSE;
    }
    if (isset($check[$type][$user])) {
        return $check[$type][$user];
    }
    $check[$type][$user] = TRUE; // set default to "banned"
    return FALSE;

    preg_match('/(..)(..)(..)(..)/', $ip, $user_ip_parts);

    $sql = "SELECT ban_ip, ban_userid, ban_email FROM " . BANLIST_TABLE . "
            WHERE ban_ip IN ('" . $user_ip_parts[1] . $user_ip_parts[2] . $user_ip_parts[3] . $user_ip_parts[4] . "', '" . $user_ip_parts[1] . $user_ip_parts[2] . $user_ip_parts[3] . "ff', '" . $user_ip_parts[1] . $user_ip_parts[2] . "ffff', '" . $user_ip_parts[1] . "ffffff')";
            if ( is_user() && !empty($userdata['user_email'])) {
                $sql .= " OR ban_email LIKE '" . str_replace("\'", "''", $userdata['user_email']) . "'
                OR ban_email LIKE '" . substr(str_replace("\'", "''", $userdata['user_email']), strpos(str_replace("\'", "''", $userdata['user_email']), "@")) . "'
                OR ban_userid = ". $userinfo['user_id'];
        }
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {

    }
    $db->sql_freeresult($result);


    function EvoKernel_UserBannedUsername($user) {
        global $db;

        $username = get_user_field('*', $user, true);
        if (isset($username['username']) && $username['user_id'] != ANONYMOUS)  {
            if ($username['user_active'] != 1 || $username['user_level'] < 1) {
                return TRUE;
            }
            if ( $db->sql_unumrows('SELECT `ban_userid` FROM `'.BANLIST_TABLE.'` WHERE `ban_userid`="'.$username['user_id'].'"') > 0) {
                return TRUE;
            }
            if ( $db->sql_unumrows('SELECT `user_id` FROM `'._SENTINEL_BLOCKED_IPS_TABLE.'` WHERE `user_id`="'.$username['user_id'].'"') > 0) {
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

    function EvoKernel_UserBannedUserid($user) {
        global $db;

        if (!isset($dbresult)) {
            return FALSE;
        }

        if (in_array($user, $dbresult)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function EvoKernel_UserBannedEmail($user) {
        global $dbresult;

        if (!isset($dbresult)) {
            return FALSE;
        }

        if (in_array($user, $dbresult)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function EvoKernel_UserBannedDomain($user) {
        global $dbresult;

        if (!isset($dbresult)) {
            return FALSE;
        }

        if (in_array($user, $dbresult)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function EvoKernel_UserBannedip($user) {
        global $dbresult;

        if (!isset($dbresult)) {
            return FALSE;
        }

        if (in_array($userip, $dbresult)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function EvoKernel_UserBannedipv4($user) {
        global $dbresult;

        if (!isset($dbresult)) {
            return FALSE;
        }

        if (in_array($userip, $dbresult)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function EvoKernel_UserBannedipv6($user) {
        global $dbresult;

        if (!isset($dbresult)) {
            return FALSE;
        }

        if (in_array($userip, $dbresult)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function EvoKernel_UserBannedAll($user) {

        $check = TRUE;
        $check = EvoKernel_UserBannedUsername($user);
        $check = EvoKernel_UserBannedUserid($user);
        $check = EvoKernel_UserBannedEmail($user);
        $check = EvoKernel_UserBannedDomain($user);
        $check = EvoKernel_UserBannedIp($user);
        return $check;
    }

    switch ($type) {
        case 'username':
            $check[$type][$user] = EvoKernel_UserBannedUsername($user);
            break;
        case 'userid':
            $check[$type][$user] = EvoKernel_UserBannedUserid($user);
            break;
        case 'email':
            $check[$type][$user] = EvoKernel_UserBannedEmail($user);
            break;
        case 'domain':
            $check[$type][$user] = EvoKernel_UserBannedDomain($user);
            break;
        case 'ip_adress':
            $check[$type][$user] = EvoKernel_UserBannedIp($user);
            break;
        case 'ip_adressv4':
            $check[$type][$user] = EvoKernel_UserBannedIpv4($user);
            break;
        case 'ip_adressv6':
            $check[$type][$user] = EvoKernel_UserBannedIpv6($user);
            break;
        case 'all':
            $check[$type][$user] = EvoKernel_UserBannedAll($user);
            break;
        default:
            $check[$type][$user] = FALSE;
    }
    unset($dbresult);
    return $check[$type][$user];
}

?>