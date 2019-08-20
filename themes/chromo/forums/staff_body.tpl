<table width="100%" cellspacing="2" cellpadding="2"  align="center">
    <tr>
        <td align="left">
            <a href="{U_INDEX}" class="nav">{L_INDEX}</a>
        </td>
    </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1"  class="forumline">
    <tr>
        <th class="thTop">{L_USERNAME}</th>
        <th class="thTop">{L_FORUMS}</th>
        <th class="thTop">{L_POSTS}</th>
        <th class="thTop">{L_JOINED}</th>
        <th class="thTop">{L_EMAIL}</th>
        <th class="thTop">{L_PM}</th>
        <th class="thTop">{L_MESSENGER}</th>
        <th class="thCornerR">{L_WWW}</th>
    </tr>
<!-- BEGIN staff -->
    <tr>
        <td valign="top" class="row1" nowrap="nowrap">
            <a href="{staff.U_NAME}" class="genmed" >{staff.NAME}</a><br />
            {staff.LEVEL}<br />
            <span class="postdetails">
                {staff.RANK}<br />{staff.RANK_IMAGE}<br />{staff.AVATAR}<br /><br />{staff.ONLINE_STATUS}
            </span>
        </td>
        <td valign="top" class="row2">
            <span class="gensmall">
                {staff.FORUMS}
            </span>
        </td>
        <td valign="top" align="right" class="row1" >
            <span class="gensmall">
                {staff.POSTS}&nbsp;{L_POSTS}<br />{staff.POST_PERCENT}<br />{staff.POST_DAY}<br />[{staff.LAST_POST}]
            </span>
        </td>
        <td valign="top" class="row2" align="right" nowrap="nowrap">
            <span class="gensmall">
                {staff.JOINED}<br />[{staff.PERIOD}]
            </span>
        </td>
        <td align="center" class="row1">
            {staff.MAIL}
        </td>
        <td align="center" class="row2">
            {staff.PM}
        </td>
        <td align="center" class="row1">
            {staff.MSN}<br />{staff.AIM}
            <script language="JavaScript" type="text/javascript">
				           <!-- 
                   if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
		                   document.write('<br />{staff.ICQ_IMG}');
	                 else
		                   document.write('<br /><table cellpadding="0" cellspacing="0"  align="center"><tr><td align="center"><div style="position:relative"><div style="position:relative">{staff.ICQ_IMG}<\/div><div style="position:absolute;left:3px;top:-2px">{staff.ICQ_STATUS_IMG}<\/div><\/div><\/td><\/tr><\/table>');
                	 //-->
            </script>
            <script language="JavaScript" type="text/javascript">
                   <!-- 
                   if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
                       document.write('<br />{staff.YIM_IMG}');
                   else
                       document.write('<br /><table cellpadding="0" cellspacing="0"  align="center"><tr><td align="center"><div style="position:relative"><div style="position:relative">{staff.YIM_IMG}<\/div><div style="position:absolute;left:3px;top:-2px">{staff.YIM_STATUS_IMG}<\/div><\/div><\/td><\/tr><\/table>');
                   //-->
            </script>
            <noscript>
            <br />{staff.ICQ_IMG_NOSCRIPT}<br />{staff.YIM_IMG_NOSCRIPT}
            </noscript>
        </td>
        <td align="center" class="row2">
            {staff.WWW}
        </td>
    </tr>
<!-- END staff -->
</table>