<script>
    let calc = {
        eth_usd: '<?= $calcData['eth_usd'] ?>',
        btc_usd: '<?= $calcData['btc_usd'] ?>',
        roundName: '<?= $calcData['roundName'] ?>',
        currentPrice: '<?= $calcData['currentPrice'] ?>',
        mtsh_input: $('#MTSHInput'),
        usd_input: $('#USDInput'),
        eth_input: $('#ETHInput'),
        btc_input: $('#BTCInput'),

        exchange(input) {
            switch (input) {
                case 'MTSH':
                    let usd0 = calc.mtsh_input.val() * calc.currentPrice;
                    let eth0 = usd0 / calc.eth_usd;
                    let btc0 = usd0 / calc.btc_usd;
                    calc.usd_input.val(usd0);
                    calc.eth_input.val(eth0);
                    calc.btc_input.val(btc0);
                    break;
                case 'USD':
                    let mtsh1 = calc.usd_input.val() / calc.currentPrice;
                    let eth1 = mtsh1 / calc.eth_usd;
                    let btc1 = mtsh1 / calc.btc_usd;
                    calc.mtsh_input.val(mtsh1);
                    calc.eth_input.val(eth1);
                    calc.btc_input.val(btc1);
                    break;
                case 'ETH':
                    let usd2 = calc.eth_input.val() * calc.eth_usd;
                    let mtsh2 = usd2 / calc.currentPrice;
                    let btc2= usd2 / calc.btc_usd;
                    calc.usd_input.val(usd2);
                    calc.mtsh_input.val(mtsh2);
                    calc.btc_input.val(btc2);
                    break;
                case 'BTC':
                    let usd3 = calc.btc_input.val() * calc.btc_usd;
                    let mtsh3 = usd3 / calc.currentPrice;
                    let eth3 = usd3 / calc.eth_usd;
                    calc.usd_input.val(usd3);
                    calc.eth_input.val(eth3);
                    calc.mtsh_input.val(mtsh3);
                    break;
            }
        }
    };

    calc.mtsh_input.on('input', () => {
        calc.exchange('MTSH');
    });

    calc.usd_input.on('input', () => {
        calc.exchange('USD');
    });

    calc.eth_input.on('input', () => {
        calc.exchange('ETH');
    });

    calc.btc_input.on('input', () => {
        calc.exchange('BTC');
    });
</script>
