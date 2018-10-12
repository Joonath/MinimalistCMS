<?php
include_once('functions/function.php');

$approved = false;
$isProtected = false;
$isAllowed = @$_COOKIE['postArt'];
if(!isset($_GET[GET_PARAM])){
    $approved = false;
} else {
    $approved = true;
    
    $c = new DBConfig();
    $conn = $c->connection;
    
    $st = $conn->stmt_init();
    $query = "SELECT * FROM articles WHERE ArticleID = ?";
    $st->prepare($query);
    $st->bind_param("i", $_GET[GET_PARAM]);
    $st->execute();
    
    $res = $st->get_result();
    
    if($res->num_rows == 0){
        $approved = false;
    } else {
        $row = $res->fetch_assoc();
        
        if($row["status"] == 1){ //Publish
            $approved = true;
        } else if($row["status"] == 2){ //Draft
            $approved = false;
        } else if($row["status"] == 3){ //Protected
            $isProtected = true;
            $approved = true;
        } else if($row["status"] == 4){ //Private
            
        } else {
            $approved = false;
        }
        
    }
    
    
}

include_once("template/header.php");

echo "\n". "<div class=\"container\">\n";

if($approved){
    
    if($isProtected && $isAllowed == null || $row["token"] != $isAllowed){
        require_once 'template/password.php';
    } else {
        echo "<h1>" . $row['Title'] . "</h1>";
        echo htmlspecialchars_decode($row['Text']);
    }

    
} else {
    echo 'The post is not exists.';
    
}

if(isset($_GET[GET_PARAM])){
    $res->close();
    $c->close();
    unset($c);
}

echo "</div>\n";
?>

<!-- recent post -->
	<div class="clear"></div>
	<div class="container">
<?php 
echo '<h2>Recent Post</h2><br />' . "\n";
$c = new DBConfig();
$conn = $c->connection;
$query = "SELECT * FROM articles ORDER BY ArticleID DESC LIMIT 3";

$res = $conn->query($query);
while($row = $res->fetch_assoc()){
    echo '      <a href="article.php?' . GET_PARAM . '=' . $row['ArticleID'] . '">' . $row['Title'] . '</a><br />' . "\n";
}

$c->close();
unset($c);

?>
<!-- end recent post -->	
</div>	
<?php
include_once("template/footer.php");
?>