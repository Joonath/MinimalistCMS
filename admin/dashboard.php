<?php
$good = false;
if(!@isset($_COOKIE['sess']) && !isset($_SESSION['auth'])){
    echo '<script type="text/javascript">alert("No hotlinking");</script>';
    $good = false;
}else if(!@hash_equals($_SESSION['auth'], hash_hmac(HASH_METHOD, $_SESSION['user'] . "||" . $_COOKIE['addr'], $_COOKIE['sess'])) ){
    $good = false;
} else {
    $good = true;
}

if(!$good){
    require_once 'logout.php';
}
?>

<?php 
if($good){
    include_once('../functions/function.php');
    
    function getCategory(){
        $fullcode = null;
        $c = new DBConfig();
        $conn = $c->connection;
        
        $query = "SELECT CategoryID, CategoryName FROM category";
        $res = $conn->query($query);
        
        $fullcode = '<select name="cat">';
        
        while($row = $res->fetch_assoc()){
            $fullcode .= '<option value="' . $row['CategoryID'] . '">' . $row['CategoryName'] . '</option>';
        }
        
        $fullcode .= '</select>';
        $c->close();
        unset($c);
        return $fullcode;
    }
    
    echo '

<body>
<div class="wrap">
    
    <!-- Menu & Header section -->
	<div class="joHeader">
		<div class="joTitle">Joo Nath Admin Section</div>
		<div class="separator"></div>
		<div class="joWrap">
    		<div class="joMenu">
    			<label class="joLabel"><a href="#">Add Post</a></label>
    		</div>
    		
    		<div class="joMenu">
    			<label class="joLabel"><a href="#">Manage Post</a></label>
    		</div>
    	
    		<div class="joMenu">
    			<label class="joLabel"><a href="#">Manage Account</a></label>
    		</div>
    	</div>
	</div>
	<!-- end of menu -->
    <div class="clear"></div>

	<div class="container">
    <h2 style="font-family:Roboto">Add Post</h2>
	
	<form action="post.php" method="POST">
        <table>
        <tr>
            <td style="width:5px">Title</td> 
            <td style="margin:0"><input type="text" name="title" class="inpTitle" /></td>
        </tr>
        <tr>
            <td style="width:5px">Category</td>
            <td style="margin:0">' . getCategory() . '</td>
        </tr>
        </table>
        <div class="clear"></div>
        <textarea id="editor" name="post"></textarea>	
        <script>CKEDITOR.replace(\'editor\');</script>
        
        <div class="clear"></div>
	
        <input type="submit" name="submit" value="Submit" />
	
        <button type="submit" name="Logout">Logout</button>
	</form>
    
    </div>
</div>

</body>
</html>
'; //'; dari echo
    

}


?>