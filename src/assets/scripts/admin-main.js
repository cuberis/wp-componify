(function($) {
  let id = new URLSearchParams(window.location.search).get('acf-jumpto'),
    target = $(`.layout[data-id=${id}]`);

  $(document).ready(function() {
    if (target.length) {
      $("html, body").animate({
        scrollTop: target.offset().top - 40
      }, 300, "swing", function() {
        target.addClass("scrolled").removeClass("-collapsed")
      })
    }
  });
})(jQuery);
