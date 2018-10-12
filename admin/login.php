<?php 

//To Prevent Hotlinking of Static File
$path = get_included_files();

if(count($path) <= 1){
    die('<meta http-equiv="refresh" content="0; index.php" />');
}

?>

<body>
<div class="container" id="login">
	<h3 align="center" style="font-family: Roboto">Login</h3>
	<hr />
	<form action="send.php" method="POST">
		<div class="form-reg">
			<div class="col1">
			<div class="clear"></div>
				<div class="margination">
					<img src="<?php echo ROOT_DIR; ?>template/assets/username.png" />
					<input class="form-input singkat" type="text" name="username" required="required" /> 
					<span class="sorot"></span>
					<label>Username</label>
				</div>
				
				<div class="clear"></div>
				<div class="clear"></div>
				
				<div class="margination">
					<img src="<?php echo ROOT_DIR; ?>template/assets/password.png" />
					<input class="form-input singkat" type="password" name="password" required="required" />
					<span class="sorot"></span>
					<label>Password</label>
				</div>
				
				<div class="clear"></div>
				<div class="clear"></div>
    			<input type="submit" value="Submit" class="sub" />
    		</div>
		</div>
	</form>
</div>
</body>
</html>