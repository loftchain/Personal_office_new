<script>
    $('document').ready(function () {
      $('.mainMenu__link').each(function() {
        if($(this).attr('href') == window.location.href) {
          $(this).parent().addClass('mainMenu__item--active');
        }
      });
    });
</script>