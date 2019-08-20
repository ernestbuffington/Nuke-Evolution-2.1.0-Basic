<style type="text/css">
<!--
.goline { background-color: #FFFFFF; border: 1px solid #000000; }
-->
</style>

<script language="javascript" type="text/javascript">
<!--

function handleClick(id) {
  var obj = "";

    // Check browser compatibility
    if(document.getElementById)
      obj = document.getElementById(id);
    else if(document.all)
      obj = document.all[id];
    else if(document.layers)
      obj = document.layers[id];
    else
      return 1;

    if (!obj) {
      return 1;
    }
    else if (obj.style)
    {
      obj.style.display = ( obj.style.display != "none" ) ? "none" : "";
    }
    else
    {
      obj.visibility = "show";
    }
}
//-->
</script>

<h1>{L_GO_TITLE}</h1>
<p>{L_GO_TEXT}</p>

<table width="100%"  cellpadding="3" cellspacing="1" class="forumline" align="center">
  <tr>
      <th align="center" colspan="2">&nbsp;{L_GO_GROUP}&nbsp;</th>
      <th align="center">&nbsp;{L_GO_MOD}&nbsp;</th>
      <th align="center">&nbsp;{L_GO_USER}&nbsp;</th>
      <th align="center">&nbsp;{L_GO_STATUS}&nbsp;</th>
  </tr>
<!-- BEGIN groups -->
    <form action="{groups.S_GROUP_ACTION}" id="{groups.GROUP_ID}" method="post" name="post">
        <tr>
            <td align="center" width="18%" class="{groups.ROW_CLASS}" align="center" valign="middle">
                <span class="gensmall">
                    <a href="javascript:handleClick('group{groups.GROUP_ID}');">{L_GO_EDIT}</a>
                </span>
            </td>
          <td align="center" class="{groups.ROW_CLASS}">
              <span class="gen">
                  &nbsp;{groups.GROUP}&nbsp;
              </span>
              <br />
              <span class="gensmall">
                  {groups.GROUP_DESCRIPTION}
              </span>
          </td>
          <td align="center" class="{groups.ROW_CLASS}">
              <span class="gensmall">
                  <a href="{groups.U_MOD}">{groups.MOD}</a>
              </span>
          </td>
            <td align="center" class="{groups.ROW_CLASS}">
                <span class="gensmall">
                    {groups.USERS}
                </span>
            </td>
            <td align="center" class="{groups.ROW_CLASS}" align="center" valign="middle">
                <span class="gensmall">
                    {groups.STATUS}
                </span>
            </td>
      </tr>
    <tr id="group{groups.GROUP_ID}" style="display: none">
        <td class="{groups.ROW_CLASS}" valign="top" align="center" width="15%">
            <span class="gensmall">
                <a href="{groups.U_PERMISSION}">{L_PERMISSION}</a><br />
                <a href="{groups.U_INFORM}">{L_INFORM}</a>
            </span>
        </td>
        <td class="{groups.ROW_CLASS}" colspan="4">
          <table width="100%" cellpadding="3" cellspacing="1"  class="goline">
            <tr>
                      <td class="{groups.ROW_CLASS}">
                          <span class="genmed">
                              <strong>{L_GROUP_NAME}:&nbsp;</strong>
                          </span>
                          <br />
                        <input class="post" type="text" name="group_name" size="35" maxlength="40" value="{groups.GROUP}" />
                      </td>
                  </tr>
                  <tr>
                      <td class="{groups.ROW_CLASS}">
                          <span class="genmed">
                              <strong>{L_GROUP_DESCRIPTION}:&nbsp;</strong>
                          </span>
                          <br />
                            <input class="post" type="text" name="group_description" size="75" maxlength="255" value="{groups.GROUP_DESCRIPTION}" />
                      </td>
                  </tr>
                  <tr>
                      <td class="{groups.ROW_CLASS}">
                          <span class="genmed">
                              <strong>{L_GROUP_MODERATOR}:&nbsp;</strong>
                          </span>
                          <br />
                            <input class="post" type="text" class="post" name="group_mod" maxlength="50" size="20" value="{groups.MOD}" />
                        </td>
                  </tr>
                  <tr>
                      <td class="{groups.ROW_CLASS}">
                          <span class="genmed">
                              <strong>{L_GROUP_STATUS}:&nbsp;</strong>
                          </span>
                          <br />
                        <input type="radio" name="group_type" value="{groups.S_GROUP_OPEN_TYPE}" {groups.S_GROUP_OPEN_CHECKED} />{L_GROUP_OPEN}&nbsp;&nbsp;
                        <input type="radio" name="group_type" value="{groups.S_GROUP_CLOSED_TYPE}" {groups.S_GROUP_CLOSED_CHECKED} />{L_GROUP_CLOSED}&nbsp;&nbsp;
                        <input type="radio" name="group_type" value="{groups.S_GROUP_HIDDEN_TYPE}" {groups.S_GROUP_HIDDEN_CHECKED} />{L_GROUP_HIDDEN}
                    </td>
                  </tr>
                  <tr>
                      <td class="{groups.ROW_CLASS}">
                          <span class="genmed">
                              <strong>{L_DELETE_MODERATOR}</strong>
                          </span>
                          <br />
                        <input type="checkbox" name="delete_old_moderator" value="1" />{L_YES}
                    </td>
                  </tr>
                    <tr>
                      <td class="{groups.ROW_CLASS}">
                          <span class="genmed">
                              <strong>{L_MEMBERS}:&nbsp;</strong>
                          </span>
                          <span class="gensmall">
                              {L_MEMBERS_EXPLAIN}
                          </span>
                          <br />
                        {groups.GROUP_MEMBERS}
                        <br />
                          <span class="genmed">
                              <strong>{L_PENDING_MEMBERS}:&nbsp;</strong>
                          </span>
                          <br />
                        {groups.PENDING_GROUP_MEMBERS}                        
                    </td>
                  </tr>
                    <tr>
                    <td class="{groups.ROW_CLASS}">
                        <span class="genmed">
                            <strong>{L_ADD_MEMBER}:&nbsp;</strong>
                        </span>
                          <br />
                      <span class="genmed">
                          <input type="text" class="post" name="username" maxlength="50" size="20" />&nbsp;&nbsp;
                          <input type="submit" name="add" value="{L_ADD_NEW}" class="mainoption" />&nbsp;&nbsp;
                          <input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" onclick="window.open('{groups.U_SEARCH_USER}', '_phpbbsearch', 'height=250,resizable=yes,width=400');return false;" />
                      </span>
                  </td>
                  </tr>
                  <tr>
                      <td class="{groups.ROW_CLASS}">
                          <span class="genmed">
                              <strong>{L_GROUP_DELETE_USERS}:&nbsp;</strong>
                          </span>
                          <span class="gensmall">
                              {L_GROUP_DELETE_USERS_EXPLAIN}
                          </span>
                          <br />
                        <input type="checkbox" name="group_delete_users" value="1" />{L_GROUP_DELETE_USERS_CHECK}
                    </td>
                  </tr>
                  <tr>
                      <td class="{groups.ROW_CLASS}">
                          <span class="genmed">
                              <strong>{L_GROUP_DELETE}:&nbsp;</strong>
                          </span>
                          <br />
                        <input type="checkbox" name="group_delete" value="1" />{L_GROUP_DELETE_CHECK}
                    </td>
                  </tr>
                    <tr>
                        <td class="row3" height="20" align="center">
                            <input type="submit" name="submit" class="mainoption" value="{L_SUBMIT}" />&nbsp;&nbsp;
                            <input type="hidden" name="group_id" value="{groups.GROUP_ID}" />
                    </td>
                    </tr>
                </table>
            </td>
        </tr>
    </form>
<!-- END groups -->
  <form action="{S_NEW_GROUP_FORM}" method="post">
      <tr>
        <td class="row3" colspan="5" height="20" align="left">
            <input type="submit" name="new" class="liteoption" value="{L_NEW_GROUP}" />
        </td>
        </tr>
  </form>
</table>
<div style="clear:both;"></div>