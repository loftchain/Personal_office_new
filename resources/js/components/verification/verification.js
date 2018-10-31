import axios from 'axios';

export default {
  name: 'verification',
  components: {},
  props: [],
  data () {
    return {
      investors: null,
      currentUrl: window.location.origin
    }
  },

  created() {
    this.getUsers();
  },

  computed: {

  },

  methods: {
    getUsers() {
      axios.get('verification/get')
        .then(res => {
          this.investors = res.data;
        });
    }
  }
}
