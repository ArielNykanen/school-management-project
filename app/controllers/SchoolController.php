<?php
require_once "controller.php";

class SchoolController extends Controller {

  static function checkIfLogged(){
    
    if (!Session::has('admin_logged')) {
      header('Location:login');
    };
    
  }

  static function echosome($id) {
    echo $id;
  }

}

?>