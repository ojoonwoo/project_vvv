<div id="header">
						<div class="inner">
							<div class="wrapper clearfix">
								<div class="logo">
									<a href="index.php">
										<img src="./images/vvv_logo_new.png" alt="홈으로">
									</a>
								</div>
								<div class="nav">
									<ul class="clearfix">
										<li>
											<a href="index.php">
												<span>ALL VVV</span>
											</a>
										</li>
										<li>
											<a href="my_vvv.php">
												<span>MY VVV</span>
											</a>
										</li>
									</ul>
									<div class="desktop-layout">
										<div class="input-box">
											<input type="text" placeholder="Search" id="search_txt" onKeyUp="search_video(this)">
											<button>
												<span class="blind">검색</span>
												<span class="icon-search" onclick="search_click(document.getElementById('search_txt').value)"></span>
											</button>
										</div>
									</div>
									<div class="mobile-layout">
<?
	if (strpos(basename($_SERVER['PHP_SELF']),"video_detail.php") !== false)
		$stop_flag    = "player.stopVideo();";
	else
		$stop_flag    = "";

?>
										<button onclick="<?=$stop_flag?>clearSearch();">
											<span class="blind">검색</span>
											<span class="icon-search"></span>
										</button>
									</div>
								</div>
								<div class="member-status">
<?
	if (!$_SESSION['ss_vvv_email'])
	{
?>
									<a href="login.php">
										<span>LOGIN</span>
									</a>
<?
	}else{
?>
									<a href="logout.php">
										<span>LOGOUT</span>
									</a>
<?
	}
?>
								</div>
							</div>
						</div>
						<div class="box-search">
							<div class="wrapper clearfix">
								<div class="input-box">
									<div class="inner">
										<input type="text" placeholder="Search" id="search_m_txt" onKeyUp="search_video(this)">
									</div>
								</div>
								<div class="close-box">
									<button onclick="clearSearch();">
										<span class="blind">닫기</span>
										<span class="icon-close"></span>
									</button>
								</div>
							</div>
						</div>
					</div>
