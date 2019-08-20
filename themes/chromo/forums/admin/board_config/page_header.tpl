<h1>{L_CONFIGURATION_TITLE}</h1>
<p>{L_CONFIGURATION_EXPLAIN}</p>

<!-- BEGIN use_dhtml -->
<script language="javascript" type="text/javascript">
<!--
function show_config(id) {
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
<!-- END use_dhtml -->

<form action="{S_CONFIG_ACTION}" method="post">