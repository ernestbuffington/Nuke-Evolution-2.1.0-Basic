<!-- BEGIN show_apcp -->
    <tr>
        <th class="thHead" colspan="2">{L_ATTACH_POSTING_CP}</th>
  </tr>
<!-- END show_apcp -->
  <tr>
    <td class="row1" colspan="2">
        <span class="gensmall">
<!-- BEGIN show_apcp -->
            {L_ATTACH_POSTING_CP_EXPLAIN}
<!-- END show_apcp -->
            {S_HIDDEN}
<!-- BEGIN hidden_row -->
            {hidden_row.S_HIDDEN}
<!-- END hidden_row -->
        </span>
    </td>
  </tr>
<!-- BEGIN show_apcp -->
  <tr>
        <td class="row1">
            <span class="gen">
                <strong>{L_OPTIONS}</strong>
            </span>
        </td>
        <td class="row2" nowrap="nowrap">
            <input type="submit" name="add_attachment_box" value="{L_ADD_ATTACHMENT_TITLE}" class="liteoption" />
<!-- END show_apcp -->
<!-- BEGIN switch_posted_attachments -->
            &nbsp;
            <input type="submit" name="posted_attachments_box" value="{L_POSTED_ATTACHMENTS}" class="liteoption" />
<!-- END switch_posted_attachments -->
<!-- BEGIN show_apcp -->
        </td>
    </tr>
<!-- END show_apcp -->
  {ADD_ATTACHMENT_BODY}
  {POSTED_ATTACHMENTS_BODY}