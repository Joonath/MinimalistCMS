<h3>Password Protected</h3>
<form action="context.php" method="post">

	<p>A password is required to access this page.</p>
	<input type="password" placeholder="Input Article Password" name="passInput" />
	<input type="submit" value="Submit" name="passSub" class="pass-sub-butt" />
	<input type="hidden" value="<?php echo $_GET[GET_PARAM]; ?>" name="id" />
</form>