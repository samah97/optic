<?php

include_once("head.php");
if(Common::CheckValidSession()){
    header("Location: ".MAIN_URL."pages/report.php");
}
?>
<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
				<span class="login100-form-title-1">
					Sign In
				</span>
			</div>

			<form class="login100-form validate-form" action="action/loginProcess.php" method="POST">
			<div><?php echo htmlentities( $_GET['msg']); ?></div>
				<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
					<span class="label-input100">Username</span>
					<input class="input100" type="text" name="userName" id="userName" placeholder="Enter username"	>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
					<span class="label-input100">Password</span>
					<input class="input100" type="password" name="userPassword" id="userPassword" placeholder="Enter password">
					<span class="focus-input100"></span>
				</div>

				<div class="flex-sb-m w-full p-b-30">
					
					<div>
						<a href="#" class="txt1">
							Forgot Password?
						</a>
					</div>
				</div>

				<div class="container-login100-form-btn">
					<button type="submit" class="login100-form-btn">
						Login
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
include_once("footer.php");
?>


