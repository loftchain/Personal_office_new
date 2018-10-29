<script>
    let copy = {
      input: $('.icoForm__input--canCopy'),
      button: $('.icoForm__copy'),
    };

    copy.button.click(() => {
      copy.input[0].select();
      document.execCommand('copy');
      copy.input.append(' ');
      copy.input.val().slice(0, -1);
    });
</script>