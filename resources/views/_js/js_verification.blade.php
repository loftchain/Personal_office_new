<script>
    let ver = {
        checkbox: $('#agreement'),
        form: $('#formKyc :input'),
        content: $('#divContent'),
    };

    $(document).ready(() => {
        ver.form.attr("disabled", true);
        ver.content.attr('style', 'background-color: whitesmoke');
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