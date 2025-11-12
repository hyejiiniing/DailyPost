<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/DailyPost/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/DailyPost/classes/BoardClass.php';

$board = new BoardClass($conn);
$posts = $board->getList();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>DailyPost Feed</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	
<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="container-wrap">
			<div class="top-menu">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="index.php">DailyPost</a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li class="active"><a href="feed.php">Feed</a></li>
							<li><a href="notice_list.php">Notice</a></li>
							<li><a href="post.php">Post</a></li>
							<li><a href="mypage.php">My Page</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>

	<div class="container-wrap">	
		<div id="fh5co-contact">
			<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
				<h2>FEED</h2>
			</div>

			<!-- <div class="row">
				<div class="col-md-12">
					<?php if (!empty($posts)): ?>
						<?php foreach ($posts as $post): ?>
							<div class="col-md-12">
								<div class="fh5co-blog animate-box">
									<div class="blog-text">
										<span class="posted_on"><?= htmlspecialchars($post['created_at']) ?></span>
										<h3>
											<a href="post_view.php?id=<?= $post['id'] ?>">
												<?= htmlspecialchars($post['title']) ?>
											</a>
										</h3>
										<p><?= htmlspecialchars(mb_strimwidth($post['content'], 0, 100, '...')) ?></p>
										<ul class="stuff">
											<li><i class="icon-user"></i> <?= htmlspecialchars($post['user_name'] ?? '익명') ?></li>
											<li><i class="icon-eye2"></i> 조회수 0</li>
											<li><a href="post_view.php?id=<?= $post['id'] ?>">Read More<i class="icon-arrow-right22"></i></a></li>
										</ul>
									</div> 
								</div>
							</div>
						<?php endforeach; ?>
					<?php else: ?>
						<p class="text-center">등록된 게시글이 없습니다.</p>
					<?php endif; ?>
				</div>
			</div> -->

			<div class="row">
				<div class="col-md-12">
					<?php if (!empty($posts)): ?>
						<?php foreach ($posts as $post): ?>
							<div class="col-md-12">
								<div class="fh5co-blog animate-box">
									<div class="blog-text">
										<span class="posted_on">
											<?= date('Y.m.d', strtotime($post['created_at'])) ?>
										</span>
										<h3>
											<a href="post_view.php?id=<?= $post['id'] ?>">
												<?= htmlspecialchars($post['title']) ?>
											</a>
										</h3>
										<p><?= htmlspecialchars(mb_strimwidth($post['content'], 0, 100, '...')) ?></p>
										<ul class="stuff">
											<li><i class="icon-user"></i> <?= htmlspecialchars($post['user_name'] ?? '익명') ?></li>
											<li><i class="icon-eye2"></i> 조회수 0</li>
											<li>
												<a href="post_view.php?id=<?= $post['id'] ?>">
													Read More<i class="icon-arrow-right22"></i>
												</a>
											</li>
										</ul>
									</div> 
								</div>
							</div>
						<?php endforeach; ?>
					<?php else: ?>
						<p class="text-center">등록된 게시글이 없습니다.</p>
					<?php endif; ?>
				</div>
			</div>


		</div>
	</div>
</div>

<!-- JS -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
