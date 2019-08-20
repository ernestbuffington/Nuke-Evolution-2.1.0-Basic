<!--//
function _dom_menu()
{
    return this;
}
    _dom_menu.prototype.objref = function(id)
    {
        return document.getElementById ? document.getElementById(id) : (document.all ? document.all[id] : (document.layers ? document.layers[id] : null));
    }
    _dom_menu.prototype.cancel_event = function()
    {
        if ( window.event )
        {
            window.event.cancelBubble = true;
        }
    }

    _dom_menu.prototype.set = function(menu) {
        var menus = new Array(
            'reginfo',
            'profileinfo',
<!-- BEGIN switch_avatar_block -->
            'avatarinfo',
<!-- END switch_avatar_block -->
            'prefinfo'
        );
        var object;
        var opt;
        var flag;
        for (i=0; i < menus.length; i++)
        {
            cur_menu = menus[i];
            object = this.objref(cur_menu);
            if ( object && object.style )
            {
                object.style.display = (cur_menu == menu) ? '' : 'none';
            }
            opt = this.objref(cur_menu + '_opt');
            if ( opt && opt.style )
            {
                opt.style.fontWeight = (cur_menu == menu) ? 'bold' : '';
            }
            flag = this.objref(cur_menu + '_flag');
            if ( flag && flag.style )
            {
                flag.style.fontWeight = (cur_menu == menu) ? 'bold' : '';
            }
        }
<!-- BEGIN switch_avatar_block -->
        pic = this.objref('avatarinfo_cur');
        if ( pic && pic.style )
        {
            pic.style.display = ( menu == 'avatarinfo' ) ? '' : 'none';
        }
<!-- END switch_avatar_block -->
        this.cancel_event();
    }

// instantiate
dom_menu = new _dom_menu();
//-->