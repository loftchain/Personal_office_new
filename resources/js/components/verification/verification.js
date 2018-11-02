import axios from 'axios';

import 'swiper/dist/css/swiper.css';
import {swiper, swiperSlide} from 'vue-awesome-swiper';

export default {
    name: 'verification',
    components: {
        swiper,
        swiperSlide
    },
    props: [],
    data() {
        return {
            investors: null,
            currentUrl: window.location.origin,
            currentSort:'date',
            currentSortDir:'desc',
            pageSize:5,
            currentPage:1,
            totalPages:1,
            show: false,
            swiperOptionA: {
                pagination: {
                    el: '.swiper-pagination'
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                },
              loop: true
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
      sortedItems:function() {
        if(this.investors !== null){
          return this.investors.sort((a,b) => {
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
      },
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

        toggleAddingData(id) {
          let block = document.getElementById('hidden-' + id);
          block.classList.toggle('dataTable__item-wrap--hidden');
        },

        onSetTranslate() {
            console.log('onSetTranslate')
        },

        async applyKyc(id) {
            const {data} = await axios.post(`verification/${id}/confirm`);

            if (data.status === true) {
                this.hideModal(id)
            }
        },

        async returnKyc(id) {
            const {data} = await axios.post(`verification/${id}/reject`);

            if (data.status === true) {
                this.hideModal(id)
            }
        },

        sort(s) {
          if(s === this.currentSort) {
            this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
          }
          this.currentSort = s;
        },

        nextPage() {
          if((this.currentPage*this.pageSize) < this.investors.length) this.currentPage++;
        },

        prevPage() {
          if(this.currentPage > 1) this.currentPage--;
        },
      }
}
