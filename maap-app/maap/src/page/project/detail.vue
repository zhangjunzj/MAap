<template>
  <div>
    <div class="swiper">
      <img src="../../images/6.jpg" alt="">
    </div>
    <h3 class="project-title">野界营地酒店</h3>
    <p class="project-content">一个真正的环保主义者想要的生活方式。野界无论是在形态上还是底层系统上都向着极致的环保体验而去。</p>
  </div>
</template>

<script type="text/ecmascript-6">
export default {
  name: "detail"
}
</script>

<style lang='scss' scoped>
  @import "../../style/main.scss";
  .swiper {
    height: px2rem(210px);
    overflow: hidden;
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
