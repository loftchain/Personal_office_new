import axios from 'axios';

export default {
  name: 'history',
  components: {},
  props: [],
  data () {
    return {
      histories: null,
      currentSort:'date',
      currentSortDir:'desc'
    }
  },

  created() {
    this.getHistories();
  },

  computed: {
    sortedItems:function() {
      if(this.histories !== null){
        return this.histories.sort((a,b) => {
          let modifier = 1;
          if(this.currentSortDir === 'desc') modifier = -1;
          if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
          if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
          return 0;
        });
      }
    }
  },

  mounted() {
    console.log(this.histories);
  },

  methods: {
    async getHistories() {
      await axios.get('history/get')
        .then(res => {
            this.histories = res.data;
        });
    },

    sort(s) {
      if(s === this.currentSort) {
        this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
      }
      this.currentSort = s;
    },

    renameAction(action) {
      if(action === 'registration') {
        return 'Registration'
      } else if(action === 'forgot_pwd') {
        return 'Forgot password'
      } else if(action === 'store_wallet') {
        return 'Store Wallet'
      } else if(action === 'change_pwd') {
        return 'Change password'
      } else if(action === 'change_email') {
        return 'Change email'
      }
    },

    cutInfo(item, action) {
      if(action === 'registration') {
        return item.info_2.substr(0, 20);
      }
    }
  }
}
