jQuery(function($) {
    $('.main-nav').find('a').each(function() {

        console.log($(this).attr('href'));
        if('https://redfond.ru' + $(this).attr('href') == location) {
            $(this).css('display','inline').css('border','none').css('background','white').css('pointer-events','none').css('cursor','default').css('color','#ef404e').css('padding-left','5px').css('padding-right','5px');
        }
    });


    if(location == 'https://redfond.ru/help/') {
        $('.help-button').css('display','none');
    }




});