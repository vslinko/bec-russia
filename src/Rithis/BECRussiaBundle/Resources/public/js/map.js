$(function () {
    'use strict';

    $('[data-element=map][data-address]').each(function () {
        var mapElement = this;
        var $mapElement = $(mapElement);

        ymaps.ready(function () {
            var search = ymaps.geocode($mapElement.attr('data-address'));

            search.then(function (result) {
                if (result.geoObjects.getLength() > 0) {
                    var coordinates = result.geoObjects.get(0).geometry.getCoordinates();

                    var map = new ymaps.Map(mapElement, {
                        center: coordinates,
                        zoom: 14
                    });

                    map.geoObjects.add(new ymaps.Placemark(coordinates));
                }
            }, function () {
                $mapElement.hide();
            });
        });
    });

});
