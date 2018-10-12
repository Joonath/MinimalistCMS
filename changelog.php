<?php
include_once('functions/function.php');
include_once('template/header.php');
?>
<div class="container">
<h2>Changelog</h2>
<div class="clear"></div>
<form>
<fieldset>
	<legend style="font-size:20px">About This Site</legend>
This site is developed under sole creator, <i>Joo_Nath</i> with several third-party built-in program. <br />
Any bug is likely to be found, and occasionally be fixed when I available at the time.
</fieldset>
</form>

<!-- Version Legend Start -->
<?php 
include_once 'functions/DBConfig.php';

$c = new DBConfig();
$c = $c->connection;

$res = $c->query("SELECT * FROM versionlist");
while($row = $res->fetch_assoc()){
    echo '<p>Version: <b>' . $row["versionId"] . '</b></p>';
    echo $row["versionDetail"];
    echo "\n";
}
?>
<!-- Version Legend End -->
</div>
<?php 
include_once('template/footer.php');
?>