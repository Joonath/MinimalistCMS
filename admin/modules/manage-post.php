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
    
    echo '
    <style type="text/css">
    .row-border{
        border-bottom: 1px solid #000;
    }

    .icon{
    	display: inline-block;
        position: relative;
        
    }
    </style>

    ';
    
    $c = new DBConfig();
    $conn = $c->connection;
    
    $query = "SELECT * FROM articles ORDER BY ArticleID DESC";
    
    $res = $conn->query($query);
    
    echo '
    <div class="container">
    <h2>Manage Posts</h2>
    <div class="clear"></div>
    
    <table style="width: 100%" cellspacing="0">
    <thead align="left">
        <th>ID</th>
        <th>Post Title</th>
        <th>Post Date</th>
        <th>Action</th>
    </thead>
    ';
    
    echo '<tbody valign="middle" style="line-height: 35px;">' . "\n";
    while($row = $res->fetch_assoc()){
        echo "<tr>\n";
        echo "\t<td class=\"row-border\">" . $row['ArticleID'] . "</td>\n";
        echo "\t<td class=\"row-border\">" . $row['Title'] . "</td>\n";
        echo "\t<td class=\"row-border\">" . $row['post_date'] . "</td>\n";
        echo "\t<td class=\"row-border\">" . "\n" .
            '<div class="icon">' . "\n" .
            '<a href="?module=update&action=edit&id=' . $row['ArticleID'] . '"><img src="../template/assets/edit.png" width="20px" height="20px" alt="Upd" title="Update" /></a>' . "\n" .
            '</div>' . "\n\n" .
            
            '<div class="icon">' . "\n" .
            '<a href="?module=update&action=delete&id=' . $row['ArticleID'] . '"><img src="../template/assets/delete.png" width="20px" height="20px" alt="Del" title="Delete" /></a>' . "\n" .
            '</div>' . "\n" .
        
            "</td>\n";
        echo "</tr>\n";
    }
    
    echo "</tbody>\n</table>\n</div>";
    
    
}
?>
<?php 
$c->close();
unset($c);
?>