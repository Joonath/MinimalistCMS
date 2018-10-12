<?php 
if(isset($_GET['Logout']) ){
    require_once 'logout.php';
    die ('<script>alert("Logout success");</script>');
} else {
    echo '<div class="container">';
    echo 'Welcome, ' . $_SESSION["user"] . "<div class=\"clear\"></div>\n";
    echo '
        <form method="get" action="index.php">
        <button type="submit" name="Logout">Logout</button>
        </form>';
    
    echo '</div>';
}
?>

