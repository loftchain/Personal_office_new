<script>

    function checkTerms() {
        if ($("#terms_checkbox").prop('checked') == true && $("#essentials_checkbox").prop('checked') == true) {
            $('.signUpBtn').prop('disabled', false);
        } else {
            $('.signUpBtn').prop('disabled', true);
        }
    }

    $('document').ready(function () {
        checkTerms();

        $('.signUpCheckbox').change(() => {
            checkTerms();
        });
    });
</script>
