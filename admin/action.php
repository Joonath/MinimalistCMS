<?php
session_start();

include_once '../functions/function.php';

function getCount($id){
    $c = new DBConfig();
    $conn = $c->connection;
    
    $query = "SELECT revision_count FROM articles WHERE ArticleID = ?";
    $st = $conn->stmt_init();
    
    $st->prepare($query);
    $st->bind_param("i", $id);
    $st->execute();
    
    $res = $st->get_result();
    $row = $res->fetch_assoc();
    
    unset($conn);
    unset($st);
    unset($c);
    
    return $row["revision_count"];
}

if(isset($_POST['del_yes'])){
    $id = $_SESSION['del_ID'];
    
    $c = new DBConfig();
    $conn = $c->connection;
    
    $st = $conn->stmt_init();
    $query = "DELETE FROM articles WHERE ArticleID = ?; ";
    $copyData = "INSERT INTO temp_article SELECT * FROM articles WHERE ArticleID = ?;";
  
    $st->prepare($copyData);
    $st->bind_param("i", $id);
    
    if($st->execute()){
        echo '[i] success';
    } else {
        echo '[i] fail' . $st->error;
    }
  
    $st->prepare($query);
    $st->bind_param("i", $id);
    
    if($st->execute()){
        echo '[d] success';
    } else {
        echo '[d] fail' . $st->error;
    }
  
  	$st->close();
  	$c->close();
  	
  	unset($c);
  	unset($st);
    
    session_commit();
    
    //Nullyfing del_ID, just in case of error
    $_SESSION['del_ID'] = "";
    
    echo '<script>alert("Delete Success");</script>';
   
} else if(isset($_POST['update_sub'])){
    
  	$id = $_SESSION['edit_id'];
  
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
    
    //revCount init
    $revCount = getCount($id) + 1;
  
    
    $query = "UPDATE articles SET Title = ?, Text = ?, Category = ?, summary = ?, post_date = ?, revision_count = ?, status = ? WHERE ArticleID = ?";
    $st->prepare($query);
    
    $st->bind_param("ssissiii", $postTitle, $fix, $postCategory, $teaser[0], $date, $revCount, $status, $id);
    
    if($st->execute()){
        echo 'success insert';
    } else {
        echo 'error' . $st->error;
    }
    
    $st->close();
    $c->close();
  	unset($st);
    unset($c);

}

echo '<meta http-equiv="refresh" content="0; index.php?module=manage-post" />';
?>