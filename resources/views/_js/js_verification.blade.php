<script>
    let ver = {
        checkbox: $('#agreement'),
        form: $('#formKyc'),
        inputs: $('#formKyc :input'),
        content: $('#divContent'),
        personal: '{{ $personal }}',
        button: $('button[type="submit"]'),
    };

    $(document).ready(() => {
        ver.inputs.attr("disabled", true);

        if (!ver.personal) {
          ver.button.hide();
        }else {
            ver.checkbox.attr('disabled', true);
        }

        let fineUploader = $('#fine-uploader-gallery');
        let inputFile = fineUploader.find('input[type="file"]');
        let inputList = fineUploader.find('.qq-upload-list');
        let inputText = fineUploader.find('.qq-upload-button div');

        inputFile.on('input', function() {
          inputText.hide();
            ver.button.attr('disabled', false);
        });
    });

    ver.checkbox.click(() => {
        if(ver.checkbox.is(':checked')) {
            ver.inputs.attr("disabled", false);
            ver.content.removeClass('basicBlock__content--verification');
            ver.button.show();
            ver.button.attr('disabled', true);
        }else {
            ver.inputs.attr("disabled", true);
            ver.content.addClass('basicBlock__content--verification');
            ver.button.hide();
        }
    });
</script>