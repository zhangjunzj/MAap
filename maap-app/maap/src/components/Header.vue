<template>
  <div class="header">
    <div class="logo-icon" ></div>
    <div class="menu-icon" @click="showMenuHandler">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="menu-panel" v-show="showMenu">
      <div class="menu-item" @click="showSecMenuHandler">项目</div>
      <ul class="sec-menu" v-show="showSecMenu">
        <li class="sec-menu-item" v-for="(item, index) in projects"
            :key="index"
            @click="toProjectDetail">{{item.title}}</li>
      </ul>
      <div class="menu-item">关于我们</div>
      <div class="menu-item">新闻</div>
    </div>
  </div>
</template>

<script type="text/ecmascript-6">
export default {
  name: "header"
}
</script>

<style scoped lang="scss">
  .header {
    height: px2rem(50px);
    background: #fff;
    padding: 0px 10px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    position: relative;
    z-index: 999;
    .logo-icon {
      width: 72px;
      height: 22px;
      background-image: url(../../images/logo@2x.png);
      background-size: 72px 22px;
    }
  }
  .menu-icon {
    width: px2rem(20px);
    height: px2rem(20px);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    z-index: 999999;
    span {
      width: px2rem(20px);
      height: px2rem(2px);
      background: #666;
    }
  }
  .menu-panel {
    position: absolute;
    left: 0px;
    top: px2rem(50px);
    width: 100%;
    height: px2rem(300px);
    background: #fff;
    overflow-y: auto;
    .menu-item {
      line-height: px2rem(44px);
      font-size: px2rem(17px);
      color: #333;
      padding: 0 px2rem(30px);
      text-indent: px2rem(20px);
      position: relative;
      &::before {
        content: " ";
        position: absolute;
        left: px2rem(30px);
        top: px2rem(16px);
        width: px2rem(8px);
        height: px2rem(8px);
        border: px2rem(2px) solid #0e6eb8;
        border-radius: 100%;
      }
    }
    .sec-menu {
      padding: 0 px2rem(49px);
      line-height: px2rem(44px);
      color: #999;
      font-size: px2rem(16px);
    }
  }
</style>
