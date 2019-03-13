<template>
  <div class="news">
    <div class="news-title">新闻标题：自动识别标题长度 ,超过一行自动折行</div>
    <div class="news-date">2019/3/3</div>
    <p class="news-paragraph">一个真正的环保主义者想要的生活方式。野界无论是在形态上还是底层系统上都向着极致的环保体验而去。从山泉引来的全屋净水，再到高效节能的建筑形式，污水和厨余废弃物100%回收再进入农场区再次利用。</p>
    <img class="news-img" src="../../images/6.jpg" alt="">
    <p class="news-paragraph">一个真正的环保主义者想要的生活方式。野界无论是在形态上还是底层系统上都向着极致的环保体验而去。从山泉引来的全屋净水，再到高效节能的建筑形式，污水和厨余废弃物100%回收再进入农场区再次利用。</p>
  </div>
</template>

<script type="text/ecmascript-6">
export default {
name: "detail"
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
