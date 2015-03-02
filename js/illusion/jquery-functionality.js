jQuery('html').addClass('d_none');
jQuery(document).ready(function(){

    //jQuery loader
    jQuery('html').show();
    jQuery("body").queryLoader2({
        backgroundColor: '#fff',
        barColor : '#35eef6',
        barHeight: 4,
        percentage:true,
        deepSearch:true,
        minimumTime:1000
    });

    var optionsBootstrap2 = {
        classNamePrefix:   'bvalidator_bootstraprt_',
        offset:               {x:-27, y:-6},
        template:          '<div class="{errMsgClass}"><div class="bvalidator_bootstraprt_arrow"></div><div class="bvalidator_bootstraprt_cont1">{message}</div></div>',
        templateCloseIcon:   '<div style="display:table"><div style="display:table-cell">{message}</div><div style="display:table-cell"><div class="{closeIconClass}">&#215;</div></div></div>',
        position: {x:'left', y:'top'},
        offset: {x:0, y:-4}
    };

    //Validate forms
    jQuery('#validate-form').bValidator(optionsBootstrap2);
    jQuery('#form-validate').bValidator(optionsBootstrap2);
    jQuery('#header-login-form').bValidator(optionsBootstrap2);
    jQuery('#contactform').bValidator(optionsBootstrap2);

    jQuery('#country').attr('data-bvalidator','required');

    jQuery('.fp_item').hover(function () {
        var width = jQuery(this).find('.quick_btn');
        width.css('margin-left', -width.outerWidth()/2);
    }, function () {
        var width = jQuery(this).find('.quick_btn');
        width.css('margin-left','0');
    });

    selectBox();




});

function selectBox(){
    jQuery('.selectbox select').each(function(){
        var title = jQuery('option:selected',this).text();
        if( jQuery('option:selected', this).val() != ''  ) title = jQuery('option:selected',this).text();
        jQuery(this)
            .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
            .after('<span class="select">' + title + '</span>')
            .change(function(){
                val = jQuery('option:selected',this).text();
                jQuery(this).parent().find('span.select').text(val);
            });
    });
}

function selectCurrent(){
    jQuery('.side_main_menu .current').each(function(){
        var parent = jQuery(this).closest('ul');
        var his_parent = parent.closest('li');
        var their_parent = his_parent.closest('ul');
        var root = their_parent.closest('li');
        his_parent.addClass('current');
        root.addClass('current');
        parent.removeClass('d_none');
        their_parent.removeClass('d_none');
    })
}