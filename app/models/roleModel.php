<?php
    require_once 'model.php';
    require_once 'app/bl/BLAdmins.php';

class RoleModel implements Imodel {

  private $role_id;
  private $role_level;
  
  public function __construct($arr) {
    if (!empty($arr['role_id']))
    $this->role_id = $arr['role_id'];

    $this->role_level = $arr["role_level"];
  }

function __get($data){
    return $this->$data;
  
}

function __set($data, $data2){

}
}

?>