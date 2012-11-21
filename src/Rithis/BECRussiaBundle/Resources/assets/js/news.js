$(function () {
    var body = $('<div class="reveal-body"></div>'),
        actions = $('<div class="reveal-actions"><a class="close-reveal-modal" href="#"></a></div>'),
        defaultModal = $('<div class="reveal-modal"></div>').append([actions, body]);

    $(".image-preview").click(function (e) {
        var target = $(this),
            modal = defaultModal.clone().appendTo('body');

        modal.on('reveal:close', function (e) {
            modal.remove();
        });

        $('<img>').attr({ src: $(this).attr('href') }).load(function() {
            modal
                .width($(this).width())
                .height($(this).height())
                .css({'margin-left': '-110px'});
            modal.find('.reveal-body').append(this);
            modal.reveal({animation: 'none'});
        });

        return false;
    });
});
