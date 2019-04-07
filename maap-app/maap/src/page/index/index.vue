<template>
  <div class="wraper" v-show="loadSuccess">
	  <div class="container">
		  <ul>
			  <li class="item" v-for="item in showProjectsData" :key="item.id">
				  <div @click="toProjectDetail(item.id)">
            <img :src="imgBaseUrl + item.images[0].path + item.images[0].url" alt="">
          </div>
				  <div class="item-info">
					  <span>{{item.title}}</span>
					  <span class="img-tag" @click="toPreview(item.id)">{{item.images.length}}</span>
				  </div>
			  </li>
		  </ul>
		  <div class="more" @click="loadMoreProject">
			  {{projectMoreText}}
		  </div>
		  <div id="about" class="about" ref="about">
			  <h5><span>关于我们</span></h5>
			  <div class="about-detail">
          <p class="about-paragraph">{{about.description}}</p>
          <p class="about-paragraph">{{about.introduce}}</p>
			  </div>
		  </div>
		  <div class="contact">
			  <h5><span>联系我们</span></h5>
			  <p>地址：{{about.address}}</p>
			  <p>电话：{{about.phone}}</p>
			  <p>邮箱：{{about.email}}</p>
		  </div>
		  <div id="news" class="news" v-if="newslist && newslist.length">
			  <h5><span>新闻</span></h5>
        <ul>
          <li class="news-item" v-for="item in newslist" :key="item.id" @click="toNewsDetail(item.id)">
            <img :src="newsIcon(item.icon)" alt="">
            <div class="item-content">
              <h3 class="news-title">{{item.title}}</h3>
              <p class="news-time">{{newsTime(item.addtime)}}</p>
            </div>
          </li>
        </ul>
		  </div>
      <div class="more" @click="loadMoreNews" v-if="newslist && newslist.length">
        {{newsMoreText}}
      </div>
      <div class="copyright">Copyright ©2018-2021 MAap. All rights reserved.</div>
	  </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      imgBaseUrl: 'http://www.maapoffice.com/admin/images/',
      showNewsData: null,
      newsMoreText: '加载更多',
      newslist: JSON.parse(sessionStorage.getItem('newslist')),
      showProjectsData: null,
      projectMoreText: '加载更多',
      projects: JSON.parse(sessionStorage.getItem('newslist')),
      about: {
        address: '',
        description: '',
        email: '',
        imgurl: '',
        introduce: '',
        keyword: '',
        phone: '',
        time: ''
      },
      loadSuccess: false
    }
  },
  methods: {
    getShowProjects: function() {
      let projects = JSON.parse(sessionStorage.getItem('projects'))
      return projects.slice(0, 5)
    },
    getShowNews: function() {
      let newslist = JSON.parse(sessionStorage.getItem('newslist'))
      return newslist.slice(0, 5)
    },
    toProjectDetail(id) {
      this.$router.push({
        path: '/project',
        query: {
          id: id
        }
      })
    },
    toPreview(id) {
      this.$router.push({
        path: '/preview',
        query: {
          id: id
        }
      })
    },
    toNewsDetail(id) {
      this.$router.push({
        path: '/news',
        query: {
          id: id
        }
      })
    },
    loadMoreProject() {
      const showLength = this.showProjectsData.length
      const dataLength = this.projects.length
      if (showLength === dataLength) {
        this.projectMoreText = '已经是所有数据啦，没有更多了';
      } else {
        let moreData = this.projects.slice(showLength, showLength+2);
        this.showProjectsData = this.showProjectsData.concat(moreData)
        this.showProjectsData.length === dataLength && (this.projectMoreText = '已经是所有数据啦，没有更多了');
      }
    },
    loadMoreNews() {
      const showLength = this.showNewsData.length
      const dataLength = this.newslist.length
      if (showLength === dataLength) {
        this.newsMoreText = '已经是所有数据啦，没有更多了';
      } else {
        let moreData = this.newslist.slice(showLength, showLength+2);
        this.showNewsData = this.showNewsData.concat(moreData)
      }
    },
    saveLocalStorge(data) {
      let itemlist = (data.itemlist || []).reverse();
      let newslist = (data.newslist || []).reverse();
      sessionStorage.setItem('projects', JSON.stringify(itemlist));
      sessionStorage.setItem('newslist', JSON.stringify(newslist));
      sessionStorage.setItem('about', JSON.stringify(data.about));
      this.showProjectsData = itemlist.slice(0, 5) || [];
      this.showNewsData = newslist.slice(0, 5) || [];
    },
    scrollToEle() {
      const {name} = this.$route.query
      if (name === 'about') {
        document.getElementById("about").scrollIntoView();
      } else if (name === 'news') {
        document.getElementById("news").scrollIntoView();
      }
    },
    newsIcon(item) {
      console.log(JSON.stringify(item))
      if (item && item.length > 0) {
        return this.imgBaseUrl + item[0].path + item[0].url
      }
      return '';
    },
    newsTime(timeStr) {
      return timeStr.split(' ')[0];
    }

  },
  created() {
    let projects = JSON.parse(sessionStorage.getItem('projects'));
    if (!!projects) {
      this.projects = projects;
      let newslist = JSON.parse(sessionStorage.getItem('newslist'));
      this.newslist = newslist;
      let about = JSON.parse(sessionStorage.getItem('about'));
      this.about = about;
      this.showProjectsData = projects.slice(0, 5) || [];
      this.showNewsData = newslist.slice(0, 5) || [];
      this.loadSuccess = true;
    } else {
      this.$Http('query.php?action=all', 'POST', {})
      .then((res)=> {
        const {code, data} = res;
        if (code === 1) {
          this.saveLocalStorge(data);
          const {about, itemlist, newslist} = data;
          this.projects = itemlist;
          this.newslist = newslist;
          this.about = about;
          this.loadSuccess = true;
        }
      })
    }
	  
  },
  mounted() {
    this.scrollToEle()
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
        left: px2rem(-20px);
        background-image: url(../../images/img.png);
        background-size: px2rem(18px) px2rem(15px);
        background-repeat: no-repeat;
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
        top: px2rem(8px);
        width: px2rem(6px);
        height: px2rem(6px);
        border: px2rem(2px) solid #0e6eb8;
        border-radius: 100%;
      }
      &::after {
        content: " ";
        position: absolute;
        right: px2rem(-20px);
        top: px2rem(8px);
        width: px2rem(6px);
        height: px2rem(6px);
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
.wraper {
  animation: fadeIn 0.8s;
}
@keyframes fadeIn {
    0% {
      transform: translateY(50px);
      -webkit-transform: translateY(50px);
      opacity: 0;
    }
    100% {
      transform: translateY(0px);
      -webkit-transform: translateY(0px);
      opacity: 1;
    }
}
</style>
