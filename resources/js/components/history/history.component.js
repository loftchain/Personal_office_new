import axios from 'axios';

export default {
  name: 'history',
  components: {},
  props: [],
  data () {
    return {
      histories: null,
      currentSort:'date',
      currentSortDir:'desc',
      pageSize:5,
      currentPage:1,
      totalPages:1,
      showIcon: true
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
        }).filter((row, index) => {
          let start = (this.currentPage-1)*this.pageSize;
          let end = this.currentPage*this.pageSize;
          if(index >= start && index < end) return true;
        });
      }
    }
  },

  mounted() {

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
      let history = {};

      if (action === 'registration') {
        history['info_1'] = item.info_1;
        history['info_2'] = item.info_2.substr(0, 15);
      } else if(action === 'forgot_pwd') {
        history['info_1'] = item.info_1.substr(0, 15);
        history['info_2'] = item.info_2.substr(0, 15);
      } else if(action === 'change_pwd') {
        history['info_1'] = item.info_1.substr(0, 15);
        history['info_2'] = item.info_2.substr(0, 15);
      } else {
        history['info_1'] = item.info_1;
        history['info_2'] = item.info_2;
      }

      return history;
    },

    nextPage() {
      if((this.currentPage*this.pageSize) < this.histories.length) this.currentPage++;
    },

    prevPage() {
      if(this.currentPage > 1) this.currentPage--;
    },
  }
}
