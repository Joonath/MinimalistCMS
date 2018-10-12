<?php
session_start();
if(isset($_POST['Logout'])){
    require_once 'logout.php';
    echo '<script>alert("Logout success");</script>';
} else if(isset($_POST['submit'])){
    include_once '../functions/function.php';
    include_once '../functions/token.php';
    $postTitle = $_POST['title'];
    $postContent = $_POST['post'];
    $postCategory = $_POST['cat'];
    
    $date = date("F d, Y h:i:s A");
    
    $teaser = str_split($_POST['post'], strpos($_POST['post'], '<div style="page-break-after:always"><span style="display:none">&nbsp;</span></div>'));
    
    $status = $_POST['pub-type'];
    
    $c = new DBConfig();
    $conn = $c->connection;
    
    $st = $conn->stmt_init();
    $fix = htmlspecialchars($postContent);
    
    if($status == 3){
        
        $pass = $_POST["pwArticle"];
        $query = "INSERT INTO articles(Title, Text, Category, summary, post_date, status, article_password, token) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    } else {
        $query = "INSERT INTO articles(Title, Text, Category, summary, post_date, status, token) VALUES(?, ?, ?, ?, ?, ?, ?)";
    }
    
    $token = new Token();
    $token = $token->getKey();
    
    $st->prepare($query);
    
    if($status == 3){
        $st->bind_param("ssississ", $postTitle, $fix, $postCategory, $teaser[0], $date, $status, $pass, $token);
    } else {
        $st->bind_param("ssissis", $postTitle, $fix, $postCategory, $teaser[0], $date, $status, $token);
    }
    
    if($st->execute()){
        echo 'success insert';
    } else {
        echo 'error';
    }
    
    $st->close();
    $c->close();
    unset($c);
    
    
    
} else {
    echo '<script>alert("No hotlinking");</script>';
}

echo '<meta http-equiv="refresh" content="0; index.php" />';
    
?>