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
    
    //include_once('header.php');
    echo '
	<div class="container">
    <h2 style="font-family:Roboto">Add Post</h2>
	
	<form action="post.php" method="POST">
        <table border="1px solid #000">
        <tr>
            <td style="width:100px">Title</td> 
            <td><input type="text" name="title" class="inpTitle" /></td>
        </tr>
        <tr>
            <td>Category</td>
            <td>' . getCategory() . '</td>
        </tr>
        </table>
        <div class="clear"></div>
        <textarea id="editor" name="post" accesskey="S"></textarea>	
        <script type="text/javascript">

            CKEDITOR.replace(\'editor\', config);

        </script>
        
        <div class="clear"></div>

        <div class="publishing">
            <p>On Submit: </p>
            <select name="pub-type" class="pub_state">
                <option value="1">Publish</option>
                <option value="2">Draft</option>
                <option value="3">Protected</option>
                <option value="4">Private</option>
            </select>
        </div>

        <div class="pass hide">
            <p>Input Password: </p>
            <input type="text" name="pwArticle" />
        </div>

        <script>
            var joVar = $.noConflict();
        joVar(document).ready(function(){
            joVar(\'.pub_state\').on(\'change\', function(){
                var val = joVar(\'.pub_state\').val();
                if(val != \'3\'){
                    joVar(\'.pass\').addClass(\'hide\');
                } else {
                    joVar(\'.pass\').removeClass(\'hide\');
                }
            });
        });
        </script>

        <div class="clear"></div>
        <input type="submit" name="submit" value="Submit" />
	
	</form>
    </div>
'; //'; dari echo
    //include_once('../template/footer.php');

}

?>


