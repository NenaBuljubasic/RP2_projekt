<?php


class SiteController extends BaseController{

public function index()
{
    if(isset($_POST["log"]))
    { 
        require_once __DIR__.'/../view/login_index.php';
    }
    else if(isset($_POST["sign"]))
    {
        require_once __DIR__.'/../view/signup_index.php';
    }
    else if(isset($_POST["admin"]))
    {
        require_once __DIR__.'/../view/administrator_index.php';
    }
    
    else if(isset($_POST["nolog"]))
    {
        require_once __DIR__.'/../view/Guest.php';
    }
    
    
}



}


?>
