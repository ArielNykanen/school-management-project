<?php
require_once "controller.php";


class LoginController extends Controller {

  
  static function checkValidForm() {
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $loginEmail = $_POST['email'];
    $loginPassword = $_POST['password'];
    $dal = new BusinessLogic();
    $admins = new BLAdmins();
    
    if($getAdmin = $admins->getByEmail($loginEmail)) {
      if ($getAdmin[0]->admin_password === md5($loginPassword)) {
        Session::add('admin_logged', [
        "admin_id" => $getAdmin[0]->admin_id,
        "admin_name" => $getAdmin[0]->admin_name,
        "admin_image" => $getAdmin[0]->admin_image,
        "admin_role" => $getAdmin[0]->admin_role,
        "admin_email" => $getAdmin[0]->admin_email
        ]);
        header('Location:school');
      } else {
        AlertService::createAlert('Wrong Details!', 'you have entered wrong password!', 'danger');
      }
    }else {
      AlertService::createAlert('Wrong Details!', 'You have entered wrong email!', 'danger');
    }
  }
  }

}

?>
