$(function () {
    Galleria.loadTheme('/bundles/rithisbecrussia/js/galleria/themes/classic/galleria.classic.min.js');

    var body = $('<div class="reveal-body"><img class="preloader" src="/js/galleria/themes/classic/classic-loader.gif" /></div>'),
        actions = $('<div class="reveal-actions"><a class="close-reveal-modal" href="#"></a></div>'),
        defaultModal = $('<div class="reveal-modal"></div>').append([actions, body]);

    $('.gallery-item .thumbnail a, .gallery-item .title a, .gallery-item .links a.full-gallery').click(function (e) {
        e.preventDefault();

        var target = $(this),
            modal = defaultModal.clone().appendTo('body').reveal({animation: 'none'});
        
        modal.on('reveal:close', function (e) {
            $(this).destroy();
        });

        $.getJSON(target.attr('href'), function (response) {
            Galleria.run(modal.find('.reveal-body').empty(), {
                dataSource: response.items
            });
        });
    });
});