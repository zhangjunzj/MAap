<template>
  <div>
	  <div class="container">
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
		  <ul>
			  <li class="item" v-for="(item, index) in projects" :key="index" @click="toProjectDetail">
				  <div><img src="../../images/6.jpg" alt=""></div>
				  <div class="item-info">
					  <span>{{item.title}}</span>
					  <span class="img-tag">04</span>
				  </div>
			  </li>
		  </ul>
		  <div class="more" @click="loadMoreProject">
			  加载更多
		  </div>
		  <div class="about">
			  <h5><span>关于我们</span></h5>
			  <div class="about-detail">
          <p class="about-paragraph">MAaP的项目全部集中在娱乐休闲领域，而我们本身则是彻底的环保主义者。我们致力于娱乐他人，同时善待地球；我们创造精彩的形式，同时也关注建筑的性能与环境的质量。 </p>
          <p class="about-paragraph">从建筑到机电解决方案，从景观到山体，水体，植物的可持续低成本管理方式，MAaP专注于这一领域，希望能够协助业主一同构建需要高度体验性的度假酒店建造体系。</p>
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
        <ul>
          <li class="news-item" v-for="(item, index) in news" :key="index" @click="toNewsDetail">
            <img src="../../images/6.jpg" alt="">
            <div class="item-content">
              <h3 class="news-title">{{item.title}}新闻标题一行效果新闻标题一行效果新闻标题一行效果新闻标题一行效果新闻标题一行效果</h3>
              <p class="news-time">2019/3/9</p>
            </div>
          </li>
        </ul>
		  </div>
      <div class="more" @click="loadMoreNews">
        加载更多新闻
      </div>
      <div class="copyright">Copyright ©2018-2021 MAap. All rights reserved.</div>
	  </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showMenu: false,
      showSecMenu: false,
      news: [
        {title: '1'},
        {title: '12'},
        {title: '3'}
      ],
      projects: [
        {title: '野界营地酒店'},
        {title: '慧心谷度假村景观设计'},
        {title: '慧心谷别墅'},
        {title: '慧心谷茶室'},
        {title: '慧心谷酒店'}
      ]
    }
  },
  methods: {
    showMenuHandler() {
      this.showMenu = !this.showMenu;
    },
    showSecMenuHandler() {
      this.showSecMenu = !this.showSecMenu;
    },
    toProjectDetail() {
      this.$router.push({
        path: '/project',
        params: {
          id: 1
        }
      })
    },
    toNewsDetail() {
      this.$router.push({
        path: '/news',
        params: {
          id: 1
        }
      })
    },
    loadMoreProject() {
      this.news.push({})
    },
    loadMoreNews() {
      this.news.push({})
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
  background: rgba(245,245,245,1);
  .item {
    margin-bottom: px2rem(8px);
    background: #fff;
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
    padding: px2rem(30px) 0 px2rem(18px);
    /*margin-bottom: px2rem(18px);*/
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
  .about {
    background: #fff;
    .about-paragraph {
      padding: px2rem(10px) px2rem(30px);
      line-height: px2rem(30px);
      font-size: px2rem(16px);
    }
  }
  .contact {
    background: #fff;
    padding-bottom: px2rem(30px);
    margin-bottom: px2rem(10px);
    p {
      padding-left: px2rem(30px);
      margin-bottom: px2rem(8px);
    }
  }
  .news {
    background: #fff;
    padding-bottom: px2rem(10px);
    .news-item {
      display: flex;
      flex-direction: row;
      padding: px2rem(10px);
      img {
        width: px2rem(90px);
        height: px2rem(90px);
      }
      .item-content {
        flex: 1;
        padding-left: px2rem(18px);
        .news-title {
          height: px2rem(42px);
          font-size: px2rem(16px);
          color: #333;
          margin: px2rem(4px) 0 px2rem(24px);
          overflow: hidden;
        }
        .news-time {
          color: #999;
          font-size: px2rem(13px);
          text-align: right;
        }
      }
    }
  }
  .copyright {
    height: px2rem(40px);
    line-height: px2rem(40px);
    background: #666;
    color: #fff;
    font-size: px2rem(11px);
    text-align: center;
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
}
</style>
