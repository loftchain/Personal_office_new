import axios from "axios";

export default {
  name: 'tx',
  components: {},
  props: [],
  data () {
    return {
        transactions: null,
        currentSort:'date',
        currentSortDir:'desc',
        pageSize:5,
        currentPage:1,
        totalPages:1,
        showIcon: true,
        checkedSend: ['0', '1']
        // abi: [{"constant":true,"inputs":[],"name":"hasClosed","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"addBalanceForOraclize","outputs":[],"payable":true,"stateMutability":"payable","type":"function"},{"constant":false,"inputs":[{"name":"myid","type":"bytes32"},{"name":"result","type":"string"}],"name":"__callback","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_user","type":"address"}],"name":"delKYC","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"_owner","type":"address"}],"name":"isOwner","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"tokenPriceInWei","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"cap","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"myid","type":"bytes32"},{"name":"result","type":"string"},{"name":"proof","type":"bytes"}],"name":"__callback","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_user","type":"address"}],"name":"addKYC","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"weiRaised","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"closingTime","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"finalize","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"capReached","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"tokensSold","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"wallet","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"currentStage","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_url","type":"string"}],"name":"setOraclizeUrl","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"updatePrice","outputs":[],"payable":true,"stateMutability":"payable","type":"function"},{"constant":false,"inputs":[{"name":"_price","type":"uint256"}],"name":"setTokenPrice","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_newOwner","type":"address"}],"name":"addOwner","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_owner","type":"address"}],"name":"delOwner","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_to","type":"address"}],"name":"withdrawBalance","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"","type":"uint256"}],"name":"stages","outputs":[{"name":"stopDay","type":"uint256"},{"name":"bonus1","type":"uint256"},{"name":"bonus2","type":"uint256"},{"name":"bonus3","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"bytes32"}],"name":"pendingQueries","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"isFinalized","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_stopDay","type":"uint256"},{"name":"_bonus1","type":"uint256"},{"name":"_bonus2","type":"uint256"},{"name":"_bonus3","type":"uint256"}],"name":"addStage","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"openingTime","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"reserveFund","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"KYC","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_newPrice","type":"uint256"}],"name":"setGasPrice","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"oraclizeBalance","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"oraclize_url","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_beneficiary","type":"address"}],"name":"buyTokens","outputs":[],"payable":true,"stateMutability":"payable","type":"function"},{"constant":false,"inputs":[{"name":"_beneficiary","type":"address"},{"name":"_tokens","type":"uint256"}],"name":"manualSale","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"stageCount","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"token","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"inputs":[{"name":"_wallet","type":"address"},{"name":"_token","type":"address"},{"name":"_cap","type":"uint256"},{"name":"_openingTime","type":"uint256"},{"name":"_closingTime","type":"uint256"},{"name":"_reserveFund","type":"address"},{"name":"_tokenPriceInWei","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"payable":true,"stateMutability":"payable","type":"fallback"},{"anonymous":false,"inputs":[{"indexed":true,"name":"purchaser","type":"address"},{"indexed":true,"name":"beneficiary","type":"address"},{"indexed":false,"name":"value","type":"uint256"},{"indexed":false,"name":"tokens","type":"uint256"},{"indexed":false,"name":"bonus","type":"uint256"}],"name":"TokenPurchase","type":"event"},{"anonymous":false,"inputs":[],"name":"Finalized","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"description","type":"string"}],"name":"NewOraclizeQuery","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"price","type":"string"}],"name":"NewKrakenPriceTicker","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"newOwner","type":"address"}],"name":"OwnerAdded","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"owner","type":"address"}],"name":"OwnerDeleted","type":"event"}],
        // crowdSaleAddress: process.env.MIX_HOME_WALLET_ETH,
        // overrideOptions: { gasLimit: 150000 },
        // provider: new ethers.providers.Web3Provider(web3.currentProvider, ethers.providers.networks.homestead),
    }
  },
  computed: {
      sortedItems:function() {
          if(this.transactions !== null){
              return this.transactions.sort((a,b) => {
                  let modifier = 1;
                  if(this.currentSortDir === 'desc') modifier = -1;
                  if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                  if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                  return 0;
              }).filter((row, index) => {
                  let start = (this.currentPage-1)*this.pageSize;
                  let end = this.currentPage*this.pageSize;
                  if(index >= start && index < end) return true;
              }).filter((i) =>
                  this.checkedSend.includes(i.send)
              );
          }
      },
  },
  mounted () {
      this.getTx()
  },
  methods: {
      async getTx() {
          await axios.get('transaction/get')
              .then(res => {
                  this.totalPages = res.data.length
                  this.transactions = res.data;
              });
      },

      toggleAddingData(id) {
          let block = document.getElementById('hidden-' + id);
          block.classList.toggle('dataTable__item-wrap--hidden');
      },

      sort(s) {
          if(s === this.currentSort) {
              this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
          }
          this.currentSort = s;
      },

      nextPage() {
          if((this.currentPage*this.pageSize) < this.transactions.length) this.currentPage++;
      },

      prevPage() {
          if(this.currentPage > 1) this.currentPage--;
      },

      checkBoxClick: function () {
          this.pageSize = this.totalPages;
      },

      sendTokens(item, key) {
          let beneficiary = null;

          item.investor.wallets.map((i) => {
              if(i.currency === 'ETH') {
                  beneficiary = i.wallet;
              }
          });

          this.updateTransaction(item, key);


          // let contract = new ethers.Contract(this.crowdSaleAddress, this.abi, this.provider.getSigner());
          // contract.manualSale(beneficiary, ethers.utils.parseEther(item.amount_tokens), this.overrideOptions).then(tx => {
          //     alert('submitted');
          //     this.updateTransaction(item);
          //     provider.waitForTransaction(tx.hash).then(tx => {
          //         alert('confirmed');
          //     })
          // })
      },

      async updateTransaction(item, key) {
          const {data} = await axios.post(`transaction/update`, {
              id: item.transaction_id,
          });

          if(data.status === true) {
            this.sortedItems[key].send = '1';
            this.toggleAddingData(item.id);
            v.showMessage('Tokens successfully posted.', v.bg.success);
          }

          return data;
      }
  }
}