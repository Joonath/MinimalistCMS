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
            $fullcode .= '<option value="' . $row['CategoryID'] . '" ' . isTheCat($row['CategoryID']) . '>' . $row['CategoryName'] . '</option>';
        }
        
        $fullcode .= '</select>';
        $c->close();
        unset($c);
        unset($conn);
        return $fullcode;
    }
    
    function isTheCat($ini){
        if($GLOBALS['artcat'] == $ini){
            return "selected=\"selected\"";
        } else {
            return null;
        }
    }
    
    function getPublishType(){
        $fullcode = null;
        $c = new DBConfig();
        $conn = $c->connection;
        
        $query = "SELECT * FROM pub_stat";
        $res = $conn->query($query);
        
        $fullcode = '<select name="pub-type" class="pub_state">';
        
        while($row = $res->fetch_assoc()){
            $fullcode .= '<option value="' . $row['status'] . '" ' . isThePubType($row['status']) . '>' . $row['statusName'] . '</option>';
        }
        
        $fullcode .= '</select>';
        $c->close();
        unset($c);
        unset($conn);
        return $fullcode;
    }
    
    function isThePubType($ini){
        if($GLOBALS['status'] == $ini){
            return "selected=\"selected\"";
        } else {
            return null;
        }
    }
    
    function fetchArticleData(){
        $c = new DBConfig();
        $conn = $c->connection;
        
        $st = $conn->stmt_init();
        
        $query = "SELECT * FROM articles WHERE ArticleID = ?";
        $st->prepare($query);
        
        $st->bind_param("i", $GLOBALS['id']);
        $st->execute();
        
        $res = $st->get_result();
        $row = $res->fetch_assoc();
        
        unset($conn);
        unset($c);
        unset($st);
        
        return $row;
    }
    //include_once('header.php');
    
    $datas = fetchArticleData();
    
  	$_SESSION['edit_id'] = $datas['ArticleID'];
    $artcat = $datas['Category'];
    $pass = $datas['article_password'];
    $status = $datas['status'];
    $text = htmlspecialchars_decode($datas['Text']);
    
    echo '
	<div class="container">
    <h2 style="font-family:Roboto">Edit Post</h2>
	<p>ID : ' . $datas['ArticleID'] . '</p>
	<form action="action.php" method="POST">
        <table border="1px solid #000">
        <tr>
            <td style="width:100px">Title</td> 
            <td><input type="text" name="title" class="inpTitle" value="' . $datas['Title'] . '"/></td>
        </tr>
        <tr>
            <td>Category</td>
            <td>' . getCategory() . '</td>
        </tr>
        </table>
        <div class="clear"></div>
        <textarea id="editor" name="post" accesskey="S">' . $text . '</textarea>	
        <script>
            CKEDITOR.replace(\'editor\', config);
            
        </script>
        
        <div class="clear"></div>
	
        <div class="publishing">
            <p>On Submit: </p>' .
            
            getPublishType()
                
        . '</div>
        <div class="pass hide">
            <p>Input Password: </p>
            <input type="text" name="pwArticle" value="'.$pass.'" />
        </div>

        <script>
        $(document).ready(function(){
            if($(".pub_state").val() == "3"){
                $(".pass").removeClass("hide");
            }

            $(".pub_state").on("change", function(){
                var val = $(".pub_state").val();
                if(val != "3"){
                    $(".pass").addClass("hide");
                } else {
                    $(".pass").removeClass("hide");
                }
            });
        });
        </script>
        
        <div class="clear"></div>
        <input type="submit" name="update_sub" value="Submit" />
	
	</form>
    
'; //'; dari echo
    //include_once('../template/footer.php');

}


?>


