<template>
  <div class="header">
    <div class="header-nav">
      <div class="logo-icon" @click="toHome"></div>
      <div class="menu-icon" :class="[showMenu ? 'menu-active' : '']" @click="showMenuHandler(!showMenu)">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="menu-panel" :class="[showMenu ? 'panel-active' : '']">
      <div class="menu-panel-inner" :class="[showMenu ? 'menu-panel-inner-active' : '']">
        <div class="menu-item hasLeaf" :class="{active: showSecMenu}" @click="showSecMenuHandler">项目</div>
        <!--<transition name="menu-slide">-->
          <ul class="sec-menu" :class="{active: showSecMenu}">
            <li class="sec-menu-item" v-for="(item, index) in projects"
                :key="index" @click="toProjectDetail(item.id)">{{item.title}}</li>
          </ul>
        <!--</transition>-->
        <div class="menu-item" @click="toAbout">关于我们</div>
        <div class="menu-item" @click="toNews">新闻</div>
        </div>
    </div>
    <div class="menu-mask" :class="[showMenu ? 'mask-active' : '']" @click="showMenuHandler(false)"></div>
  </div>
</template>

<script type="text/ecmascript-6">
export default {
  name: "header-bar",
  data () {
    return {
      showMenu: false,
      showSecMenu: true,
      projects: []
    }
  },
  created () {
    this.projects = JSON.parse(sessionStorage.getItem('projects'));
  },
  methods: {
    showMenuHandler(show) {
      this.showMenu = show;
      this.projects = JSON.parse(sessionStorage.getItem('projects'));
    },
    showSecMenuHandler() {
      this.showSecMenu = !this.showSecMenu;
    },
    toProjectDetail(id) {
      this.showMenuHandler(false);
      this.$router.push({
        path: '/project',
        query: {
          id: id
        }
      })
    },
    toHome() {
      this.showMenuHandler(false);
      this.$router.push({
        path: '/'
      })
    },
    toAbout() {
      const {name} = this.$route
      this.showMenuHandler(false)
      if (name === 'Index') {
        document.getElementById("about").scrollIntoView();
      } else {
        this.$router.push({
          path: '/',
          query: {
            name: 'about'
          }
        })
      }
    },
    toNews() {
      const {name} = this.$route
      this.showMenuHandler(false)
      if (name === 'Index') {
        let news = document.getElementById("news");
        if (news) {
          news.scrollIntoView();
        }
        // document.getElementById("news").scrollIntoView();
      } else {
        this.$router.push({
          path: '/',
          query: {
            name: 'news'
          }
        })
      }
    }
  }
}
</script>

<style scoped lang="scss">
  @import "../style/main.scss";
  .header {
    height: px2rem(50px);
    background: #fff;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 999;
    .logo-icon {
      width: 72px;
      height: 22px;
      background-image: url(../images/logo@2x.png);
      background-size: 72px 22px;
    }
  }
  .header-nav {
    height: px2rem(50px);
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    padding: 0px 10px;
  }
  .menu-icon {
    width: px2rem(20px);
    height: px2rem(18px);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    z-index: 999999;
    span {
      width: px2rem(23px);
      height: 2px;
      background-color: #666;
      transition: 0.5s;
      -webkit-transition: 0.5s;
    }
    &.menu-active {
      span {
        &:first-child {
          transform: translateY(px2rem(8px)) rotate(-45deg);
          -webkit-transform: translateY(px2rem(8px)) rotate(-45deg);
        }
        &:nth-child(2) {
          background-color: transparent;
        }
        &:last-child {
          transform: translateY(px2rem(-8px)) rotate(45deg);
          -webkit-transform: translateY(-px2rem(-8px)) rotate(45deg);
        }
      }
    }
  }
  .menu-panel-inner {
    transition: 0.5s;
    -webkit-transition: 0.5s;
    transform: translateY(-10px);
    -webkit-transform: translateY(-10px);
    &.menu-panel-inner-active {
      transform: translateY(0px);
      -webkit-transform: translateY(0px);
    }
  }
  .menu-mask {
    width: 100%;
    height: 0px;
    background: rgba(0,0,0,0.4);
    position: absolute;
    left: 0px;
    z-index: -1;
    &.mask-active {
      height: 100vh;
      background: rgba(0,0,0,0.4);
    }
  }
  .menu-panel {
    position: absolute;
    left: -1px;
    top: px2rem(50px);
    width: 100%;
    height: 0px;
    background: #fff;
    overflow-y: auto;
    box-shadow: 2px 2px 2px #ddd;
    transition: 0.5s;
    -webkit-transition: 0.5s;
    z-index: 9;
    &.panel-active {
      height: px2rem(500px);
    }
    .menu-item {
      line-height: px2rem(44px);
      font-size: px2rem(17px);
      color: #333;
      padding: 0 px2rem(30px);
      text-indent: px2rem(20px);
      position: relative;
      &.hasLeaf:after {
        content: '';
        width: px2rem(12px);
        height: px2rem(10px);
        background-image: url('../images/arr_down.png');
        background-repeat: no-repeat;
        background-size: cover;
        position: absolute;
        left: px2rem(94px);
        top: px2rem(15px);
      }
      &.hasLeaf.active:after {
        background-image: url('../images/arr_up.png');
      }
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
      height: 0;
      line-height: px2rem(44px);
      color: #999;
      font-size: px2rem(16px);
      overflow-y: auto;
      transition: 0.5s;
      -webkit-transition: 0.5s;
      &.active {
        height: px2rem(301px);
      }
    }
  }
  .menu-slide-enter-active, .menu-slide-leave-active {
    transition: opacity 1s ease-out;
  }
  .menu-slide-enter, .menu-slide-leave {
    opacity: 0;
    transition: opacity 1s ease-out;
  }
</style>
