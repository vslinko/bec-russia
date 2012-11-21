$(function () {
    'use strict';

    $('.town-select').each(function () {
        var $this = $(this);
        var $input = $this.find('input[type=hidden]');

        $(this).find('a').click(function () {
            $input.val($(this).attr('data-value'));
            $this.find('.selected').removeClass('selected');
            $(this).addClass('selected');

            return false;
        });
    });

    $('.town-select-href').click(function () {
        $(this).parent().find('.town-select').toggle();

        return false;
    });
});
