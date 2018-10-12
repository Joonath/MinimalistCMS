<?php 

echo '<div class="container">';
$_SESSION['del_ID'] = $GLOBALS['id'];

$c = new DBConfig();
$conn = $c->connection;

$st = $conn->stmt_init();
$query = "SELECT * FROM articles WHERE ArticleID = ?";


$st->prepare($query);
$st->bind_param("i", $GLOBALS['id']);

$st->execute();
$res = $st->get_result();

$st->close();

if($res->num_rows == 0){
    echo '<p>No Data Recorded</p>';
} else {
    
    $row = $res->fetch_assoc();
    
    echo '<p>Are you sure want to delete <b>' . $row['Title'] . "</b>? (ID = " . $row['ArticleID'] . ")</p>";
    echo '<form action="action.php" method="post">';
    echo '<button type="submit" name="del_yes">Yes</button> &nbsp;';
    echo '<button type="submit" name="del_no">No</button>';
    echo '</form>';
    
}
echo '</div>';
?>

