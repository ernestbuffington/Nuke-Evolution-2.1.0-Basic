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

if (!defined('IN_PHPBB') && !defined('NUKE_EVO'))
{
    die('Hacking attempt');
}

// Debug Level
define('DEBUG', 1); // Debugging on
//define('DEBUG', 0); // Debugging off

// User Levels <- Do not change the values of USER or ADMIN
define('DELETED', -1);
define('USER', 1);
define('ADMIN', 2);
define('MOD', 3);

// Anonymous user_id
define('ANONYMOUS', 1);

// User related
define('USER_ACTIVATION_NONE', 0);
define('USER_ACTIVATION_SELF', 1);
define('USER_ACTIVATION_ADMIN', 2);
define('USER_AVATAR_NONE', 0);
define('USER_AVATAR_UPLOAD', 1);
define('USER_AVATAR_REMOTE', 2);
define('USER_AVATAR_GALLERY', 3);

// Group settings
define('GROUP_OPEN', 0);
define('GROUP_CLOSED', 1);
define('GROUP_HIDDEN', 2);
define('GROUP_INITIAL_NO', 0);
define('GROUP_INITIAL_YES', 1);

// Forum state
define('FORUM_UNLOCKED', 0);
define('FORUM_LOCKED', 1);

// Topic status
define('TOPIC_UNLOCKED', 0);
define('TOPIC_LOCKED', 1);
define('TOPIC_MOVED', 2);
define('TOPIC_WATCH_NOTIFIED', 1);
define('TOPIC_WATCH_UN_NOTIFIED', 0);

// Topic types
define('POST_NORMAL', 0);
define('POST_STICKY', 1);
define('POST_ANNOUNCE', 2);
define('POST_GLOBAL_ANNOUNCE', 3);

// Error codes
define('GENERAL_MESSAGE', 200);
define('GENERAL_ERROR', 202);
define('CRITICAL_MESSAGE', 203);
define('CRITICAL_ERROR', 204);

// Private messaging
define('PRIVMSGS_READ_MAIL', 0);
define('PRIVMSGS_NEW_MAIL', 1);
define('PRIVMSGS_SENT_MAIL', 2);
define('PRIVMSGS_SAVED_IN_MAIL', 3);
define('PRIVMSGS_SAVED_OUT_MAIL', 4);
define('PRIVMSGS_UNREAD_MAIL', 5);

// URL PARAMETERS
define('POST_TOPIC_URL', 't');
define('POST_CAT_URL', 'c');
define('POST_FORUM_URL', 'f');
define('POST_USERS_URL', 'u');
define('POST_POST_URL', 'p');
define('POST_GROUPS_URL', 'g');

// Session parameters
define('SESSION_METHOD_COOKIE', 100);
define('SESSION_METHOD_GET', 101);

// Page numbers for session handling
define('PAGE_INDEX', 0);
define('PAGE_LOGIN', -1);
define('PAGE_SEARCH', -2);
define('PAGE_REGISTER', -3);
define('PAGE_PROFILE', -4);
define('PAGE_VIEWONLINE', -6);
define('PAGE_VIEWMEMBERS', -7);
define('PAGE_FAQ', -8);
define('PAGE_POSTING', -9);
define('PAGE_PRIVMSGS', -10);
define('PAGE_GROUPCP', -11);
define('PAGE_FORUMS', -15);
define('PAGE_TOPICS', -16);
define('PAGE_POSTS', -17);
define('PAGE_UACP', -1210);
define('PAGE_RULES', -1214);

/*--ARCADE MOD #1--*/

define('PAGE_STAFF', -12);
define('PAGE_RECENT', -33);
define('PAGE_STATS', -34);
define('PAGE_RANKS', -35);
define('PAGE_ADMIN_INDEX', -50);
define('PAGE_TOPIC_OFFSET', -5000);

// Auth settings
define('AUTH_LIST_ALL', 0);
define('AUTH_ALL', 0);
define('AUTH_REG', 1);
define('AUTH_ACL', 2);
define('AUTH_MOD', 3);
define('AUTH_ADMIN', 5);
define('AUTH_VIEW', 1);
define('AUTH_READ', 2);
define('AUTH_POST', 3);
define('AUTH_REPLY', 4);
define('AUTH_EDIT', 5);
define('AUTH_DELETE', 6);
define('AUTH_ANNOUNCE', 7);
define('AUTH_STICKY', 8);
define('AUTH_POLLCREATE', 9);
define('AUTH_VOTE', 10);
define('AUTH_ATTACH', 11);
define('AUTH_GLOBALANNOUNCE', 12);
define('HIDDEN_CAT', 0); // NOTE: change this value to the forum id, of the forum, witch you would like to be hidden
define('AUTH_DOWNLOAD', 20);

