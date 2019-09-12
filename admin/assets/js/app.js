
var APP = function() {
    // 触摸设备
	this.is_touch_device = function() {
        return !!('ontouchstart' in window) || !!('onmsgesturechange' in window);
	};

	this.create_modal = function(_title,_name , _modal_tpl){
        if($('#'+_name).length){
            return;
        }
        if(typeof _modal_tpl == 'undefined'){
            _modal_tpl = '';
        }
        var tmpl_html = '<div class="modal " id="'+_name+'" tabindex="-1" role="dialog" aria-labelledby="'+_name+'Label" aria-hidden="true">'
                +'<div class="modal-dialog" role="document">'
                +'<div class="modal-content">'
                +'<div class="modal-header">'
            +'<h5 class="modal-title" id="'+_name+'Label">'+_title+'</h5>'
            +'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
            +'<span aria-hidden="true">&times;</span>'
            +'</button>'
            +'</div>'
            + _modal_tpl
            +'</div>'
            +'</div>'
            +'</div>';
        $('body').append(tmpl_html);
    };
    this.create_basemodal = function(_title,_name , _modal_tpl){
        if($('#'+_name).length){
            return;
        }
        if(typeof _modal_tpl == 'undefined'){
            _modal_tpl = '';
        }
        var tmpl_html = '<div class="modal " id="'+_name+'" tabindex="-1" role="dialog" aria-labelledby="'+_name+'Label" aria-hidden="true">'
            +'</div>';
        $('body').append(tmpl_html);
    };
    this.image_manager = function(){
        APP.create_basemodal('图片管理','image_filemangent');
        $("#image_filemangent").on('show.bs.modal', function (e) {
            var targetname = $(e.relatedTarget).data('targetname');
            var thumb = $(e.relatedTarget).data('thumb');
            $.get(ADMIN_BASEURL + '/filemanager/dialog.php',{modal:'image_filemangent',target:targetname,thumb:thumb,path:''},function(data){
                $("#image_filemangent").html(data);
            });
        });
    }
};

var APP = new APP();

APP.UI = {
    baseUrl:'',
	scrollTop: 0,
};

// Hide sidebar on small screen
$(window).on('load resize', function () {
    if ($(this).width() < 992) {
        $('body').addClass('sidebar-mini fixed-layout');
    }
    if ($(this).width() > 992) {
        $('body').removeClass('sidebar-mini');
    }
});


$(function () {
    //固定菜单
    $('body').addClass('fixed-layout');
    $('#sidebar-collapse').slimScroll({
        height: '100%',
        railOpacity: '0.9',
    });
    // METISMENU 菜单
    $(".metismenu").metisMenu();

    // Tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Popovers
    $('[data-toggle="popover"]').popover();

    // slimscroll
    $('.scroller').each(function(){
        $(this).slimScroll({
            height: $(this).attr('data-height'),
            color: $(this).attr('data-color'),
            railOpacity: '0.9',
        });
    });

    // LAYOUT SETTINGS
    // ======================

    // fa fa-bars 切换到MINI
    $('.js-sidebar-toggler').click(function() {
        $('body').toggleClass('sidebar-mini');
    });


	// BACK TO TOP
	$(window).scroll(function() {
		if($(this).scrollTop() > APP.UI.scrollTop) $('.to-top').fadeIn();
        else $('.to-top').fadeOut();
	});
	$('.to-top').click(function(e) {
		$("html, body").animate({scrollTop:0},500);
	});



    // PANEL ACTIONS
    // ======================

    $('.ibox-collapse').click(function(){
    	var ibox = $(this).closest('div.ibox');
        ibox.toggleClass('collapsed-mode').children('.ibox-body').slideToggle(200);
    });
    $('.ibox-remove').click(function(){
    	$(this).closest('div.ibox').remove();
    });
    $('.fullscreen-link').click(function(){
        if($('body').hasClass('fullscreen-mode')) {
            $('body').removeClass('fullscreen-mode');
            $(this).closest('div.ibox').removeClass('ibox-fullscreen');
            $(window).off('keydown',toggleFullscreen);
        } else {
            $('body').addClass('fullscreen-mode');
            $(this).closest('div.ibox').addClass('ibox-fullscreen');
            $(window).on('keydown', toggleFullscreen);
        }
    });
    function toggleFullscreen(e) {
        // pressing the ESC key - KEY_ESC = 27 
        if(e.which == 27) {
            $('body').removeClass('fullscreen-mode');
            $('.ibox-fullscreen').removeClass('ibox-fullscreen');
            $(window).off('keydown',toggleFullscreen);
        }
    }
    
    // Backdrop functional

    $.fn.backdrop = function() {
	    $(this).toggleClass('shined');
	    $('body').toggleClass('has-backdrop');
        return $(this);
	};

    $('.backdrop').click(closeShined);

    function closeShined() {
        $('body').removeClass('has-backdrop');
        $('.shined').removeClass('shined');
    }

});

$(function () {
    
    // Timepicker
    if($.fn.timepicker) {
        $.fn.timepicker.defaults = $.extend(!0, {}, $.fn.timepicker.defaults, {
            icons: {
                up: "fa fa-angle-up",
                down: "fa fa-angle-down"
            }
        });
    }

});


function redirect(url) {
    window.location.href = url;
}

function uiSelect2() {
    jQuery('.ui-select2').each(function () {
        var el = jQuery(this);
        el.select2();
    });
}

function jquery_validator(_roles, _messages,handler) {
    if(typeof handler !== 'function'){
        handler = function(form) {
            form.submit();
        }
    }
    jQuery('.jq-validate').validate({
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        rules: _roles,
        messages: _messages,
        submitHandler : handler
    });
}

function loadJS(url, callback) {
    if (typeof callback == 'undefined') {
        callback = function () {
        };
    }
    var script = document.createElement("script")
    script.type = "text/javascript";

    if (script.readyState) { //IE
        script.onreadystatechange = function () {
            if (script.readyState == "loaded" || script.readyState == "complete") {
                script.onreadystatechange = null;
                callback();
            }
        };
    } else { //Others
        script.onload = function () {
            callback();
        };
    }

    script.src = url;
    document.getElementsByTagName("head")[0].appendChild(script);
}


function loadCSS(cssFile, callback) {
    var head = document.getElementsByTagName("head")[0];
    var style = document.getElementById("main-style");
    var s = document.createElement("link");
    s.setAttribute("rel", "stylesheet");
    s.setAttribute("type", "text/css");
    s.setAttribute("href", cssFile);
    s.onload = callback;
    head.insertBefore(s, style)

}

function sendFile(file, _url, editor) {
    var data = new FormData();
    data.append("file", file);
    $.ajax({
        data: data,
        type: "POST",
        url: _url,
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {
            editor.summernote('editor.insertImage',url);
        }
    });
}
