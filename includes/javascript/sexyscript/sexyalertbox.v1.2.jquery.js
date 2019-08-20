/**
 * Sexy Alert Box - for mootools 1.2 - jQUery 1.3
 * @name sexyalertbox.v1.2.js
 * @author Eduardo D. Sada - http://www.coders.me/web-js-html/javascript/sexy-alert-box
 * @version 1.2.1
 * @date 27-Feb-2009
 * @copyright (c) 2009 Eduardo D. Sada (www.coders.me)
 * @license MIT - http://es.wikipedia.org/wiki/Licencia_MIT
 * @example http://www.coders.me/ejemplos/sexy-alert-box/
 * @based in <PBBAcpBox> (Pokemon_JOJO, <http://www.mibhouse.org/pokemon_jojo>)
 * @thanks to Pokemon_JOJO!
 * @features:
 * * Chain Implemented (Cola de mensajes)
 * * More styles (info, error, alert, prompt, confirm)
 * * ESC would close the window
 * * Focus on a default button
*/

/*
Class: SexyAlertBox
	Clone class of original javascript function : 'alert', 'confirm' and 'prompt'

Arguments:
	options - see Options below

Options:
	name - name of the box for use different style
	zIndex - integer, zindex of the box
	onReturn - return value when box is closed. defaults to false
	onReturnFunction - a function to fire when return box value
	BoxStyles - stylesheets of the box
	OverlayStyles - stylesheets of overlay
	showDuration - duration of the box transition when showing (defaults to 200 ms)
	showEffect - transitions, to be used when showing
	closeDuration - Duration of the box transition when closing (defaults to 100 ms)
	closeEffect - transitions, to be used when closing
	onShowStart - a function to fire when box start to showing
	onCloseStart - a function to fire when box start to closing
	onShowComplete - a function to fire when box done showing
	onCloseComplete - a function to fire when box done closing
*/

var IE = /*@cc_on!@*/false;
var ie_width = '';
var ie_height = '';

$(document).ready(function(){
  Sexy.initialize();
});

jQuery.bind = function(object, method){
  var args = Array.prototype.slice.call(arguments, 2);  
  return function() {
    var args2 = [this].concat(args, $.makeArray( arguments ));  
    return method.apply(object, args2);  
  };  
};  

jQuery.fn.delay = function(time,func){
	return this.each(function(){
		setTimeout(func,time);
	});
};


jQuery.fn.extend({
  $chain : [],
  chain: function(fn) {
    this.$chain.push(fn);
    return this;
  },
  callChain: function(context) {
    return (this.$chain.length) ? this.$chain.pop().apply(context, arguments) : false;
  },
  clearChain: function(){
    this.$chain.empty();
    return this;
  }
});

