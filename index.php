
<?php

define("HEADER_PATH", "template/header.php", false);
define("CONTENT_PATH", "template/content.php", false);
define("FOOTER_PATH", "template/footer.php", false);
define("FUNCTIONS_PATH", "functions/function.php", false);

try{
    
    if(!file_exists(HEADER_PATH))
        throw new Exception("File Not Found. Path: " . HEADER_PATH);
    else if(!file_exists(FOOTER_PATH))
        throw new Exception("File Not Found. Path: " . FOOTER_PATH);
    else if(!file_exists(CONTENT_PATH))
        throw new Exception("File Not Found. Path: " . CONTENT_PATH);
    else if(!file_exists(FUNCTIONS_PATH))
        throw new Exception("File Not Found. Path: " . FUNCTIONS_PATH);
    else {
        require_once(FUNCTIONS_PATH);
        require_once(HEADER_PATH);
        require_once(CONTENT_PATH);
        require_once(FOOTER_PATH);
    }

} catch(Exception $e){
    echo '[ERROR ' . $e->getCode() . "]: " . $e->getMessage() . "<br>";
    echo $e->getTraceAsString();
}

?>