//
// Table Names
//

// Nuke-Evolution Core Tables
define('_AUTHOR_TABLE', $prefix.'_authors');
define('_AUTONEWS_TABLE', $prefix.'_autonews');
define('_BLOCKS_TABLE', $prefix.'_blocks');
define('_COMMENTS_TABLE', $prefix.'_comments');
define('_COUNTER_TABLE', $prefix.'_counter');
define('_COUNTRY_TABLE', $prefix.'_country');
define('_EVOCONFIG_TABLE', $prefix.'_evolution');
define('_EVO_CONFIG_TABLE', $prefix.'_evolution_config');
define('_HEADLINES_TABLE', $prefix.'_headlines');
define('_MAIN_TABLE', $prefix.'_main');
define('_META_TABLE', $prefix.'_meta');
define('_MESSAGE_TABLE', $prefix.'_message');
define('_MODULES_TABLE', $prefix.'_modules');
define('_MODULES_CATEGORIES_TABLE', $prefix.'_modules_cat');
define('_MODULES_CONFIG_TABLE', $prefix.'_modules_config');
define('_MODULES_EXLINKS_TABLE', $prefix.'_modules_links');
define('_MODULES_POPUPS_TABLE', $prefix.'_modules_popups');
define('_MOSTONLINE_TABLE', $prefix.'_mostonline');
define('_NUKE_CONFIG_TABLE', $prefix.'_config');
define('_QUEUE_TABLE', $prefix.'_queue');
define('_REFERER_TABLE', $prefix.'_referer');
define('_SECURITY_BOT_TABLE', $prefix.'_security_agents');
define('_SESSION_TABLE', $prefix.'_session');
define('_THEMES_TABLE', $prefix.'_themes');
define('_THEMES_INFO_TABLE', $prefix.'_themes_info');
define('_USERS_TABLE', $user_prefix.'_users');
define('_USERS_TEMP_TABLE', $user_prefix.'_users_temp');
define('_WELCOME_PM_TABLE', $prefix.'_welcome_pm');

// Advertisement
define('_BANNER_TABLE', $prefix.'_banner');
define('_BANNER_CLIENT_TABLE', $prefix.'_banner_clients');
define('_BANNER_PLANS_TABLE', $prefix.'_banner_plans');
define('_BANNER_TERMS_TABLE', $prefix.'_banner_terms');
define('_BANNER_POSITIONS_TABLE', $prefix.'_banner_positions');

// Content
define('_PAGES_TABLE', $prefix.'_pages');
define('_PAGES_CATEGORIES_TABLE', $prefix.'_pages_categories');

// Donations
define('_DONATIONS_DONATOR_TABLE', $prefix.'_donators');
define('_DONATIONS_DONATOR_CONFIG_TABLE', $prefix.'_donators_config');

// Downloads
define('_DOWNLOADS_ACCESSES_TABLE', $prefix.'_downloads_accesses');
define('_DOWNLOADS_CONFIG_TABLE', $prefix.'_downloads_config');
define('_DOWNLOADS_GROUPS_TABLE', $prefix.'_downloads_groups');
define('_DOWNLOADS_USERS_TABLE', $prefix.'_downloads_users');
define('_DOWNLOADS_CATEGORIES_TABLE', $prefix.'_downloads_categories');
define('_DOWNLOADS_DOWNLOADS_TABLE', $prefix.'_downloads_downloads');
define('_DOWNLOADS_NEWDOWNLOADS_TABLE', $prefix.'_downloads_newdownloads');
define('_DOWNLOADS_EDITORIALS_TABLE', $prefix.'_downloads_editorials');
define('_DOWNLOADS_VOTEDATA_TABLE', $prefix.'_downloads_votedata');
define('_DOWNLOADS_EXTENSIONS_TABLE', $prefix.'_downloads_extensions');
define('_DOWNLOADS_HISTORY_TABLE', $prefix.'_downloads_history');
define('_DOWNLOADS_LICENSES_TABLE', $prefix.'_downloads_licenses');

// Encyclopedia (not pre-installed within Evo)
define('_ENCYCLOPEDIA_TABLE', $prefix.'_encyclopedia');
define('_ENCYCLOPEDIA_TEXT_TABLE', $prefix.'_encyclopedia_text');

// Journal (not pre-installed within Evo)
define('_JOURNAL_TABLE', $prefix.'_journal');
define('_JOURNAL_COMMENTS_TABLE', $prefix.'_journal_comments');
define('_JOURNAL_STATS_TABLE', $prefix.'_journal_stats');

