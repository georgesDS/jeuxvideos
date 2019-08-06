<div id="login">
	<h3>Login</h3>
	<form method="post" action="" name="login">
		<label>Pseudo</label>
		<input type="text" name="username" autocomplete="off" />
		<label>Password</label>
		<input type="password" name="password" autocomplete="off"/>
		<div class="errorMsg"><?php echo $errorMsgLogin; ?></div>
		<input type="submit" class="button" name="loginSubmit" value="Login">
	</form>
</div>