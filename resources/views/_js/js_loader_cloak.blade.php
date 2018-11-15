<script>
    $(window).on("load", function () {
        $('.cloak').fadeOut("slow");
    });

    window.addEventListener("orientationchange", function () {
        $('.cloak').fadeOut("slow");
    }, false);

    window.onresize = function () {
        $('.cloak').fadeOut("slow");
    };
</script>