// Error-Log
define('_ERROR_TABLE', $prefix.'_errors');
define('_ERROR_CONFIG_TABLE', $prefix.'_errors_config');

// Evo_UserBlock
define('_BLOCK_EVO_USERINFO_TABLE', $prefix.'_evo_userinfo');
define('_BLOCK_EVO_USERINFO_ADDONS_TABLE', $prefix.'_evo_userinfo_addons');

// EvoCredits
define('_CREDITS_TABLE', $prefix.'_evo_credits');

/*--FNL--*/

// FAQ
define('_FAQ_ANSWER_TABLE', $prefix.'_faqanswer');
define('_FAQ_CATEGORIES_TABLE', $prefix.'_faqcategories');

// Link Us
define('_LINKUS_CONFIG_TABLE', $prefix.'_link_us_config');
define('_LINKUS_TABLE', $prefix.'_link_us');

// News
define('_NSNNE_FUNC_TABLE', $prefix.'_nsnne_func');
define('_NSNNE_CONFIG_TABLE', $prefix.'_nsnne_config');
define('_RELATED_TABLE', $prefix.'_related');

// NukeSentinel
define('_SENTINEL_ADMINS_TABLE', $prefix.'_nsnst_admins');
define('_SENTINEL_BLOCKED_IPS_TABLE', $prefix.'_nsnst_blocked_ips');
define('_SENTINEL_BLOCKED_RANGES_TABLE', $prefix.'_nsnst_blocked_ranges');
define('_SENTINEL_BLOCKERS_TABLE', $prefix.'_nsnst_blockers');
define('_SENTINEL_CIDRS_TABLE', $prefix.'_nsnst_cidrs');
define('_SENTINEL_CONFIG_TABLE', $prefix.'_nsnst_config');
define('_SENTINEL_COUNTRIES_TABLE', $prefix.'_nsnst_countries');
define('_SENTINEL_EXCLUDED_RANGES_TABLE', $prefix.'_nsnst_excluded_ranges');
define('_SENTINEL_HARVESTER_TABLE', $prefix.'_nsnst_harvesters');
define('_SENTINEL_IP2COUNTRY_TABLE', $prefix.'_nsnst_ip2country');
define('_SENTINEL_PROTECTED_RANGES_TABLE', $prefix.'_nsnst_protected_ranges');
define('_SENTINEL_REFERERS_TABLE', $prefix.'_nsnst_referers');
define('_SENTINEL_STRINGS_TABLE', $prefix.'_nsnst_strings');
define('_SENTINEL_TRACKED_IPS_TABLE', $prefix.'_nsnst_tracked_ips');

// Reviews
define('_REVIEWS_CONFIG_TABLE', $prefix.'_reviews_config');
define('_REVIEWS_CATEGORIES_TABLE', $prefix.'_reviews_categories');
define('_REVIEWS_SUBCATEGORIES_TABLE', $prefix.'_reviews_subcategories');
define('_REVIEWS_REVIEWS_TABLE', $prefix.'_reviews_reviews');
define('_REVIEWS_NEWREVIEW_TABLE', $prefix.'_reviews_newreview');
define('_REVIEWS_EDITORIALS_TABLE', $prefix.'_reviews_editorials');
define('_REVIEWS_VOTEDATA_TABLE', $prefix.'_reviews_votedata');
define('_REVIEWS_MODREQUEST_TABLE', $prefix.'_reviews_modrequest');

/*--Shout Box--*/

// Site Map
define('_JMAP_TABLE', $prefix.'_jmap');
define('_SECTIONS_TABLE', $prefix.'_sections');

// Sommaire (not pre-installed within Evo)
define('_SOMMAIRE_TABLE', $prefix.'_sommaire');
define('_SOMMAIRE_CATEGORIES_TABLE', $prefix.'_sommaire_categories');

// Statistics
define('_STATS_HOUR_TABLE', $prefix.'_stats_hour');

// Stories Archive
define('_STORIES_TABLE', $prefix.'_stories');
define('_STORIES_CATEGORIES_TABLE', $prefix.'_stories_cat');

// Supporters
define('_NSNSP_SITES_TABLE', $prefix.'_nsnsp_sites');
define('_NSNSP_CONFIG_TABLE', $prefix.'_nsnsp_config');

// Surveys
define('_POLL_COMMENTS_TABLE', $prefix.'_pollcomments');
define('_POLL_DESC_TABLE', $prefix.'_poll_desc');
define('_POLL_DATA_TABLE', $prefix.'_poll_data');
define('_POLL_CHECK_TABLE', $prefix.'_poll_check');

