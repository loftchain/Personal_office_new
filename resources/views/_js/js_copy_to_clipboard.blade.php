<script>
    let copy = {
        input: $('.icoForm__input--canCopy'),
        button: $('.icoForm__copy'),
    };

    copy.button.click((e) => {
        let input = $(e.target).prev();
        input.select();
        document.execCommand('copy');
        input.append(' ');
        input.val().slice(0, -1);
    });
</script>