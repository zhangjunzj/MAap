<template>
  <div>
    <div class="swiper">
      <swiper :options="swiperOption" ref="mySwiper">
        <swiper-slide v-for="(item, index) in project.images" :key="index">
          <img v-preview="imgBaseUrl+item.path+item.url" :src="imgBaseUrl+item.path+item.url"
               preview-title-enable="true"
               preview-nav-enable="true" >
        </swiper-slide>
        <div class="swiper-pagination"  slot="pagination"></div>
      </swiper>
    </div>
    <h3 class="project-title">{{project.title}}</h3>
    <p class="project-content">{{project.introduce}}</p>
  </div>
</template>

<script type="text/ecmascript-6">
import Vue from 'Vue'
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
      imgBaseUrl: 'http://www.maapoffice.com/admin/images/',
      project: {
        title: '',
        introduce: '',
        images: [],
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
      console.log(this.$route.query);
      const id = this.$route.query.id;
      let projects = JSON.parse(localStorage.getItem('projects'));
      let result = projects.filter(function(item) {
        if (item.id === id) {
          return true
        }
      })
      this.project = result[0];
      console.log(this.project);
    }
  },
  watch: {
    $route: function() {
      this.loadData();
    }
  },
  created() {
    this.loadData();
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
