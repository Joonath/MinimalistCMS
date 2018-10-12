<?php

require_once 'functions/function.php';

if(isset($_POST["passSub"])){
    require_once 'functions/DBConfig.php';
    
    $c = new DBConfig();
    $c = $c->connection;
    
    $id = $_POST["id"];
    $st = $c->stmt_init();
    $query = "SELECT token, article_password FROM articles WHERE ArticleID = ?";
    
    $st->prepare($query);
    $st->bind_param("s", $id);
    
    $st->execute();
    $res = $st->get_result();
    
    if($res->num_rows == 1){
        $row = $res->fetch_assoc();
        if($row["article_password"] == $_POST["passInput"]){
            setcookie("postArt", $row["token"], 0, "/");
            
            echo '<meta http-equiv="refresh" content="0; article.php?' . GET_PARAM . '=' . $id . '" />';
            return;
        }
    }
    
    
} else {
    echo "bad password";
}

echo '<meta http-equiv="refresh" content="0; index.php" />';
?>