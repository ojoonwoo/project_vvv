<?
	include_once "./header.php";

	if ($_REQUEST["email"])
		$my_email	= $_REQUEST["email"];
	else
		$my_email	= $_SESSION['ss_vvv_email'];

	if (!$_SESSION['ss_vvv_email'] && $_REQUEST["email"] == "")
		echo "<script>location.href='login.php';</script>";

	$my_query		= "SELECT * FROM ".$_gl['like_info_table']." WHERE mb_email='".$my_email."' AND like_flag='Y'";
	$my_result		= mysqli_query($my_db, $my_query);
	$my_count		= mysqli_num_rows($my_result);

?>
	<body>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NH7CPGH"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		<div id="vvv" class="">
			<div class="bg-layer main">
				<div class="container">
					<div class="desktop-layout big"></div>
<?
	include_once "./head_area.php";
?>
					<div class="content myVVV">
						<div class="wrapper">
							<div class="rs-text">
								<p>
									<span class="ellipse"></span>
<?
	if ($_SESSION['ss_vvv_email'] == $my_email)
	{
?>
									<span class="name"><?=$_SESSION['ss_vvv_name']?></span>님 반갑습니다
<?
	}else{
		$member_query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_email='".$my_email."'";
		$member_result		= mysqli_query($my_db, $member_query);
		$member_data		= mysqli_fetch_array($member_result);

?>
									<span class="name"><?=$member_data['mb_name']?></span>님의 LIKE 입니다
<?
	}
?>
								</p>
							</div>
							<div class="sorting">
								<!-- <a href="javascript:void(0)" class="active">
									<span>UPLOAD</span>
									<span class="count">(10)</span>
								</a> -->
								<a href="javascript:void(0)">
									<span>LIKE</span>
									<span class="count">(<?=$my_count?>)</span>
								</a>
							</div>
							<div class="grid">
								<div class="row">
<?
	while ($data = mysqli_fetch_array($my_result))
	{
		$video_query		= "SELECT * FROM ".$_gl['video_info_table']." WHERE idx='".$data['v_idx']."'";
		$video_result		= mysqli_query($my_db, $video_query);
		$video_data			= mysqli_fetch_array($video_result);
		$yt_flag 			= explode("v=",$video_data["video_link"]);
?>
									<div class="d-col-3 m-col-1 t-col-2">
										<figure>
											<a href="video_detail.php?idx=<?=$video_data["idx"]?>">
												<div class="thum">
													<div class="thumnail-img" style="background-image:url(https://img.youtube.com/vi/<?=$yt_flag[1]?>/hqdefault.jpg);"></div>
												</div>
												<figcaption>
													<p>
														<span class="brand-name">
															[<?=$video_data["video_company"]?>]
														</span>
														<!-- <span class="desc">
															데님 팬츠, 어떻게 입을까.
														</span> -->
													</p>
													<span class="publisher">
														<?=mb_strimwidth($video_data["video_title"],0,40, '...', 'utf-8')?>
													</span>
													<div class="other">
														<div class="play">
															<span>▶</span>
															<span><?=number_format($video_data["play_count"])?></span>
														</div>
														<div class="like">
															<span>♥</span>
															<span><?=number_format($video_data["like_count"])?></span>
														</div>
														<div class="comment">
															<span class="glyphicon glyphicon-comment"></span>
															<span><?=number_format($data["comment_count"])?></span>
														</div>
													</div>
												</figcaption>
											</a>
										</figure>
									</div>
<?
	}
	$total_page			= ceil($total_video_num / $view_pg);
?>
<input type="hidden" id="total_video_num" value="<?=$my_count?>">
<input type="hidden" id="total_page" value="<?=$total_page?>">
								</div>
							</div>
<?
	if ($total_page > 1)
	{
?>
							<div class="more-cnt" id="main_more">
								<a href="javascript:void(0)" onclick="more_video()">
									<span class="blind">more</span>
								</a>
							</div>
<?
	}
?>
						</div>
					</div>
<?
	include_once "./search_area.php";
	include_once "./footer.php";
?>
				</div>
			</div>
		</div>
		<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="./js/TweenMax.js"></script>
<?
	if ($gubun == "MOBILE")
	{
?>
		<script type="text/javascript" src="./js/m_main.js"></script>
<?
	}else{
?>
		<script type="text/javascript" src="./js/main.js"></script>
<?
	}
?>
		<script type="text/javascript">
		var $vvv = $('#vvv');
		var $header = $('#header');
		$(window).on('scroll', function() {
			var $headerHeight = document.getElementById('header').height || $header.height();
			var currentScroll = $(this).scrollTop();
			if(currentScroll > 254 && !$vvv.hasClass('menu-opened')) {
				$vvv.addClass('scrolled');
				// TweenMax.to($('.gnb-foot'), 0.3, {autoAlpha: 1});
			} else {
				$vvv.removeClass('scrolled');
				// TweenMax.to($('.gnb-foot'), 0.3, {autoAlpha: 0});
			}
			// if(currentScroll > ($app.height()/3)) {
			// 	$('.go-top').css({
			// 		opacity: 1
			// 	});
			// } else {
			// 	$('.go-top').css({
			// 		opacity: 0
			// 	});
			// }
			// (currentScroll > $header.height()) ? $headerBg.addClass('scrolled') : $headerBg.remove

		});

		// mobile search action
		function actionSearch() {
			if($vvv.hasClass('searchOpen')) {
				TweenMax.to($('.box-search'), 0.3, {autoAlpha: 0});
				$vvv.removeClass('searchOpen');
			}else{
				TweenMax.to($('.box-search'), 0.3, {autoAlpha: 1});
				$vvv.addClass('searchOpen');
			}
		}
		</script>
	</body>
</html>
