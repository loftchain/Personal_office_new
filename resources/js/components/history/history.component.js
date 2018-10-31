import axios from 'axios';

export default {
  name: 'history',
  components: {},
  props: [],
  data () {
    return {
      histories: [],
      currentSort:'date',
      currentSortDir:'desc'
    }
  },

  created() {
    this.getHistories();
  },

  computed: {
    sortedItems:function() {
      if(this.histories !== []){
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
    getHistories() {
      axios.get('history/get')
        .then(res => {
            this.histories = res.data;
        });
    },

    sort(s) {
      if(s === this.currentSort) {
        this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
      }
      this.currentSort = s;
    }
  }
}