(function($) {

  Sexy = {
    getOptions: function() {
      return {
        name            : 'SexyAlertBox',
        zIndex          : 65555,
        onReturn        : false,
        onReturnFunction: function(e) {},
        BoxStyles       : { 'width': 500 },
        OverlayStyles   : { 'backgroundColor': '#000', 'opacity': opacity=0.7 },
        showDuration    : 500,
        closeDuration   : 500,
        moveDuration    : 1000,
        onCloseComplete : $.bind(this, function() {
          this.options.onReturnFunction(this.options.onReturn);
        })
      };
    },

    initialize: function(options) {
               
      this.i=0;
      this.options = $.extend(this.getOptions(), options);
			$('body').append('<div id="BoxOverlay"></div><div id="'+this.options.name+'-Box"><div id="'+this.options.name+'-InBox"><div id="'+this.options.name+'-BoxContent"><div id="'+this.options.name+'-BoxContenedor"></div></div></div></div>');
			
			this.Content    = $('#'+this.options.name+'-BoxContenedor');
			this.Contenedor = $('#'+this.options.name+'-BoxContent');
			this.InBox      = $('#'+this.options.name+'-InBox');
			this.Box        = $('#'+this.options.name+'-Box');
            
            if(IE){
                ie_width = 0;
                ie_height = 0;
            }else{
                ie_width    = $(document).width();
                ie_height   = $(document).height();
            }
            
			
			$('#BoxOverlay').css({
                position        : 'absolute',
                top             : 0,
                left            : 0,
                opacity         : this.options.OverlayStyles.opacity,
				backgroundColor : this.options.OverlayStyles.backgroundColor,
				'z-index'       : this.options.zIndex,
                height          : ie_height,
				width           : ie_width
			}).hide();
			
			this.Box.css({
                display         : 'none',
                position        : 'absolute',
                top             : 0,
                left            : 0,
				'z-index'       : this.options.zIndex + 2,
				width           : this.options.BoxStyles.width + 'px'
			});

//      this.preloadImages();

      $(window).bind('resize', $.bind(this, function(){
        if(this.options.display == 1) {
          $('#BoxOverlay').css({
            height          : 0,
            width           : 0
          });
          $('#BoxOverlay').css({
            height          : $(document).height(),
            width           : $(document).width()
          });
          this.replaceBox();
        }
      }));

      this.Box.bind('keydown', $.bind(this, function(obj, event){
        if (event.keyCode == 27){
          this.options.onReturn = false;
          this.display(0);
        }      
      }));

      $(window).bind('scroll', $.bind(this, function(){
        this.replaceBox();
      }));
			
    },

    replaceBox: function() {
      if(this.options.display == 1) {
        
        this.Box.stop();
        
        this.Box.animate({
          left  : ( ($(document).width() - this.options.BoxStyles.width) / 2),
          top   : ( $(document).scrollTop() + ($(window).height() - this.Box.outerHeight()) / 2 )
        }, {
          duration  : this.options.moveDuration,
          easing    : 'easeOutBack'
        });

        $(this).delay(this.options.moveDuration, $.bind(this, function() {
          $('#BoxAlertBtnOk').focus();
          $('#BoxPromptInput').focus();
          $('#BoxConfirmBtnOk').focus();
        }));
      }
    },

    display: function(option) {
      if(this.options.display == 0 && option != 0 || option == 1) {


        if (!$.support.maxHeight) { //IE6
          $('embed, object, select').css({ 'visibility' : 'hidden' });
        }


        this.togFlashObjects('hidden');

        this.options.display = 1;


        $('#BoxOverlay').stop();
        $('#BoxOverlay').fadeIn(this.options.showDuration, $.bind(this, function(){
          this.Box.css({
            display         : 'block',
            left            : ( ($(document).width() - this.options.BoxStyles.width) / 2)
          });
          this.replaceBox();
        }));
      
      } else {

        this.Box.css({
          display         : 'none',
          top             : 0
        });

        this.options.display = 0;

        $(this).delay(500, $.bind(this, this.queue));

        $(this.Content).empty();
        this.Content.removeClass();

        if(this.i==1) {
          $('#BoxOverlay').stop();
          $('#BoxOverlay').fadeOut(this.options.closeDuration, $.bind(this, function(){
            $('#BoxOverlay').hide();
            if (!$.support.maxHeight) { //IE6
              $('embed, object, select').css({ 'visibility' : 'visible' });
            }

            this.togFlashObjects('visible');

            this.options.onCloseComplete.call();
          }));
        }
      }
    },

    messageBox: function(type, message, properties, input) {
        
        $(this).chain(function () {

        properties = $.extend({
          'textBoxBtnOk'        : 'OK',
          'textBoxBtnCancel'    : 'Cancelar',
          'textBoxInputPrompt'  : null,
          'password'            : false,
          'onComplete'          : function(e) {}
        }, properties || {});

        this.options.onReturnFunction = properties.onComplete;

        this.Content.append('<div id="'+this.options.name+'-Buttons"></div>');
        if(type == 'alert' || type == 'info' || type == 'error' || type == 'done')
        {
            $('#'+this.options.name+'-Buttons').append('<input id="BoxAlertBtnOk" type="submit" />');
            
            $('#BoxAlertBtnOk').val(properties.textBoxBtnOk).css({'width':70});
            
            $('#BoxAlertBtnOk').bind('click', $.bind(this, function(){
              this.options.onReturn = true;
              this.display(0);
            }));
                      
            if(type == 'alert') {
              clase = 'BoxAlert';
            } else if(type == 'error') {
              clase = 'BoxError';
            } else if(type == 'info') {
              clase = 'BoxInfo';
            } else if(type == 'done') {
              clase = 'BoxDone';
            }
            
            this.Content.addClass(clase).prepend(message);
            this.display(1);

        }
        else if(type == 'confirm')
        {

            $('#'+this.options.name+'-Buttons').append('<input id="BoxConfirmBtnOk" type="submit" /> <input id="BoxConfirmBtnCancel" type="submit" />');
            $('#BoxConfirmBtnOk').val(properties.textBoxBtnOk).css({'width':70});
            $('#BoxConfirmBtnCancel').val(properties.textBoxBtnCancel).css({'width':70});

            $('#BoxConfirmBtnOk').bind('click', $.bind(this, function(){
              this.options.onReturn = true;
              this.display(0);
            }));

            $('#BoxConfirmBtnCancel').bind('click', $.bind(this, function(){
              this.options.onReturn = false;
              this.display(0);
            }));

            this.Content.addClass('BoxConfirm').prepend(message);
            this.display(1);
        }
        else if(type == 'prompt')
        {

            $('#'+this.options.name+'-Buttons').append('<input id="BoxPromptBtnOk" type="submit" /> <input id="BoxPromptBtnCancel" type="submit" />');
            $('#BoxPromptBtnOk').val(properties.textBoxBtnOk).css({'width':70});
            $('#BoxPromptBtnCancel').val(properties.textBoxBtnCancel).css({'width':70});
                        
            type = properties.password ? 'password' : 'text';

            this.Content.prepend('<input id="BoxPromptInput" type="'+type+'" />');
            $('#BoxPromptInput').val(properties.input);
            $('#BoxPromptInput').css({'width':250});

            $('#BoxPromptBtnOk').bind('click', $.bind(this, function(){
              this.options.onReturn = $('#BoxPromptInput').val();
              this.display(0);
            }));

            $('#BoxPromptBtnCancel').bind('click', $.bind(this, function(){
              this.options.onReturn = false;
              this.display(0);
            }));

            this.Content.addClass('BoxPrompt').prepend(message + '<br />');
            this.display(1);
        }
        else
        {
            this.options.onReturn = false;
            this.display(0);		
        }

      });

      this.i++;

      if(this.i==1) {
        $(this).callChain(this);
      }
    },

    queue: function() {
      this.i--;
      $(this).callChain(this);
    },

    chk: function (obj) {
      return !!(obj || obj === 0);
    },

    togFlashObjects: function(state) {
      var hideobj=new Array("embed", "iframe", "object");
      for (y = 0; y < hideobj.length; y++) {
       var objs = document.getElementsByTagName(hideobj[y]);
       for(i = 0; i < objs.length; i++) {
        objs[i].style.visibility = state;
       }
      }
    },

// This function was causing a few URL errors under Nuke Evolution - RTC4EVER - fixed and tested under FF 3.6.3 // IE8 // Safari 4.0.5



/* needs to be tested by this one

*/   

    /*
    Property: done
      Shortcut for done
      
    Argument:
      properties - see Options in messageBox
    */ 
    done: function(message, properties) {
      this.messageBox('done', message, properties);
    },
    /*
    Property: alert
      Shortcut for alert
      
    Argument:
      properties - see Options in messageBox
    */		
    alert: function(message, properties) {
      this.messageBox('alert', message, properties);
    },

    /*
    Property: info
      Shortcut for alert info
      
    Argument:
      properties - see Options in messageBox
    */		
    info: function(message, properties){
      this.messageBox('info', message, properties);
    },

    /*
    Property: error
      Shortcut for alert error
      
    Argument:
      properties - see Options in messageBox
    */		
    error: function(message, properties){
      this.messageBox('error', message, properties);
    },

    /*
    Property: confirm
      Shortcut for confirm
      
    Argument:
      properties - see Options in messageBox
    */
    confirm: function(message, properties){
      this.messageBox('confirm', message, properties);
    },

    /*
    Property: prompt
      Shortcut for prompt
      
    Argument:
      properties - see Options in messageBox
    */	
    prompt: function(message, input, properties){
      this.messageBox('prompt', message, properties, input);
    }

  };

})(jQuery);

