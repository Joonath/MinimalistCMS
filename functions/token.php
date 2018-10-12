<?php
class Token{
    
    private $upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    private $lower = "abcdefghijklmnopqrstuvwxyz";
    private $num = "0123456789";
    private $alphaLen = 26 - 1;
    private $numLen = 10 - 1;
    
    private $key;
    
    function __construct(){
        for($i = 0; $i < 10; $i++){
            $x = rand(0, 2);
            switch($x){
                case 0:
                    $r = rand(0, $this->alphaLen);
                    $this->key .= $this->upper{$r};
                    break;
                    
                case 1:
                    $r = rand(0, $this->alphaLen);
                    $this->key .= $this->lower{$r};
                    break;
                    
                case 2:
                    $r = rand(0, $this->numLen);
                    $this->key .= $this->numLen{$r};
                    
            }
        }
        
    }
    
    function getKey(){
        return $this->key;
    }
    
    function setUsername(){
        
    }
}
?>