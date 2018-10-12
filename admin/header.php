<?php 

//To Prevent Hotlinking of Static File
$path = get_included_files();

if(count($path) <= 1){
    die('<meta http-equiv="refresh" content="0; index.php" />');
}

?>

<body>
<div class="wrap">
    
    <!-- Menu & Header section -->
	<div class="joHeader">
		<div class="joTitle">Joo Nath Admin Section</div>
		<div class="separator"></div>
		<div class="joWrap">
			<div class="joMenu">
				<label class="joLabel"><a href="index.php">Home</a></label>
			</div>
    		<div class="joMenu">
    			<label class="joLabel"><a href="index.php?<?php echo GET_ADMIN_PARAM; ?>=add-post">Add Post</a></label>
    		</div>
    		
    		<div class="joMenu">
    			<label class="joLabel"><a href="index.php?<?php echo GET_ADMIN_PARAM; ?>=manage-post">Manage Post</a></label>
    		</div>
    	
    		<div class="joMenu">
    			<label class="joLabel"><a href="index.php?<?php echo GET_ADMIN_PARAM; ?>=manage-account">Manage Account</a></label>
    		</div>
    	</div>
	</div>
	<!-- end of menu -->
    <div class="clear"></div>