<script>

    $('.up-btn').click((e) => {
        let btnId = e.target.attributes.dataid.value;
        $('#data-' + btnId).show();
        $('.up-btn.trans-'+ btnId).hide();
        $('.dn-btn.trans-' + btnId).show();
    });

    $('.dn-btn').click((e) => {
        let btnId = e.target.attributes.dataid.value;
        $('#data-' + btnId).hide();
        $('.up-btn.trans-'+ btnId).show();
        $('.dn-btn.trans-' + btnId).hide();
    });
</script>