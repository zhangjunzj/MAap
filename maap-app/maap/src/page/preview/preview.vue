
<template>
  <div class="content">
    <div class="back" @click="back"></div>  
    <div class="swiper">
      <swiper :options="swiperOption" ref="mySwiper">
        <swiper-slide v-for="(item, index) in project.images" :key="index">
          <img :src="imgBaseUrl+item.path+item.url"/>
        </swiper-slide>
        <div class="swiper-pagination"  slot="pagination"></div>
      </swiper>
    </div>
  </div>
</template>

<script type="text/ecmascript-6">
  import 'swiper/dist/css/swiper.css'
  import { swiper, swiperSlide } from 'vue-awesome-swiper'
  export default {
    name: 'preview',
    components: {
      swiper,
      swiperSlide
    },
    data () {
      return {
        imgBaseUrl: 'http://www.maapoffice.com/admin/images/',
        project: {
          images: [1,2]
        },
        swiperOption: {
          autoplay: true,
          speed: 400,
          loop: true,
          pagination : {
            el: '.swiper-pagination'
          }
        }
      }
    },
    computed: {
      swiper() {
        return this.$refs.mySwiper.swiper
      }
    },
    methods: {
      loadData: function() {
        const id = this.$route.query.id;
        let projects = JSON.parse(localStorage.getItem('projects'));
        let result = projects.filter(function(item) {
          if (item.id === id) {
            return true
          }
        })
        this.project = result[0];
      },
      back() {
        this.$router.back();
      }
    },
    watch: {
      $route: function() {
        this.loadData();
      }
    },
    created() {
      this.loadData();
    }
  }
</script>

<style scoped lang="scss">
  @import "../../style/main.scss";
  .content {
    /*position: relative;*/
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background: rgba(0, 0, 0, .7);
    z-index: 1000;
    .back {
      position: absolute;
      top: 10px;
      left: 10px;
      width: px2rem(40px);
      height: px2rem(40px);
      background-image: url(../../images/left-arrow.png);
      background-size: px2rem(30px) px2rem(30px);
      background-repeat: no-repeat;
    }
    .swiper {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      /*width: 50%;*/
      height: 30%;
      margin: auto;
      height: px2rem(210px);
      overflow: hidden;
    }
    img {
      width: 100%;
      height: px2rem(200px);
    }
  }
</style>
