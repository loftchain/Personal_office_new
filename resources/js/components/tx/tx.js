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
        showIcon: true
    }
  },
  computed: {

  },
  mounted () {
      this.getTx()
  },
  methods: {
      async getTx() {
          await axios.get('transaction/get')
              .then(res => {
                  this.transactions = res.data;
              });
      },
  }
}
