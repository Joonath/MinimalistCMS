<?php
session_start();
include_once('../functions/function.php');

if(!isset($_POST['username']) || !isset($_POST['password']))
    echo '<script type="text/javascript">alert("No hotlinking");</script>';
else {
    include_once('../functions/token.php');
    
    $token = new Token();
    $token = $token->getKey();
    
    $username = $_POST['username'];
    $password = hash_hmac('SHA256', $_POST['password'], SECRET_KEY);
    
    $c = new DBConfig();
    $connect = $c->connection;
    
    $st = $connect->stmt_init();
    
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    
    $st->prepare($query);
    $st->bind_param("ss", $username, $password);
    
    $st->execute();
    $res = $st->get_result();
    
    if($res->num_rows > 0){
        $row = $res->fetch_assoc();
        $ip = getIpServer();
        
        setcookie("sess", $token, 0, "/");
        setcookie("addr", $ip, 0, "/");
        
        $_SESSION['auth'] = hash_hmac(HASH_METHOD, $row['username'] . "||" . $ip, $token);
        $_SESSION['user'] = $row['username'];
        
        
    } else {
        echo '<script>alert("Username and/or password incorrect")</script>';
    }
    
    $st->close();
    $c->close();
    unset($c);
    unset($token);
        
}

echo '<meta http-equiv="refresh" content="0; index.php" />';
session_commit();
?>