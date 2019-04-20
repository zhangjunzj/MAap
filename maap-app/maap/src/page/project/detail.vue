<template>
  <div>
    <div class="images-wrap">
      <div class="swiper">
        <swiper :options="swiperOption" ref="mySwiper">
          <swiper-slide v-for="(item, index) in project.images" :key="index">
            <img :src="imgBaseUrl+item.path+item.url">
          </swiper-slide>
          <div class="swiper-pagination"  slot="pagination"></div>
        </swiper>
      </div>
      <h3 class="project-title">
        <span class="text-title">{{project.title}}</span>
        <span class="img-tag" @click="toPreview(project.id)">{{project.images.length}}</span>
      </h3>
    </div>
    <p class="project-content" v-html="project.introduce"></p>
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
      imgBaseUrl: 'http://www.maapoffice.com/admin/images/',
      project: {
        id: '',
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
      const id = this.$route.query.id;
      let projects = JSON.parse(sessionStorage.getItem('projects'));
      let result = projects.filter(function(item) {
        if (item.id === id) {
          return true
        }
      })
      this.project = result[0];
      this.project.introduce = this.project.introduce.replace(/[\n\r]/gm, '<br>');
    },
    toPreview(id) {
      this.$router.push({
        path: '/preview',
        query: {
          id: id
        }
      })
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
    // this.swiper.slideTo(3, 1000, false)
  }
}
</script>

<style lang='scss' scoped>
  @import "../../style/main.scss";
  .images-wrap {
    position: fixed;
    width: 100%;
    top: px2rem(50px);
  }
  .swiper {
    height: px2rem(200px);
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
    display: flex;
    background: #fff;
    .text-title {
      font-weight: bold;
      flex: 1;
    }
    .img-tag {
      position: relative;
      height: px2rem(18px);
      line-height: px2rem(60px);
      font-size: 12px;
      color: #0e6eb8;
      &::before {
        content: " ";
        position: absolute;
        width: px2rem(18px);
        height: px2rem(16px);
        background-image: url(../../images/img.png);
        background-size: px2rem(18px) px2rem(15px);
        background-repeat: no-repeat;
        left: px2rem(-20px);
        top: px2rem(20px);
      }
    }
  }
  .project-content {
    padding: px2rem(306px) px2rem(15px) px2rem(20px);
    color: #333;
    font-size: px2rem(16px);
    overflow-y: auto;
    line-height: px2rem(30px);
  }
</style>
