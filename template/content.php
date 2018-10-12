<?php 
$connect = new DBConfig();
$conn = $connect->connection;

$query = "SELECT * FROM articles ORDER BY ArticleID DESC";
$r = $conn->query($query);

echo "\n". '<!-- Start Content -->' . "\n";
echo '<div class="container">' . "\n";
if($r->num_rows > 0){

    while($row = $r->fetch_assoc()){
        $prefix = null;
        
        if($row["status"] == 3){
            $prefix = "[Protected] ";
        } else if($row["status"] == 2){
            continue;
        } else if($row["status"] == 4){
            continue;
        }
        
        echo '<h2><a href="article.php?' . GET_PARAM . '=' . $row['ArticleID'] . '">' . $prefix . $row['Title'] . '</a></h2>' . "\n";
        echo htmlspecialchars_decode($row['summary']);
        echo '<a href="article.php?' . GET_PARAM . '=' . $row['ArticleID'] . '">'. "Read More" . "</a><br />";
        echo '<span class="time">Posted at ' . $row['post_date'] . "</span>\n";
        echo '<hr />' . "\n";
    }
    
} else {
    echo '<p style="font-family: Roboto">No post have been published yet. </p>';
}

echo '</div>' . "\n<!-- end content -->";
$connect->close();
unset($connect);
?>