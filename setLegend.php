
<?php
////DO NOT SEND TO WEB!////////DO NOT SEND TO WEB!////
////DO NOT SEND TO WEB!////////DO NOT SEND TO WEB!////
////DO NOT SEND TO WEB!////////DO NOT SEND TO WEB!////
////DO NOT SEND TO WEB!////////DO NOT SEND TO WEB!////
////DO NOT SEND TO WEB!////////DO NOT SEND TO WEB!////
////DO NOT SEND TO WEB!////////DO NOT SEND TO WEB!////
////DO NOT SEND TO WEB!////////DO NOT SEND TO WEB!////
////DO NOT SEND TO WEB!////////DO NOT SEND TO WEB!////

include_once 'functions/function.php';
include_once 'functions/DBConfig.php';

$c = new DBConfig();
$c = $c->connection;

$query = 'INSERT INTO versionList(versionId, versionDetail) VALUES(?, ?)';
$st = $c->stmt_init();
$st->prepare($query);

$id = "0.3a";
$detail = '<ol>
	<li>Optimized Core Features</li>
	<li>Protected Articles Added</li>
	<li>Improved Security</li>
</ol>';

$st->bind_param("ss", $id, $detail);
if($st->execute()){
    echo "success, inserted $id";
} else {
    echo "fail";
}
?>
