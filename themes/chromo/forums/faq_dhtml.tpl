<script language="javascript" type="text/javascript" src="{U_CFAQ_JSLIB}"></script>
<noscript>
<table class="forumline" width="100%" cellspacing="1" cellpadding="3"  align="center">
	<tr>
		<td class="row1" align="center"><span class="gen"><br />{L_CFAQ_NOSCRIPT}<br />&nbsp;</span></td>
	</tr>
</table>
</noscript>

<table width="100%" cellspacing="2" cellpadding="2"  align="center">
	<tr>
		<td align="left" class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
	</tr>
</table>

<table class="forumline" width="100%" cellspacing="1" cellpadding="3"  align="center">
	<tr>
		<th class="thHead">{L_FAQ_TITLE}</th>
	</tr>
</table>

<div style="clear:both;"></div>

<!-- BEGIN faq_block -->
<table class="forumline" width="100%" cellspacing="1" cellpadding="2"  align="center">
	<tr> 
		<td class="catHead" height="28" align="center"><span class="cattitle">{faq_block.BLOCK_TITLE}</span></td>
	</tr>
	<!-- BEGIN faq_row -->  
	<tr> 
 		<td class="{faq_block.faq_row.ROW_CLASS}" align="left" valign="top">
 			<div onclick="return CFAQ.display('faq_a_{faq_block.faq_row.U_FAQ_ID}', false);" style="width:100%;cursor:pointer;cursor:hand;">
				<span class="gen"><a class="postlink" href="javascript:void(0)" onclick="return CFAQ.display('faq_a_{faq_block.faq_row.U_FAQ_ID}', true);" onfocus="this.blur();"><strong>{faq_block.faq_row.FAQ_QUESTION}</strong></a></span>
 			</div>
 			<div id="faq_a_{faq_block.faq_row.U_FAQ_ID}" style="display:none;">
				<table class="bodyline" width="100%" cellspacing="1" cellpadding="3"  align="center">
					<tr>
						<td class="spaceRow"><img src="templates/subSilver/images/spacer.gif" alt="" width="0" height="0" /></td>
					</tr>
					<tr><td align="left" valign="top"><span class="postbody">{faq_block.faq_row.FAQ_ANSWER}<br /></span></td></tr>
					<tr>
						<td class="spaceRow"><img src="templates/subSilver/images/spacer.gif" alt="" width="0" height="0" /></td>
					</tr>
				</table>
			</div>
 		</td>
	</tr>
	<!-- END faq_row -->
</table>

<div style="clear:both;"></div>
<!-- END faq_block -->

<table width="100%" cellspacing="2"  align="center">
	<tr>
		<td align="left" valign="middle" nowrap="nowrap"><span class="copyright">DHTML Collapsible FAQ v1.0.0 &copy; 2004 by <a href="http://www.phpmix.com/" target="_blank" class="copyright">phpMiX</a></span></td>
		<td align="right" valign="middle" nowrap="nowrap"><span class="gensmall">{S_TIMEZONE}</span></td>
	</tr>
	<tr>
		<td colspan="2" align="right" valign="middle" nowrap="nowrap">{JUMPBOX}</td>
	</tr>
</table>
