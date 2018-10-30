import axios from 'axios';

export default {
  name: 'history',
  components: {},
  props: [],
  data () {
    return {
      histories: null
    }
  },
  computed: {

  },
  mounted () {
    this.getHistories();
  },
  methods: {
    async getHistories() {
      await axios.get('history/get')
        .then(res => {
          this.histories = res.data;
        });
    }
  }
}
