<template>
  <div>
    <div class="swiper">
      <swiper :options="swiperOption" ref="mySwiper">
        <swiper-slide v-for="(item, index) in detailimages" :key="index">
          <img src="../../images/6.jpg" :alt="item.page">
        </swiper-slide>
        <div class="swiper-pagination"  slot="pagination"></div>
      </swiper>
    </div>
    <h3 class="project-title">野界营地酒店</h3>
    <p class="project-content">一个真正的环保主义者想要的生活方式。野界无论是在形态上还是底层系统上都向着极致的环保体验而去。</p>
  </div>
</template>

<script type="text/ecmascript-6">
import 'swiper/dist/css/swiper.css'
import { swiper, swiperSlide } from 'vue-awesome-swiper'
export default {
  name: "detail",
  components: {
    swiper,
    swiperSlide
  },
  data () {
    return {
      detailimages: [
        {page: 1},
        {page: 2},
        {page: 3},
        {page: 4}
      ],
      swiperOption: {
        autoplay: 1000,
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
  mounted() {
    this.swiper.slideTo(3, 1000, false)
  }
}
</script>

<style lang='scss' scoped>
  @import "../../style/main.scss";
  .swiper {
    height: px2rem(210px);
    overflow: hidden;
  }
  img {
    width: 100%;
    height: px2rem(200px);
  }
  .project-title {
    color: #333;
    font-size: px2rem(18px);
    line-height: px2rem(60px);
    font-weight: bold;
    padding: 0 px2rem(15px);
  }
  .project-content {
    padding: 0 px2rem(15px);
    color: #333;
    font-size: px2rem(16px);
  }
</style>
