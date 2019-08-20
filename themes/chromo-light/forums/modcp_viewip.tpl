<table width="100%" cellspacing="2" cellpadding="2"  align="center">
    <tr>
        <td align="left">
            <span class="nav">
                <a href="{U_INDEX}" class="nav">{L_INDEX}</a>
            </span>
        </td>
    </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1"  class="forumline">
    <tr>
        <th height="25" class="thHead">{L_IP_INFO}</th>
    </tr>
    <tr>
        <td class="catHead" height="28">
            <span class="cattitle">
                <strong>{L_THIS_POST_IP}</strong>
            </span>
        </td>
    </tr>
    <tr>
        <td class="row1">
            <table width="100%" cellspacing="0" cellpadding="0" >
                <tr>
                    <td>
                        <span class="gen">
                            &nbsp;{IP}&nbsp;[&nbsp;{POSTS}&nbsp;]
                        </span>
                    </td>
                    <td align="right">
                        <span class="gen">
                            [&nbsp;<a href="{U_LOOKUP_IP}">{L_LOOKUP_IP}</a>&nbsp;]
                        </span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="catHead" height="28">
            <span class="cattitle">
                <strong>{L_OTHER_USERS}</strong>
            </span>
        </td>
    </tr>
<!-- BEGIN userrow -->
    <tr>
        <td class="{userrow.ROW_CLASS}">
            <table width="100%" cellspacing="0" cellpadding="0" >
                <tr>
                    <td>
                        <span class="gen">
                            &nbsp;<a href="{userrow.U_PROFILE}">{userrow.USERNAME}</a>&nbsp;[&nbsp;{userrow.POSTS}&nbsp;]&nbsp;
                        </span>
                    </td>
                    <td align="right">
                        <a href="{userrow.U_SEARCHPOSTS}" title="{userrow.L_SEARCH_POSTS}"><img src="{SEARCH_IMG}"  alt="{L_SEARCH}" /></a>&nbsp;
                    </td>
                </tr>
            </table>
        </td>
    </tr>
<!-- END userrow -->
    <tr>
        <td class="catHead" height="28">
            <span class="cattitle">
                <strong>{L_OTHER_IPS}</strong>
            </span>
        </td>
    </tr>
<!-- BEGIN iprow -->
    <tr>
        <td class="{iprow.ROW_CLASS}">
            <table width="100%" cellspacing="0" cellpadding="0" >
                <tr>
                    <td>
                        <span class="gen">
                            &nbsp;{iprow.IP}&nbsp;[&nbsp;{iprow.POSTS}&nbsp;]&nbsp;
                        </span>
                    </td>
                    <td align="right">
                        <span class="gen">
                            [&nbsp;<a href="{iprow.U_LOOKUP_IP}">{L_LOOKUP_IP}</a>&nbsp;]&nbsp;
                        </span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
<!-- END iprow -->
</table>

<div style="clear:both;"></div>