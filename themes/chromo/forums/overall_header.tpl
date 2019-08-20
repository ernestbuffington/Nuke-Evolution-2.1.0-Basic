{META}
<!-- BEGIN switch_enable_pm_popup -->
<script type="text/javascript">
<!--
    if ( {PRIVATE_MESSAGE_NEW_FLAG} )
    {
        window.open('{U_PRIVATEMSGS_POPUP}', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400');;
    }
//-->
</script>
<!-- END switch_enable_pm_popup -->
<!-- Start add - Advanced time management MOD -->
<!-- BEGIN switch_send_pc_dateTime -->
<script type="text/javascript">
<!-- Start Replace - window.onload = send_pc_dateTime -->
    send_pc_dateTime();
<!-- End Replace - window.onload = send_pc_dateTime -->
    function send_pc_dateTime() {
        var pc_dateTime = new Date()
        pc_timezoneOffset = pc_dateTime.getTimezoneOffset()*(-60);
        pc_date = pc_dateTime.getFullYear()*10000 + (pc_dateTime.getMonth()+1)*100 + pc_dateTime.getDate();
        pc_time = pc_dateTime.getHours()*3600 + pc_dateTime.getMinutes()*60 + pc_dateTime.getSeconds();

        for ( i = 0; document.links.length > i; i++ ) {
            with ( document.links[i] ) {
                if ( href.indexOf('{U_SELF}') == 0 ) {
                    textLink = '' + document.links[i].firstChild.data
                    if ( textLink.indexOf('http://') != 0 && textLink.indexOf('www.') != 0 && (textLink.indexOf('@') == -1 || textLink.indexOf('@') == 0 || textLink.indexOf('@') == textLink.length-1 )) {
                        if ( href.indexOf('?') == -1 ) {
                            pc_data = '?pc_tzo=' + pc_timezoneOffset + '&amp;pc_d=' + pc_date + '&amp;pc_t=' + pc_time;
                        } else {
                            pc_data = '&amp;pc_tzo=' + pc_timezoneOffset + '&amp;pc_d=' + pc_date + '&amp;pc_t=' + pc_time;
                        }
                        if ( href.indexOf('#') == -1 ) {
                            href += pc_data;
                        } else {
                            href = href.substring(0, href.indexOf('#')) + pc_data + href.substring(href.indexOf('#'), href.length);
                        }
                    }
                }
            }
        }
    }
</script>
<!-- END switch_send_pc_dateTime -->
<!-- End add - Advanced time management MOD -->

<a name="top"></a>
<div>
    <table width="90%" align="center" cellspacing="0" cellpadding="0" style="table-layout:fixed;">
        <tr>
            <td width="45" height="100%" style="background-image: url(themes/chromo/forums/images/over_01.jpg); background-repeat:no-repeat;">
                <img src="themes/chromo/forums/images/spacer.gif" alt="" width="45" height="1" />
            </td>
            <td width="45" height="100%" style="background-image: url(themes/chromo/forums/images/over_02.jpg); background-repeat:no-repeat;">
                <img src="themes/chromo/forums/images/spacer.gif" alt="" width="45" height="1" />
            </td>
            <td width="100%" height="100%" style="background-image: url(themes/chromo/forums/images/over_03_tile.jpg); background-repeat:repeat-x;">
                <table width="100%" style="table-layout:fixed;">
                    <tr>
                        <td>
                            <img src="themes/chromo/forums/images/spacer.gif" alt="" height="15" />
                        </td>
                    </tr>
                    <tr>
                        <td><div>
                            <ul id="forumsnavigation">
                              <li><a href="{U_INDEX}" class="fheader">{I_MINI_INDEX}{L_MINI_INDEX}</a></li>
                              <li><a href="{U_SEARCH}" class="fheader">{I_MINI_SEARCH}{L_SEARCH}</a></li>
                              <li><a href="{U_GROUP_CP}" class="fheader">{I_MINI_USERGROUPS}{L_USERGROUPS}</a></li>
                              <!-- BEGIN switch_edit_profile -->
                              <li><a href="{switch_edit_profile.U_PROFILE}" class="fheader">{switch_edit_profile.I_MINI_PROFILE}{switch_edit_profile.L_PROFILE}</a></li>
                              <!-- END switch_edit_profile -->
                              <li><a href="{U_MEMBERLIST}" class="fheader">{I_MINI_MEMBERLIST}{L_MEMBERLIST}</a></li>
                              <!-- BEGIN switch_private_message -->
                              <li><a href="{switch_private_message.U_PRIVATEMSGS}" class="fheader">{switch_private_message.I_MINI_PRIVATEMSGS}{switch_private_message.PRIVATE_MESSAGE_INFO}</a></li>
                              <!-- END switch_private_message -->
                              <li><a href="{U_RANKS}" class="fheader">{I_RANKS}{L_RANKS}</a></li>
                              <li><a href="{U_ONLINE}" class="fheader">{I_MINI_ONLINE}{L_ONLINE}</a></li>
                              <li><a href="{U_STAFF}" class="fheader">{I_STAFF}{L_STAFF}</a></li>
                              <li><a href="{U_STATISTICS}" class="fheader">{I_STATISTICS}{L_STATISTICS}</a></li>
                              <li><a href="{U_RULES}" class="fheader">{I_RULES}{L_RULES}</a></li>
                              <li><a href="{U_FAQ}" class="fheader">{I_MINI_FAQ}{L_FAQ}</a></li>
                              <li><a href="{U_LOGIN_LOGOUT}" class="fheader">{I_MINI_LOGIN_LOGOUT}{L_LOGIN_LOGOUT}</a></li>
                            </ul></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="themes/chromo/forums/images/spacer.gif" alt="" height="15" />
                        </td>
                    </tr>
                </table>
            </td>
            <td width="45" height="100%" style="background-image: url(themes/chromo/forums/images/over_04.jpg); background-repeat:no-repeat;">
                <img src="themes/chromo/forums/images/spacer.gif" alt="" width="45" height="1" />
            </td>
            <td width="45" height="100%" style="background-image: url(themes/chromo/forums/images/over_05.jpg); background-repeat:no-repeat;">
                <img src="themes/chromo/forums/images/spacer.gif" alt="" width="45" height="1" />
            </td>
        </tr>
    </table>
</div>
<!-- BEGIN boarddisabled -->
<br />
<div align="center">
    <span class="gen">
        <strong>{L_BOARD_CURRENTLY_DISABLED}</strong>
    </span>
</div>
<br />
<!-- END boarddisabled -->
<!-- BEGIN switch_board_msg -->
<br />
<div align="center">
<table width="{BM_WIDTH}" class="forumline">
    <tr>
      <th colspan="3" class="thCornerL" height="25" nowrap="nowrap">&nbsp;{BM_TITLE}&nbsp;</th>
    </tr>
    <tr>
      <td width="10%" align="center" class="row1">
          {BM_IMAGES}
      </td>
      <td class="row1">
              {BM_MSG}
      </td>
      <td width="10%" align="center" class="row1">
          {BM_IMAGES}
      </td>
    </tr>
</table>
</div>
<div align="center">
<table width="{BM_WIDTH}">
    <tr>
      <td align="left" valign="top">
          <span class="gensmall">
              <a href="{U_BM_PRV}" title="{BM_PRV_TITLE}" class="nav">{L_BM_PRV}</a>
          </span>
      </td>
      <td align="right" valign="top">
          <span class="gensmall">
              <a href="{U_BM_NXT}" title="{BM_NXT_TITLE}" class="nav">{L_BM_NXT}</a>
          </span>
      </td>
    </tr>
</table>
</div>
<!-- END switch_board_msg -->
<!-- Quick Search -->
<!-- BEGIN switch_quick_search -->
<br />
<script type="text/javascript">
<!--
    function checkSearch()
    {
        {switch_quick_search.CHECKSEARCH}
        else
        {
            return true;
        }
    }
//-->
</script>

<div align="center">
<form name="search_block" method="post" action="{U_SEARCH}" onsubmit="return checkSearch()">
<table width="100%" cellpadding="2" cellspacing="1" >
    <tr>
        <td align="center">
            <span class="gensmall">
                {switch_quick_search.L_QUICK_SEARCH_FOR}
                <input class="post" type="text" name="search_keywords" size="15" />
                {switch_quick_search.L_QUICK_SEARCH_AT}
                <select class="post" name="site_search">{switch_quick_search.SEARCHLIST}</select>
            </span>
        </td>
    </tr>
<!-- END switch_quick_search -->
<!-- BEGIN switch_search_security_code -->
    <tr>
        <td align="center" height="28">
            {L_SEARCH_SECURITY_CODE}
        </td>
    </tr>
<!-- END switch_search_security_code -->
<!-- BEGIN switch_quick_search -->
    <tr>
        <td align="center" height="28">
            <input class="mainoption" type="submit" value="{L_SEARCH}" />
        </td>
    </tr>
    <tr>
        <td align="center">
            <a href="{U_SEARCH}" class="gensmall">{switch_quick_search.L_ADVANCED_FORUM_SEARCH}</a>
            <input type="hidden" name="search_fields" value="all" />
            <input type="hidden" name="show_results" value="topics" />
        </td>
    </tr>
</table>
</form>
</div>
<!-- END switch_quick_search -->
<br />