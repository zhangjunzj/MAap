<?php 

	require "./admin/extends/config.php";
	require "./admin/extends/Model.class.php";
	

	$itemModel = new Model("m_itemlist");
	$imageModel = new Model("item_imgs");
	$newsModel = new Model("m_newslist");
	$iconModel = new Model("news_imgs");

	$itemList = $itemModel->select();
	$itemList = array_reverse($itemList);
	$length = $newsModel->count();
	if ($length > 3) {
		$newsList = $newsModel->limit($length-3, $length)->select();
	} else {
		$newsList = $newsModel->select();
	}
		
	if ($newsList) {
		$newsList = array_reverse($newsList);
		$firstNews = $newsList[0];
		foreach ($newsList as $key => $value) {
			$icon = $iconModel->where("news_id={$value['id']}")->limit(0, 1)->select();
			$value['icon'] = './admin/images/'.$icon[0]['path'].$icon[0]['url'];
			if (strlen($value['text']) > 60) {
				$value['text'] = mb_substr($value['text'], 0, 76,'UTF-8').'...';
			}
			$value['addtime'] = mb_substr($value['addtime'], 0, 10,'UTF-8');
			
			$newsList[$key] = $value;
		}
	}

	// 项目列表不可为空
	foreach ($itemList as $key => $value) {
		$image = $imageModel->where("item_id={$value['i_id']}")->limit(0,1)->select();
		$value['url'] = './admin/images/'.$image[0]['path'].$image[0]['url'];
		if (strlen($value['i_introduce']) > 60) {
			$value['shot_introduce'] = mb_substr($value['i_introduce'], 0, 30,'UTF-8').'...';
		} else {
			$value['shot_introduce'] = $value['i_introduce'];
		}
		$itemList[$key] = $value;
	}
	// 查询第一个项目banner图片
	if (!empty($itemList)) {
		$images = $imageModel->where("item_id={$itemList[0]['i_id']}")->select();
		foreach ($images as $key => $value) {
			$url = './admin/images/'.$value['path'].$value['url'];
			$banners[] = $url;
		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>MAap-墨璞建筑设计官网</title>

	<link rel="stylesheet" href="./lib/fullpage/dist/jquery.fullpage.min.css">
	<link rel="stylesheet" href="./lib/swiper/dist/idangerous.swiper.css">
	<link rel="stylesheet" href="./css/main.css">
	<link rel="icon" href="./favicon.ico" type="image/x-icon">
</head>
<body style="display: none;">
	<!-- logo -->
	<div id="logoEl" class="logo"><i></i></div>
	<!-- menu -->
	<div id="menuEl" class="menu-list">
		<ul>
			<li id="navMenu1"><a href="#page1"></a><span>首页</span></li>
			<li id="navMenu2"><a href="#page1"></a><span>项目</span></li>
			<li id="navMenu3"><a href="#page2"></a><span class="span-4">关于我们</span></li>
			<li id="navMenu4"><a href="#page3"></a><span>新闻</span></li>
		</ul>
	</div>
	<div id="mainEL">
		<div class="section section1">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php foreach($banners as $item):?>
						<div class="swiper-slide"><img src="<?=$item?>" alt=""></div>
					<?php endforeach; ?>
				</div>
			</div>
			<div id="itemList" class="wrap-right-2">
				<div class="item-list-wrap"></div>
				<div id="itemListScrollWrap" class="item-list">
					<div id="itemListScroll" class="item-list-content">
						<ul>
							<!-- 项目列表 -->
							<?php foreach($itemList as $item):?>
								<li data-id="<?=$item['i_id']?>">
									<img src="<?=$item['url']?>" alt="">
									<div class="item-item">
										<h5><?=$item['i_title']?></h5>
										<span><?=$item['shot_introduce']?></span>
									</div>
									
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
			<div id="itemDetail" class="wrap-right">
				<div class="item-detail">
					<h2>
						<?=$itemList[0]['i_title']?>
						<span id="closeItemBtn"></span>
					</h2>
					<h3>Project Introduction</h3>
					<p><?=$itemList[0]['i_introduce']?></p>
				</div>
			</div>
			<div id="openItemBtn" class="item-name active">
				<i></i>
				<?=$itemList[0]['i_title']?>
			</div>
		</div>
		<div class="section section2">
			<div class="wrap"></div>
			<span class="about-left">ABOUT US</span>
				<div class="about-right">
					<div class="about-content">
						<h3>公司简介</h3>
						<h5>Company Profile</h5>
						<p>MAap是一家设计施工一体化公司。利用现代的设计与建造方法为独立业主私人定制从住宅到小型酒店的高端物业。<br> 目前国内高舒适度住宅的设计与建造相对欧美还有非常大的差距，往往出现使用不便以及冬冷夏热的情况。这种质量问题除了设计初期的失误以外，更大程度是由于每地工人素质区别巨大造成了由内到外完工细节质量的不可控。<br> MAap的设计基于预制，利用中国高精度的工业产能按照欧洲标准加工高质量的进口原材料，达到70%以上的场外完成度。仅仅将少量的拼装工作留给最后的施工人员，达成了超高的质量均一度，也让欧标建筑在中国的达成变得现实。</p>
						<h3>联系我们</h3>
						<h5>contact us</h5>
						<p class="p-2">地址：上海市嘉定区安亭新镇安礼路21号105<br>电话：021-1234567<br>邮箱：00000@maap.com </p>
						<!-- <div>—— MAaP</div> -->
					</div>
				</div>
		</div>
		<div class="section section3">
			<div class="wrap"></div>
			<div class="wrap-center">
				<div class="news-list">
					<?php foreach($newsList as $key => $item):?>
					<div class="news-item news-item<?=$key+1?> <?= $key==0 ? 'active' : ''?>" data-id="<?=$item['id']?>">
						<div class="img">
							<img src="<?=$item['icon']?>">
						</div>
						<div class="new-info">
							<h5><?=$item['title']?></h5>
							<span><?=$item['addtime']?><i></i></span>
							<p><?=$item['text']?></p>
						</div>
					</div>
					<?php endforeach; ?>

				</div>
				<div id="newDetail" class="news-detail">
					<div class="article-header">
						<h2 class="article-title"><?=$firstNews['title']?></h2>
						<span class="article-time"><?=$firstNews['addtime']?><i></i></span>
					</div>
					<div id="newsContent" class="news-content">
						<div id="scroller">
							<?=$firstNews['content']?>
						</div>
					</div>
					<div id="newsLoading" class="news-loading"><i></i></div>
				</div>
			</div>
			<div class="copy-right">Copyright ©2018-2021 MAap. All rights reserved. </div>
		</div>
	</div>

	<script src="./lib/jquery/jquery.min.js"></script>
	<script src="./lib/fullpage/dist/jquery.fullpage.min.js"></script>
	<script src="./lib/fullpage/vendors/jquery.easings.min.js"></script>
	<script src="./lib/swiper/dist/idangerous.swiper.min.js"></script>
	<script src="./lib/iscroll/build/iscroll.js"></script>

	<script>
		var baseUrl = 'http://www.metaal.cn/admin/';
		$(function() {
			// 样式
			var windowHeight = $(window).height();
			$('#itemListScrollWrap').height(windowHeight-200);


			$('#mainEL').fullpage({
				css3: false,
				scrollingSpeed: 700,
				//easing: 'easeInExpo',
				scrollOverflow: false,
	            scrollOverflowOptions: {
	                scrollY: false
	            },
				anchors: ['page1', 'page2', 'page3'],
				menu: '#menuEl',
				afterLoad: function(anchorLink, index) {
					console.log(anchorLink, index)
				},
				onLeave: function(index, nextIndex, direction) {
					
					$('#menuEl').find('a').removeClass('selected');
					if (!(nextIndex===1 && !$('#itemList').hasClass('active'))) {
						nextIndex += 1;

					}
					$('#navMenu'+ nextIndex).children('a').addClass('selected');
				},
				afterRender: function() {
					$('#navMenu1').children('a').addClass('selected');
					window.mySwiper = $('.swiper-container').swiper({
						loop: true,
						autoplay: 5000,// 自动滑动
						simulateTouch: false, // 鼠标点击、拖动
						speed: 500
					});

					var itemLlistScroll = new IScroll('#itemListScroll', {
						scrollbars: true,
						mouseWheel: true,
						interactiveScrollbars: true,
						shrinkScrollbars: 'scale',
						fadeScrollbars: true
					});
					$('body').show();
				}
			});

			$('#openItemBtn').click(function(){
				$('#itemDetail').addClass('active');
				$(this).removeClass('active');
			});

			$('#closeItemBtn').click(function() {
				$('#itemDetail').removeClass('active');
				$('#openItemBtn').addClass('active');
			});
			
			// 菜单按钮点击事件
			$('#menuEl').children('ul').children('li').bind('click', function() {
				$(this).parent().find('a').removeClass('selected');
				$(this).children('a').addClass('selected');
			});

			$('#navMenu1').click(function() {
				$('#itemDetail, #itemList').removeClass('active');
				$('#openItemBtn').addClass('active');
			});

			$('#navMenu2').click(function() {
				$("#itemList").addClass("active");
				$('#openItemBtn, #itemDetail').removeClass('active');
			});
	

			$("#navMenu3").click(function() {
			
			});

			var myScroll = new IScroll('#newsContent', {
				scrollbars: true,
				mouseWheel: true,
				interactiveScrollbars: true,
				shrinkScrollbars: 'scale',
				fadeScrollbars: true
			});
			document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
			
			// 新闻点击事件
			$(document).on('click', '.news-item', function() {
				$('#newsLoading').fadeIn(100);
				$(this).addClass('active').siblings().removeClass('active');
				$.ajax({
					type: 'post',
					url: baseUrl + 'query.php?action=querynews',
					data: {id: $(this).attr('data-id')},
					dataType: 'json',
					success: function(resp) {
						if (resp.code == 1) {
							var dataObj = resp.data;
							$('#newDetail .article-title').html(dataObj.title);
							$('#newDetail .article-time').html(dataObj.addtime);
							$('#scroller').html(dataObj.content);
							setTimeout(function () {
								myScroll.refresh();
							}, 10);
						} else {
							console.log('error');
						}
					},
					error: function(err) {
						console.log('error');
					},
					complete: function() {
						$('#newsLoading').fadeOut(100);
					}
				})
				
				
			});

			$('#itemList').on('click', ' .item-item', function() {
				var loading = showLoading($(this).parent())
				$.ajax({
					type: 'post',
					url: baseUrl + 'query.php?action=queryitem',
					data: {id: $(this).parent().attr('data-id')},
					dataType: 'json',
					success: function(resp) {
						if (resp.code == 1) {
							$("#itemList").removeClass("active");
							var dataObj = resp.data || {}
							$('#openItemBtn').html('<i></i>' + dataObj.i_title).addClass('active');
							$('#itemDetail').children('.item-detail').children('h2').html(dataObj.i_title).end().children('p').html(dataObj.i_introduce);
							// 组装slider
							mySwiper.removeAllSlides();
							for (i=0; i<dataObj.images.length; i++) {
								 var slide = '<img src="/admin/'+ dataObj.images[i]['url'] +'">';
								 mySwiper.appendSlide(slide);
							}

						} else {
							console.log('error');
						}
					},
					error: function(err) {
						console.log('error');
					},
					complete: function() {
						hideLoading(loading);
					}
				})
			});

			function http(params) {


			}

			function showLoading(target) {
				var loadEl = $('<div class="loading"><i></i></div>');
				target.append(loadEl);
				return loadEl;
			}

			function hideLoading(el) {
				el.remove();
			}
			
		});
	</script>
</body>
</html>