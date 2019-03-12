<template>
  <div>
	  <div class="container">
		  <div class="header" @click="showMenuHandler">
			  <div class="logo-icon" ></div>
			  <div class="menu-icon" >
				  <span></span>
				  <span></span>
				  <span></span>
			  </div>
			  <div class="menu-panel" v-show="showMenu">
				  <div class="menu-item">项目</div>
				  <div class="menu-item">关于我们</div>
				  <div class="menu-item">新闻</div>
			  </div>
		  </div>
		  <ul>
			  <li class="item">
				  <div><img src="../../images/6.jpg" alt=""></div>
				  <div class="item-info">
					  <span>野界营地酒店</span>
					  <span class="img-tag">04</span>
				  </div>
			  </li>
			  <li class="item">
				  <div><img src="../../images/6.jpg" alt=""></div>
				  <div class="item-info">
					  <span>野界营地酒店</span>
					  <span class="img-tag">04</span>
				  </div>
			  </li>
		  </ul>
		  <div class="more">
			  加载更多
		  </div>
		  <div class="about">
			  <h5><span>关于我们</span></h5>
			  <div class="about-detail">

			  </div>
		  </div>
		  <div class="contact">
			  <h5><span>联系我们</span></h5>
			  <p>地址：上海市嘉定区安礼路258弄21号105室</p>
			  <p>电话：18616018525</p>
			  <p>邮箱：m@metaal.de</p>
		  </div>
		  <div class="news">
			  <h5><span>新闻</span></h5>
		  </div>
	  </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showMenu: false
    }
  },
  methods: {
    showMenuHandler() {
      
      this.showMenu = !this.showMenu;
    }
  },
  created() {
    // ajax 测试
	  this.$Http('itemlist.php', 'POST', {})
		.then((res)=> {
			
		})
		.catch(()=> {
			
		})
  }
};
</script>

<style lang='scss' scoped>
@import "../../style/main.scss";
.container {
  font-size: px2rem(16px);
  .item {
    margin-bottom: px2rem(8px);
    img {
      display: block;
      width: 100%;
      height: px2rem(210px);
    }
    .item-info {
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: px2rem(50px);
      padding: 0px px2rem(10px);
      color: #333;
    }
    .img-tag {
      position: relative;
      height: px2rem(18px);
      line-height: px2rem(18px);
      font-size: 12px;
      color: #0e6eb8;
      &::before {
        content: " ";
        position: absolute;
        width: px2rem(18px);
        height: px2rem(16px);
        background: #f90;
        left: px2rem(-20px);
      }
    }
  }
  .more {
    height: px2rem(58px);
    color: #999999;
    background: #f5f5f5;
    font-size: px2rem(13px);
    text-align: center;
    line-height: px2rem(58px);
  }
  h5 {
    font-size: px2rem(18px);
    color: #333;
    text-align: center;

    margin-bottom: px2rem(18px);
    span {
      display: inline-block;
      height: 30px;
      line-height: 30px;
      position: relative;
      font-weight: 400;
      &::before {
        content: " ";
        position: absolute;
        left: px2rem(-20px);
        top: px2rem(10px);
        width: px2rem(8px);
        height: px2rem(8px);
        border: px2rem(2px) solid #0e6eb8;
        border-radius: 100%;
      }
      &::after {
        content: " ";
        position: absolute;
        right: px2rem(-20px);
        top: px2rem(10px);
        width: px2rem(8px);
        height: px2rem(8px);
        border: px2rem(2px) solid #0e6eb8;
        border-radius: 100%;
      }
    }
  }
  .contact {
    p {
      padding-left: px2rem(30px);
      margin-bottom: px2rem(8px);
    }
  }
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
  }
}
</style>