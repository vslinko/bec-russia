$(function () {
    $(".news-item").mouseenter(function(){
      var target = $(this),
        fig = target.find('figure'),
        bigger = fig.clone();
    
      bigger.addClass('bigger');
      bigger.css({
          'position': 'absolute',
          'margin-left': '-3px',
          'margin-top': '-3px',
      });
      
      bigger.find('img').css({
          'width': fig.width() + 6,
          'height': fig.width() + 6
      });
      
      fig.before(bigger);
    }).mouseleave(function(){
      $(this).find('figure.bigger').remove();
    });
});