// This is where the sexy tooltip starts
var FixeadorZIndex = 70000;

jQuery.bind = function(object, method){
  var args = Array.prototype.slice.call(arguments, 2);  
  return function() {
    var args2 = [this].concat(args, $.makeArray( arguments ));  
    return method.apply(object, args2);  
  };  
};  

(function($) {

  $.fn.extend({
    tooltip: function(content, options) {
      var John_Resig = {};
      this.each(function() {

        if (!this.OBJtooltip) {
          this.OBJtooltip = new ToolTip().initialize(this, content, options);
        }
        John_Resig = this.OBJtooltip;

      });
      return John_Resig;
    },

    tooltip_hide: function() {
      var John_Resig = {};
      this.each(function() {

        if (this.OBJtooltip) {
          this.OBJtooltip.hide();
          John_Resig = this.OBJtooltip;
        }

      });
      return John_Resig;
    }
  });

  var ToolTip = function() { };
  
  $.extend(ToolTip.prototype, {
    initialize: function (trigger, content, options) {
      var defaults = {
        duration     : 300,
        queue        : false,
        tooltipClass : 'sexy-tooltip',
        style        : 'default',
        width        : 250,
        mode         : 'auto',
        hook         : false,
        mouse        : true,
        click        : false,
        sticky       : 0,
        tip          :
        {
            x : 'c',
            y : 'b'
        }
      };
    
      this.options = $.extend(defaults, options);
      
      this.open = false;
      this.trigger = $(trigger);
      this.trigger.attr('title', '');
      
      if (this.options.mode != 'auto') {
        this.options.tip.y = this.options.mode.toLowerCase().charAt(0);
        this.options.tip.x = this.options.mode.toLowerCase().charAt(1);
      }

      if (this.options.hook || $.browser.msie) {
        this.options.duration = 1; // not animation;
      }

      this.create(); // Crear maqueta html
      this.skeleton.middle.html(content);
      
      if (this.options.hook) {
        this.trigger.bind('mousemove', $.bind(this, this.hook));
      }

      if (this.options.click) {
        this.trigger.bind('click', $.bind(this, this.show));
      }

      if (this.options.mouse && !this.options.click) {
        this.trigger.bind('mouseenter', $.bind(this, this.show));
        if (!this.options.sticky) {
          this.trigger.bind('mouseleave', $.bind(this, this.hide));
        }
      }

      if (this.options.sticky) {
        this.skeleton.close.bind('mouseenter', $.bind(this, this.hide));
      }

      $(window).bind('resize', $.bind(this, function() {
        this.tooltip.css({
          display   : 'none',
          opacity   : 0,
          top       : 0,
          left      : 0
        });
        this.open = false;
      }));

      return this;
    },
    
    create: function() {
      this.tooltip = $('<div class="'+this.options.tooltipClass+'"></div>');
      this.tooltip.css({
        'position'  : 'absolute',
        'top'       : 0,
        'left'      : 0,
        'z-index'   : FixeadorZIndex,
        'display'   : 'none',
        'opacity'   : 0,
        'width'     : this.options.width
      });
      $('body').append(this.tooltip);

      this.skeleton = {};
      
      this.skeleton.style     = $('<div class="'+this.options.style+'"></div>');

      this.skeleton.top_left  = $('<div class="tooltip-tl"></div>').css({width: this.options.width});
      this.skeleton.top_right = $('<div class="tooltip-tr"></div>');
      this.skeleton.top       = $('<div class="tooltip-t"></div>');
      
      this.skeleton.left      = $('<div class="tooltip-l"></div>').css({width: this.options.width});
      this.skeleton.right     = $('<div class="tooltip-r"></div>');
      this.skeleton.middle    = $('<div class="tooltip-m"></div>');
      
      this.skeleton.bottom_left  = $('<div class="tooltip-bl"></div>').css({width: this.options.width});
      this.skeleton.bottom_right = $('<div class="tooltip-br"></div>');
      this.skeleton.bottom       = $('<div class="tooltip-b"></div>');

      this.skeleton.arrow     = $('<div></div>');
      
      // jQuery Shit:
      this.skeleton.style.append ( this.skeleton.top_left.append ( this.skeleton.top_right.append ( this.skeleton.top ) ) );
      this.skeleton.style.append ( this.skeleton.left.append ( this.skeleton.right.append ( this.skeleton.middle ) ) );
      this.skeleton.style.append ( this.skeleton.bottom_left.append ( this.skeleton.bottom_right.append ( this.skeleton.bottom ) ) );

      this.tooltip.append(this.skeleton.style);

      if (this.options.tip.y == 't') {
        this.arrow('top');
      } else if (this.options.tip.y == 'b') {
        this.arrow('bottom');
      }
      if (this.options.tip.x == 'l') {
        this.arrow('left');
      } else if (this.options.tip.x == 'r') {
        this.arrow('right');
      } else if (this.options.tip.x == 'c') {
        this.arrow('center');
      }
      

      if (this.options.sticky) {
        this.skeleton.close = $('<a class="tooltip-close"></a>');
        this.skeleton.top_left.append(this.skeleton.close);
      }
      
    },

    iesucks: function(skeleton) {
      $.each(skeleton, function() {
        $(this[0]).css({ 'background-image' : '' });
        bg = $.curCSS(this[0], 'background-image');
        if (bg) {
          $(this[0]).css({ 'background-image' : bg.replace('.png', '.gif') });
        }
      });
    },
    
    
    hook: function(trigger, event) {
      if (this.open) {
          this.pos = this.position(event);

          this.tooltip.css({
            top  : this.pos.top,
            left : this.pos.left
          });            
      }
    },

    fireevents: function(type) {
      if (type == 1) {
          this.trigger.trigger('tooltipshow');
      } else if (type == 2) {
          this.trigger.trigger('tooltiphide'); // trigger.trigger hahaha
      }
    },

    show: function(trigger, event) {
      if (!this.open) {
        this.pos = this.position(event);
        this.tooltip.css({
          'opacity' : 0,
          'display' : 'block',
          'z-index' : FixeadorZIndex,
          'top'     : this.pos.top,
          'left'    : this.pos.left
        });
        
        this.tooltip.stop();
        this.tooltip.animate({
          opacity : 1,
          top     : this.pos.top - 10
        }, $.extend({}, this.options, {
          complete: $.bind(this, function() {
            this.tooltip.css({ opacity: '' }); // bug de jQuery, en IE deja vivo el opacity aunque sea = 1
                                               // En mootools obvio no pasa esto.
            this.fireevents(1)
          })
        }));

        this.open = true;
        FixeadorZIndex += 1;

        if ($.browser.msie && $.browser.version=="6.0") this.iesucks(this.skeleton);
      }

      if (this.options.click) event.preventDefault();
    },
    
    hide: function() {
      this.tooltip.stop();
      this.tooltip.animate({
        opacity : 0,
        top     : this.pos.top - 20
      }, $.extend({}, this.options, {
        complete: $.bind(this, function() {
          if (!this.open) this.tooltip.css({top:0, left:0});
          this.fireevents(2);
        })
      }));
      this.open = false;
    },

    position: function (event) {
      var position = this.trigger.offset(), size = { x: this.trigger.width(), y: this.trigger.height() };
      var trg  = {
        left    : parseInt(position.left),
        top     : parseInt(position.top),
        width   : size.x,
        height  : size.y,
        right   : position.left + size.x,
        bottom  : position.top + size.y
      };

      var tip = { width: this.tooltip.width(), height: this.tooltip.height() };
      var doc  = {
        width   : $(window).width(),
        height  : $(window).height(),
        y       : $(document).scrollTop(),
        x       : $(document).scrollLeft(),
        right   : $(window).width()
      };
      
      var top  = 0;
      var left = 0;

      if (event) {
        var page = {
          x: event.pageX || event.clientX + window.document.scrollLeft,
          y: event.pageY || event.clientY + window.document.scrollTop
        };

        var trg = $.extend({}, trg, {
            'top'   : page.y,
            'left'  : page.x,
            'width' : 0
        });
      }

      if (this.options.mode == 'auto') { // auto position
          
          top = trg.top - tip.height - 5; // (default)
          if (top > 0 && top > doc.y && top < (doc.y+doc.height)) { // Use bottom arrow (default)
              this.arrow('bottom');
          } else { // Use top arrow
              top = trg.top + 20;
              this.arrow('top');
          }
          
          if (trg.left + (trg.width) + this.options.width < doc.x + doc.right) { // Use left arrow (default)
              left = trg.left + (trg.width) - 20;
              this.arrow('left');
          } else if (trg.left - (tip.width / 2) + (trg.width / 2) + this.options.width < doc.x + doc.right ) { // Use center arrow
              left = trg.left - (tip.width / 2) + (trg.width / 2);
              this.arrow('center');
          } else { // use right arrow
              left = trg.left - (tip.width) + (trg.width) + 20;
              this.arrow('right');
          }
        
      } else { // fixed position

          if (this.options.tip.x=='c') {
            left = trg.left - (tip.width / 2) + (trg.width / 2);
          } else if (this.options.tip.x=='r') {
            left = trg.left - (tip.width) + (trg.width) + 20;
          } else {
            left = trg.left + (trg.width) - 20;
          }
          
          if (this.options.tip.y=='b') {
            top = trg.top - (tip.height) - 5;
          } else if (this.options.tip.y=='t') {
            top = trg.top + 20;
          }

      }
      return { 'top': top, 'left': left };
    },
    
    arrow: function(direction) {
      if (direction == "bottom") {
        if (!this.skeleton.bottom.children(this.skeleton.arrow).length > 0) {
          this.skeleton.bottom.append(this.skeleton.arrow);
        }
      } else if (direction == "top") {
        if (!this.skeleton.top.children(this.skeleton.arrow).length > 0) {
          this.skeleton.top.append(this.skeleton.arrow);
        }
      } else if (direction == "left") {
          this.skeleton.arrow.attr('class', 'tooltip-l-arrow');
      } else if (direction == "right") {
          this.skeleton.arrow.attr('class', 'tooltip-r-arrow');
      } else if (direction == "center") {
          this.skeleton.arrow.attr('class', 'tooltip-c-arrow');
      }

      if ($.browser.msie && $.browser.version=="6.0") {
        this.skeleton.arrow.removeAttr('style');
        this.iesucks({0: this.skeleton.arrow});
      }


    }
  });
})
(jQuery);
