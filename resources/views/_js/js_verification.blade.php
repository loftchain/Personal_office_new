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
            ver.content.attr('style', 'background-color: whitesmoke');
        }else {
            ver.checkbox.attr('disabled', true)
        }
    });

    ver.checkbox.click(() => {
        if(ver.checkbox.is(':checked')) {
            ver.form.attr("disabled", false);
            ver.content.removeAttr('style');
        }else {
            ver.form.attr("disabled", true);
            ver.content.attr('style', 'background-color: whitesmoke')
        }
    });
</script>