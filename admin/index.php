<?php 
session_start();
include_once("../functions/function.php"); 
include_once("../template/meta.php");


@$module = $_GET[GET_ADMIN_PARAM];
@$action = $_GET['action'];
@$id = $_GET['id'];


if(!isset($_SESSION['auth']) && !isset($_COOKIE['sess']) && !isset($_SESSION['user'])){
    include_once("login.php");
} else {
    include_once('header.php');
    
    if($module == null) //Main module
        include_once("main.php");
    else if($module == 'manage-post') //Manage (Edit | Update) Post
        include_once('modules/manage-post.php');
    else if($module == 'manage-account') //Manage Accounts
        include_once('modules/accounts.php');
    else if($module == 'add-post') //Add Posts
        include_once('modules/add-post.php');
    else if($module == 'update'){ //Case Update 
        if($action == 'edit') //Edit Post
            include_once('modules/edit-post.php');
        else if($action == 'delete') //Delete Post
            include_once('modules/delete.php');
    }
    else
        die('page doesn\'t exists or possible url forging detected');
    
        
    include_once('../template/footer.php');
}


?>