import axios from 'axios';

import 'swiper/dist/css/swiper.css';
import { swiper, swiperSlide } from 'vue-awesome-swiper';

export default {
  name: 'verification',
  components: {
    swiper,
    swiperSlide
  },
  props: [],
  data () {
    return {
      investors: null,
      currentUrl: window.location.origin,
      swiperOptionA: {
        pagination: {
          el: '.swiper-pagination'
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        }
      }
    }
  },

  created() {
    this.getUsers();
  },

  mounted() {
    console.log('this is current swiper instance object', this)
  },

  computed: {
    swiperA() {
      return this.$refs.awesomeSwiperA.swiper
    }
  },

  methods: {
    getUsers() {
      axios.get('verification/get')
        .then(res => {
          this.investors = res.data;
        });
    },

    showModal(id) {
      let modal = document.getElementById(id);
      modal.classList.add('is-active');
    },

    hideModal(id) {
      let modal = document.getElementById(id);
      modal.classList.remove('is-active');
    },

    onSetTranslate() {
      console.log('onSetTranslate')
    }
  }
}
