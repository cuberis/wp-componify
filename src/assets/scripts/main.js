(function($) {
  let items = document.querySelectorAll('.component');
  const edit_link = '/wp-admin/post.php?action=edit';

  for (let i = 0; items.length > i; i++) {
    let id = $(items[i]).attr('data-id');
    $(items[i]).append(`<a class="component-ui-btn" href="${edit_link}&post=${id}&acf-jumpto=${i}" target="_blank"><span class="dashicons dashicons-edit"></span> Edit</a>`);
  }
})(jQuery);