// Topics
define('_TOPICS_TABLE', $prefix.'_topics');

// Web Links
define('_WEBLINKS_CONFIG_TABLE', $prefix.'_links_config');
define('_WEBLINKS_CATEGORIES_TABLE', $prefix.'_links_categories');
define('_WEBLINKS_SUBCATEGORIES_TABLE', $prefix.'_links_subcategories');
define('_WEBLINKS_LINKS_TABLE', $prefix.'_links_links');
define('_WEBLINKS_NEWLINK_TABLE', $prefix.'_links_newlink');
define('_WEBLINKS_EDITORIALS_TABLE', $prefix.'_links_editorials');
define('_WEBLINKS_VOTEDATA_TABLE', $prefix.'_links_votedata');
define('_WEBLINKS_MODREQUEST_TABLE', $prefix.'_links_modrequest');

// Your Account (CNBYA)
define('_CNBYA_CONFIG_TABLE', $prefix.'_cnbya_config');
define('_CNBYA_VALUE_TABLE', $prefix.'_cnbya_value');
define('_CNBYA_FIELD_TABLE', $prefix.'_cnbya_field');
define('_CNBYA_VALUE_TEMP_TABLE', $prefix.'_cnbya_value_temp');

// phpBB2 Core Tables
define('ADMIN_MODULE_TABLE', $prefix.'_bbadmin_nav_module');
define('AUC_TABLE', $prefix.'_bbadvanced_username_color');
define('AUTH_ACCESS_TABLE', $prefix.'_bbauth_access');
define('BANLIST_TABLE', $prefix.'_bbbanlist');
define('BOARD_MSG_TABLE', $prefix.'_bbboard_message');
define('CATEGORIES_TABLE', $prefix.'_bbcategories');
define('CONFIG_TABLE', $prefix.'_bbconfig');
define('DISALLOW_TABLE', $prefix.'_bbdisallow');
define('FORUMS_TABLE', $prefix.'_bbforums');
define('PRUNE_TABLE', $prefix.'_bbforum_prune');
define('GROUPS_TABLE', $prefix.'_bbgroups');
define('LOGS_TABLE', $prefix.'_bblogs');
define('LOGS_CONFIG_TABLE', $prefix.'_bblogs_config');
define('QUICKSEARCH_TABLE', $prefix.'_bbquicksearch');
define('POST_REPORTS_TABLE', $prefix.'_bbpost_reports');
define('POSTS_TABLE', $prefix.'_bbposts');
/*--FNA--*/
define('POSTS_TEXT_TABLE', $prefix.'_bbposts_text');
define('PRIVMSGS_TABLE', $prefix.'_bbprivmsgs');
define('PRIVMSGS_ARCHIVE_TABLE', $prefix.'_bbprivmsgs_archive');
define('PRIVMSGS_IGNORE_TABLE', $prefix.'_bbprivmsgs_ignore');
define('PRIVMSGS_TEXT_TABLE', $prefix.'_bbprivmsgs_text');
define('RANKS_TABLE', $prefix.'_bbranks');
define('SEARCH_TABLE', $prefix.'_bbsearch_results');
define('SEARCH_REBUILD_TABLE', $prefix.'_bbsearch_rebuild');
define('SEARCH_WORD_TABLE', $prefix.'_bbsearch_wordlist');
define('SEARCH_MATCH_TABLE', $prefix.'_bbsearch_wordmatch');
define('SESSIONS_TABLE', $prefix.'_session');
//define('SESSIONS_KEYS_TABLE', $prefix.'_bbsessions_keys');
define('SMILIES_TABLE', $prefix.'_bbsmilies');
define('THEMES_TABLE', $prefix.'_bbthemes');
define('THEMES_NAME_TABLE', $prefix.'_bbthemes_name');
define('TOPICS_TABLE', $prefix.'_bbtopics');
define('TOPICS_WATCH_TABLE', $prefix.'_bbtopics_watch');
define('USERS_TABLE', $user_prefix.'_users');
define('USERS_TEMP_TABLE', $user_prefix.'_users_temp');
define('USER_GROUP_TABLE', $prefix.'_bbuser_group');
define('WORDS_TABLE', $prefix.'_bbwords');
define('VOTE_DESC_TABLE', $prefix.'_bbvote_desc');
define('VOTE_RESULTS_TABLE', $prefix.'_bbvote_results');
define('VOTE_USERS_TABLE', $prefix.'_bbvote_voters');
define('XDATA_FIELDS_TABLE', $prefix.'_bbxdata_fields');
define('XDATA_DATA_TABLE', $prefix.'_bbxdata_data');
define('XDATA_AUTH_TABLE', $prefix.'_bbxdata_auth');

