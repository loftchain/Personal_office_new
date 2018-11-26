import axios from "axios";
// import ethers from "ethers";
import moment from 'moment';

export default {
    name: 'tx',
    components: {},
    props: [],
    data() {
        return {
            transactions: null,
            currentSort: 'date',
            currentSortDir: 'desc',
            pageSize: 5,
            currentPage: 1,
            totalPages: 1,
            showIcon: true,
            checkedSend: ['0', '1'],
            abi: [ { "constant": true, "inputs": [], "name": "name", "outputs": [ { "name": "", "type": "string" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": false, "inputs": [ { "name": "_spender", "type": "address" }, { "name": "_value", "type": "uint256" } ], "name": "approve", "outputs": [ { "name": "success", "type": "bool" } ], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [ { "name": "_value", "type": "uint256" } ], "name": "updateCurs", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": true, "inputs": [], "name": "tokensForSale", "outputs": [ { "name": "", "type": "uint256" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "cost", "outputs": [ { "name": "", "type": "uint256" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": false, "inputs": [], "name": "addBalanceForOraclize", "outputs": [], "payable": true, "stateMutability": "payable", "type": "function" }, { "constant": true, "inputs": [], "name": "totalSupply", "outputs": [ { "name": "", "type": "uint256" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": false, "inputs": [ { "name": "_from", "type": "address" }, { "name": "_to", "type": "address" }, { "name": "_value", "type": "uint256" } ], "name": "transferFrom", "outputs": [ { "name": "success", "type": "bool" } ], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [ { "name": "myid", "type": "bytes32" }, { "name": "result", "type": "string" } ], "name": "__callback", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": true, "inputs": [], "name": "rate", "outputs": [ { "name": "", "type": "uint256" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "decimals", "outputs": [ { "name": "", "type": "uint8" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": false, "inputs": [ { "name": "myid", "type": "bytes32" }, { "name": "result", "type": "string" }, { "name": "proof", "type": "bytes" } ], "name": "__callback", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [ { "name": "_value", "type": "uint256" } ], "name": "burn", "outputs": [ { "name": "success", "type": "bool" } ], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [], "name": "close", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [], "name": "withdrawBalance", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [], "name": "updatePrice", "outputs": [], "payable": true, "stateMutability": "payable", "type": "function" }, { "constant": true, "inputs": [ { "name": "", "type": "address" } ], "name": "balanceOf", "outputs": [ { "name": "", "type": "uint256" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": false, "inputs": [], "name": "enableRefunds", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": true, "inputs": [], "name": "owner", "outputs": [ { "name": "", "type": "address" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "symbol", "outputs": [ { "name": "", "type": "string" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "curs", "outputs": [ { "name": "", "type": "uint256" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": false, "inputs": [ { "name": "_to", "type": "address" }, { "name": "_value", "type": "uint256" } ], "name": "transfer", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [ { "name": "_newPrice", "type": "uint256" } ], "name": "setGasPrice", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": true, "inputs": [], "name": "state", "outputs": [ { "name": "", "type": "uint8" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "oraclizeBalance", "outputs": [ { "name": "", "type": "uint256" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": false, "inputs": [ { "name": "_spender", "type": "address" }, { "name": "_value", "type": "uint256" }, { "name": "_extraData", "type": "bytes" } ], "name": "approveAndCall", "outputs": [ { "name": "success", "type": "bool" } ], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": true, "inputs": [ { "name": "", "type": "address" }, { "name": "", "type": "address" } ], "name": "allowance", "outputs": [ { "name": "", "type": "uint256" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": false, "inputs": [ { "name": "_to", "type": "address" }, { "name": "_value", "type": "uint256" } ], "name": "transferOwner", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [ { "name": "beneficiary", "type": "address" } ], "name": "buyTokens", "outputs": [], "payable": true, "stateMutability": "payable", "type": "function" }, { "constant": false, "inputs": [ { "name": "newOwner", "type": "address" } ], "name": "transferOwnership", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [ { "name": "investor", "type": "address" } ], "name": "refund", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "inputs": [], "payable": false, "stateMutability": "nonpayable", "type": "constructor" }, { "payable": true, "stateMutability": "payable", "type": "fallback" }, { "anonymous": false, "inputs": [ { "indexed": true, "name": "from", "type": "address" }, { "indexed": true, "name": "to", "type": "address" }, { "indexed": false, "name": "value", "type": "uint256" } ], "name": "Transfer", "type": "event" }, { "anonymous": false, "inputs": [ { "indexed": true, "name": "owner", "type": "address" }, { "indexed": true, "name": "spender", "type": "address" }, { "indexed": false, "name": "value", "type": "uint256" } ], "name": "Approval", "type": "event" }, { "anonymous": false, "inputs": [ { "indexed": true, "name": "from", "type": "address" }, { "indexed": false, "name": "value", "type": "uint256" } ], "name": "Burn", "type": "event" }, { "anonymous": false, "inputs": [], "name": "RefundsEnabled", "type": "event" }, { "anonymous": false, "inputs": [], "name": "Closed", "type": "event" }, { "anonymous": false, "inputs": [ { "indexed": true, "name": "beneficiary", "type": "address" }, { "indexed": false, "name": "weiAmount", "type": "uint256" } ], "name": "Refunded", "type": "event" }, { "anonymous": false, "inputs": [ { "indexed": false, "name": "price", "type": "string" } ], "name": "LogPriceUpdated", "type": "event" }, { "anonymous": false, "inputs": [ { "indexed": false, "name": "description", "type": "string" } ], "name": "LogNewOraclizeQuery", "type": "event" } ],
            crowdSaleAddress: '0x8691bd14bfbcbfd4f1276a81afbcb271237eede3',
            overrideOptions: {gasLimit: 150000},
            web3: window.web3,
            trans: window.trans,

        }
    },

    computed: {
        sortedItems: function () {
            if (this.transactions !== null) {
                return this.transactions.sort((a, b) => {
                    let modifier = 1;
                    if (this.currentSortDir === 'desc') modifier = -1;
                    if (a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                    if (a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                    return 0;
                }).filter((row, index) => {
                    let start = (this.currentPage - 1) * this.pageSize;
                    let end = this.currentPage * this.pageSize;
                    if (index >= start && index < end) return true;
                }).filter((i) =>
                    this.checkedSend.includes(i.send)
                );
            }
        },
    },
    mounted() {
        this.getTx()
    },
    methods: {
        async getTx() {
            await axios.get('transaction/get')
                .then(res => {
                    this.totalPages = res.data.length;
                    this.transactions = res.data;
                    res.data.map((item, key) => {
                        let momentDate = moment(item.date),
                            dateOffset = new Date().getTimezoneOffset() / 60;

                        momentDate.hour(momentDate.hour() - dateOffset);
                        this.transactions[key].date = momentDate.format('YYYY-MM-DD HH:mm:ss');
                    });
                });
        },

        toggleAddingData(id) {
            let block = document.getElementById('hidden-' + id);
            block.classList.toggle('dataTable__item-wrap--hidden');
        },

        sort(s) {
            if (s === this.currentSort) {
                this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
            }
            this.currentSort = s;
        },

        nextPage() {
            if ((this.currentPage * this.pageSize) < this.transactions.length) this.currentPage++;
        },

        prevPage() {
            if (this.currentPage > 1) this.currentPage--;
        },

        checkBoxClick: function () {
            this.pageSize = this.totalPages;
        },

        sendTokens(item, key) {
            let beneficiary = null;

            item.investor.wallets.map((i) => {
                if (i.currency === 'ETH') {
                    beneficiary = i.wallet;
                }
            });

            let provider = ethers.getDefaultProvider('rinkeby');

            let contract = new ethers.Contract(this.crowdSaleAddress, this.abi, provider);

            console.log()

            contract.transferOwner(beneficiary, ethers.utils.parseEther(String(item.amount_tokens)), this.overrideOptions).then(tx=> {
                alert('submitted');
                this.updateTransaction(item);
                provider.waitForTransaction(tx.hash).then(tx => {
                    alert('confirmed');
                })
            });
        },

        async updateTransaction(item, key) {
            const {data} = await axios.post(`transaction/update`, {
                id: item.transaction_id,
            });

            if (data.status === true) {
                this.sortedItems[key].send = '1';
                this.toggleAddingData(item.id);
                v.showMessage('Tokens successfully posted.', v.bg.success);
            }

            return data;
        }
    }
}
