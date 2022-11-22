<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Login</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Exxxxxx" />
	<script>
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //Meta tag Keywords -->
	<!--/Style-CSS -->
	<link rel="stylesheet" href="assets/css/loginStyle.css" type="text/css" media="all" />
	<!--//Style-CSS -->
</head>

<body>
	<!-- /login-section -->

	<section class="w3l-forms-23">
		<div class="forms23-block-hny">
			<div class="wrapper">

				<!-- if logo is image enable this   
					<a class="logo" href="index.html">
					  <img src="assets/image-path" alt="Your logo" title="Your logo" style="height:35px;" />
					</a> 
				-->
				<div class="d-grid forms23-grids">
					<div class="form23">
						<div class="main-bg">
							<h6 class="sec-one">Student Login</h6>
							<div class="speci-login first-look">
								<img src="assets/images/user.png" alt="" class="img-responsive">
							</div>
						</div>
						<div class="bottom-content">
							<form enctype="multipart/form-data" method="POST" action="login.php?q=index.php">
								<input type="text" name="username" class="input-form" placeholder="Your Username" required="required" />
								<input type="password" name="password" class="input-form" placeholder="Your Password" required="required" />
								<button type="submit" name='submit' class="loginhny-btn btn">Login</button>
								<div class="btn-danger col-6">
								</div>
							</form>
							<p>Admin? <a href="admin"> Click here</a></p>
						</div>
					</div>
				</div>
				<div class="w3l-copy-right text-center">
					<p>© 2022. All rights reserved | Design by
						<a href="#" target="_blank">H/CS/</a>
					</p>
				</div>
			</div>
		</div>
	</section>
	<!-- //login-section -->
</body>

</html>