// Attachment-Mod
define('ATTACH_CONFIG_TABLE', $prefix.'_bbattachments_config');
define('EXTENSION_GROUPS_TABLE', $prefix.'_bbextension_groups');
define('EXTENSIONS_TABLE', $prefix.'_bbextensions');
define('FORBIDDEN_EXTENSIONS_TABLE', $prefix.'_bbforbidden_extensions');
define('ATTACHMENTS_DESC_TABLE', $prefix.'_bbattachments_desc');
define('ATTACHMENTS_TABLE', $prefix.'_bbattachments');
define('QUOTA_TABLE', $prefix.'_bbattach_quota');
define('QUOTA_LIMITS_TABLE', $prefix.'_bbquota_limits');

// Statistics-Mod
define('MODULES_TABLE', $prefix.'_bbstats_modules');
define('MODULE_INFO_TABLE', $prefix.'_bbstats_module_info');
define('STATS_CONFIG_TABLE', $prefix.'_bbstats_config');
define('CACHE_TABLE', $prefix.'_bbstats_module_cache');
define('MODULE_ADMIN_TABLE', $prefix.'_bbstats_module_admin_panel');
define('SMILIE_INDEX_TABLE', $prefix.'_bbstats_smilies_index');
define('SMILIE_INFO_TABLE', $prefix.'_bbstats_smilies_info');
define('MODULE_GROUP_AUTH_TABLE', $prefix.'_bbstats_module_group_auth');

// XData
define('XD_AUTH_ALLOW', 1);
define('XD_AUTH_DENY', 0);
define('XD_AUTH_DEFAULT', 2);

define('XD_DISPLAY_NORMAL', 1);
define('XD_DISPLAY_ROOT', 2);
define('XD_DISPLAY_NONE', 0);

define('XD_REGEXP_MANDITORY', "/.+/");
define('XD_REGEXP_LETTERS', "/^[(A-Z)|(a-z)]{1,}$/");
define('XD_REGEXP_NUMBERS', "/^[0-9]{1,}$/");

// Report Posts
define('REPORT_POST_NEW', 1);
define('REPORT_POST_CLOSED', 2);

// Forum ACP-Links
define('ADMIN_NUKE', $admin_file.'.php');
define('HOME_NUKE', 'index.php');

// Advanced Time Management
define('MANUAL', 0);
define('MANUAL_DST', 1);
define('SERVER_SWITCH', 2);
define('FULL_SERVER', 3);
define('SERVER_PC', 4);
define('FULL_PC', 6);

// Log Moderator Actions
define('LOG_ACTIONS_VERSION', '1.1.6');

// At-A-Glance
define('GLANCE_NONE', 0);
define('GLANCE_ALL', 1);
define('GLANCE_INDEX', 2);
define('GLANCE_FORUMS', 3);
define('GLANCE_TOPICS', 4);
define('GLANCE_INDEX_AND_TOPICS', 5);
define('GLANCE_INDEX_AND_FORUMS', 6);
define('GLANCE_FORUMS_AND_TOPICS', 7);
define('GLANCE_CATEGORIE', 8);
define('GLANCE_INDEX_AND_CATEGORIE', 9);
define('GLANCE_INDEX_AND_CATEGORIE_AND_FORUM', 10);

// Attachment Debug Mode
define('ATTACH_DEBUG', 0);                  // Attachment Mod Debugging off
//define('ATTACH_DEBUG', 1);                // Attachment Mod Debugging on

// Download Modes
define('INLINE_LINK', 1);
define('PHYSICAL_LINK', 2);

// Categories
define('NONE_CAT', 0);
define('IMAGE_CAT', 1);
define('STREAM_CAT', 2);
define('SWF_CAT', 3);

// Misc
define('MEGABYTE', 1024);
define('ADMIN_MAX_ATTACHMENTS', 50);        // Maximum Attachments in Posts or PM's for Admin Users
define('THUMB_DIR', 'thumbs');
define('MODE_THUMBNAIL', 1);

// Forum Extension Group Permissions
define('GPERM_ALL', 0);                     // ALL FORUMS

// Quota Types
define('QUOTA_UPLOAD_LIMIT', 1);
define('QUOTA_PM_LIMIT', 2);

define('ATTACH_VERSION', '2.4.5');

// Empty Image Default
define('EMPTY_IMAGE', 'spacer.gif');

/*--ARCADE MOD #2--*/

?>