<script>
    let ver = {
        checkbox: $('#agreement'),
        form: $('#formKyc :input'),
        content: $('#divContent'),
        personal: '{{ $personal }}'
    };

    $(document).ready(() => {
        ver.form.attr("disabled", true);

        if (!ver.personal) {
          $($('button')[1]).hide();
        }else {
            ver.checkbox.attr('disabled', true)
        }
    });

    ver.checkbox.click(() => {
        if(ver.checkbox.is(':checked')) {
            ver.form.attr("disabled", false);
            ver.content.removeClass('basicBlock__content--verification');
          $($('button')[1]).show();
        }else {
            ver.form.attr("disabled", true);
            ver.content.addClass('basicBlock__content--verification');
            $($('button')[1]).hide();
        }
    });
</script>