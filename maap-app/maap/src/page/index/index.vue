<template>
  <div>
	  <div class="container">
		  <ul>
			  <li class="item" v-for="item in projects" :key="item.id" @click="toProjectDetail(item.id)">
				  <div><img :src="imgBaseUrl + item.images[0].path + item.images[0].url" alt=""></div>
				  <div class="item-info">
					  <span>{{item.title}}</span>
					  <span class="img-tag">{{item.images.length}}</span>
				  </div>
			  </li>
		  </ul>
		  <div class="more" @click="loadMoreProject">
			  加载更多
		  </div>
		  <div class="about">
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
		  <div class="news">
			  <h5><span>新闻</span></h5>
        <ul>
          <li class="news-item" v-for="item in newslist" :key="item.id" @click="toNewsDetail(item.id)">
            <img src="../../images/6.jpg" alt="">
            <div class="item-content">
              <h3 class="news-title">{{item.title}}</h3>
              <p class="news-time">{{item.addtime}}</p>
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
      imgBaseUrl: 'http://www.maapoffice.com/admin/images/',
      newslist: JSON.parse(localStorage.getItem('newslist')),
      projects: JSON.parse(localStorage.getItem('projects')),
      about: {
        address: '',
        description: '',
        email: '',
        imgurl: '',
        introduce: '',
        keyword: '',
        phone: '',
        time: ''
      }
    }
  },
  methods: {
    toProjectDetail(id) {
      this.$router.push({
        path: '/project',
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
      this.news.push({})
    },
    loadMoreNews() {
      this.news.push({})
    },
    saveLocalStorge(data) {
      localStorage.setItem('projects', JSON.stringify(data.itemlist));
      localStorage.setItem('newslist', JSON.stringify(data.newslist));
      localStorage.setItem('about', JSON.stringify(data.about));
    }
  },
  created() {
    // ajax 测试
	  this.$Http('query.php?action=all', 'POST', {})
		.then((res)=> {
		  const {code, data} = res;
		  if (code === 1) {
        this.saveLocalStorge(data);
        const {about, itemlist, newslist} = data;
        this.projects = itemlist;
        this.newslist = newslist;
        this.about = about;
      }
      console.log(res)
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
</style>
