<script>
    let ver = {
        checkbox: $('#agreement'),
        form: $('#formKyc'),
        inputs: $('#formKyc :input'),
        content: $('#divContent'),
        personal: '{{ $personal }}',
        button: $('button[type="submit"]')
    };

    $(document).ready(() => {
        ver.inputs.attr("disabled", true);

        if (!ver.personal) {
          ver.button.hide();
        }else {
            ver.checkbox.attr('disabled', true)
        }
    });

    ver.checkbox.click(() => {
        if(ver.checkbox.is(':checked')) {
            ver.inputs.attr("disabled", false);
            ver.content.removeClass('basicBlock__content--verification');
            ver.button.show();
        }else {
            ver.inputs.attr("disabled", true);
            ver.content.addClass('basicBlock__content--verification');
            ver.button.hide();
        }
    });
</script>