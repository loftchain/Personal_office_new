<script>
    Date.prototype.customFormat = function () {
        var yyyy = this.getFullYear(),
            mm = (this.getMonth() + 1) > 9 ? this.getMonth() + 1 : '0' + (this.getMonth() + 1),
            dd = this.getDate() > 9 ? this.getDate() : '0' + this.getMonth(),
            hh = this.getHours() > 9 ? this.getHours() : '0' + this.getHours(),
            min = this.getMinutes() > 9 ? this.getMinutes() : '0' + this.getMinutes(),
            ss = this.getSeconds() > 9 ? this.getSeconds() : '0' + this.getSeconds();

        return yyyy + '-' + mm + '-' + dd + ' ' + hh + ':' + min + ':' + ss

    }

    let time = {
        currentTimeZoneOffset: null,
        trTxTable: $('.tr-tx-table'),

        subTime() {
            this.trTxTable.map((key, item) => {
                let tdDate = item.children[0],
                    date = $(tdDate),
                    x = new Date(Date.parse(date.text()));
                x.setHours(x.getHours() + Math.abs(this.currentTimeZoneOffset));

                date.text(x.customFormat())
            })

        },
    };

    $(document).ready(() => {
        let date = new Date();
        time.currentTimeZoneOffset = date.getTimezoneOffset() / 60;
        time.subTime()
    })
</script>