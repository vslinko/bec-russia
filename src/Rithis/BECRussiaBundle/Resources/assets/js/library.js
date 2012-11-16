$(function () {
    $('.library .filtering select').change(function () {
        $(this).find('option:selected').each(function () {
           window.location = $(this).attr('data-href');
        });
    });
});