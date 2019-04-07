<template>
  <div class="news">
    <div class="news-title">{{newsitem.title}}</div>
    <div class="news-date">{{newsitem.addtime}}</div>
    <p class="news-paragraph" v-html="newsitem.content"></p>
    <!--<img class="news-img" src="../../images/6.jpg" alt="">-->
  </div>
</template>

<script type="text/ecmascript-6">
export default {
  name: "detail",
  data() {
    return {
      newsitem:{
        addtime: '',
        content: '',
        title: '',
        text: ''
      }
    }
  },
  created() {
    const id = this.$route.query.id;
    let newslist = JSON.parse(sessionStorage.getItem('newslist'));
    let result = newslist.filter(function(item) {
      if (item.id === id) {
        return true
      }
    })
    this.newsitem = result[0];
  }
}
</script>

<style lang='scss' scoped>
  @import "../../style/main.scss";
  .news {
    padding: px2rem(20px) px2rem(10px) px2rem(30px);
    .news-title {
      /*padding: px2rem(20px) px2rem(10px) px2rem(10px);*/
      color: #333;
      font-size: px2rem(18px);
    }
    .news-date {
      line-height: px2rem(34px);
      color: #999;
      font-size: px2rem(14px);
      margin-bottom: px2rem(14px);
    }
    .news-paragraph {
      font-size: px2rem(16px);
      line-height: px2rem(30px);
    }
    .news-img {
      padding: px2rem(20px) 0;
      width: 100%;
    }
  }
</style>
