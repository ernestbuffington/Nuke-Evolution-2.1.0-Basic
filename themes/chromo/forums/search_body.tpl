<!-- mod : categories hierarchy v 2 -->
<form action="{S_SEARCH_ACTION}" method="post">
    <table width="100%" cellspacing="2" cellpadding="2"  align="center">
        <tr> 
            <td align="left">
                <span class="nav">
                    <a href="{U_INDEX}" class="nav">{L_INDEX}</a>
                </span>
            </td>
        </tr>
    </table>

    <table class="forumline" width="100%" cellpadding="4" cellspacing="1" >
        <tr> 
            <th class="thHead" colspan="4" height="25">{L_SEARCH_QUERY}</th>
        </tr>
        <tr> 
            <td class="row1" colspan="2" width="50%">
                <span class="gen">
                    {L_SEARCH_KEYWORDS}:
                </span>
                <br />
                <span class="gensmall">
                    {L_SEARCH_KEYWORDS_EXPLAIN}
                </span>
            </td>
            <td class="row2" colspan="2" valign="top">
                <span class="genmed">
                    <input type="text" style="width: 300px" class="post" name="search_keywords" size="30" /><br />
                    <input type="radio" name="search_terms" value="any" checked="checked" />&nbsp;{L_SEARCH_ANY_TERMS}<br />
                    <input type="radio" name="search_terms" value="all" />&nbsp;{L_SEARCH_ALL_TERMS}
                </span>
            </td>
        </tr>
        <tr> 
            <td class="row1" colspan="2">
                <span class="gen">
                    {L_SEARCH_AUTHOR}:
                </span>
                <br />
                <span class="gensmall">
                    {L_SEARCH_AUTHOR_EXPLAIN}
                </span>
            </td>
            <td class="row2" colspan="2" valign="middle">
                <span class="genmed">
                    <input type="text" style="width: 300px" class="post" name="search_author" size="30" />
                </span>
            </td>
        </tr>
        <tr> 
            <th class="thHead" colspan="4" height="25">{L_SEARCH_OPTIONS}</th>
        </tr>
        <tr> 
            <td class="row1" align="right">
                <span class="gen">
                    {L_FORUM}:&nbsp;
                </span>
            </td>
            <td class="row2">
                <span class="genmed">
                    <select class="post" name="search_where">{S_FORUM_OPTIONS}</select>
                </span>
            </td>
            <td class="row1" align="right" nowrap="nowrap">
                <span class="gen">
                    {L_SEARCH_PREVIOUS}:&nbsp;
                </span>
            </td>
            <td class="row2" valign="middle">
                <span class="genmed">
                    <select class="post" name="search_time">{S_TIME_OPTIONS}</select><br />
                    <input type="radio" name="search_fields" value="all" checked="checked" />&nbsp;{L_SEARCH_MESSAGE_TITLE}<br />
                    <input type="radio" name="search_fields" value="msgonly" />&nbsp;{L_SEARCH_MESSAGE_ONLY}
                </span>
            </td>
        </tr>
        <tr> 
		        <td class="row1" align="right" nowrap="nowrap">
		            <span class="gen">
		                {L_DISPLAY_RESULTS}:&nbsp;
		            </span>
		        </td>
		        <td class="row2" nowrap="nowrap">
		            <input type="radio" name="show_results" value="posts" />
		            <span class="genmed">
		                {L_POSTS}<input type="radio" name="show_results" value="topics" checked="checked" />{L_TOPICS}
		            </span>
		        </td>
		        <td class="row1" align="right">
		            <span class="gen">
		                {L_SORT_BY}:&nbsp;
		            </span>
		        </td>
		        <td class="row2" valign="middle" nowrap="nowrap">
		            <span class="genmed">
		                <select class="post" name="sort_by">{S_SORT_OPTIONS}</select><br />
		                <input type="radio" name="sort_dir" value="ASC" />&nbsp;{L_SORT_ASCENDING}<br />
		                <input type="radio" name="sort_dir" value="DESC" checked="checked" />&nbsp;{L_SORT_DESCENDING}&nbsp;
		            </span>
		        </td>
	      </tr>
        <tr>
            <td class="row1" align="right">
                <span class="gen">
                    {L_RETURN_FIRST}
                </span>
            </td>
            <td class="row2" colspan="3">
                <span class="genmed">
                    <select class="post" name="return_chars">{S_CHARACTER_OPTIONS}</select>&nbsp;{L_CHARACTERS}
                </span>
            </td>
        </tr>
<!-- BEGIN switch_search_security_code -->
        <tr> 
            <td class="row2" colspan="4" align="center" height="28">
                {L_SEARCH_SECURITY_CODE}
            </td>
        </tr>
<!-- END switch_search_security_code -->
        <tr>
            <td class="catBottom" colspan="4" align="center" height="28">
                {S_HIDDEN_FIELDS}<input class="liteoption" type="submit" value="{L_SEARCH}" />
            </td>
        </tr>
    </table>

    <table width="100%" cellspacing="2" cellpadding="2"  align="center">
        <tr> 
            <td align="right" valign="middle">
                <span class="gensmall">
                    {S_TIMEZONE}
                </span>
            </td>
        </tr>
    </table>
</form>

<table width="100%" >
    <tr>
        <td align="right" valign="top">
            {JUMPBOX}
        </td>
    </tr>
</table>