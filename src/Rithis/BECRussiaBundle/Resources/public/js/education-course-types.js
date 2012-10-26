$(function () {
    'use strict';

    $('[data-element=education-course-types]').each(function () {
        var $element = $(this);
        var $menuItems = $element.find('[data-element=education-course-types-menu-item]');
        var $images = $element.find('[data-element=education-course-types-image]');

        $menuItems.each(function (i) {
            var $menuItem = $(this);
            var $image = $images.eq(i);

            $menuItem.hover(function () {
                $images.hide();
                $image.show();
            });
        });
    });;

});
