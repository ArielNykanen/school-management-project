<?php
require_once "controller.php";


class LoginController extends Controller {

  
  static function checkValidForm() {
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $loginEmail = $_POST['email'];
    $loginPassword = $_POST['password'];
    $dal = new BusinessLogic();
    $admins = new BLAdmins();
    $alerts = new BLAlerts();
      if ($getAdmin = $admins->getByEmail($loginEmail)) {
        if ($getAdmin[0]->admin_password === md5($loginPassword) ) {
          echo "logged in";
        } else {
          echo $alerts->createAlert('Wrong Details!', 'you have entered wrong details', 'danger');
        }
        return;
      } else {
        echo "not ok";
        return;
      }
    
  } else {
    return false;
  }
  }

}

?>
