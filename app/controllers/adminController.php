<?php
require_once "controller.php";
require_once "../app/classes/upload.php";

class AdminController extends Controller {

  private static $adminDetails;
  private static $defaultImage;
  private static $defaultImageName = 'defaultStudent.png';

  public static function validateForm($adminDetailsArr, $adminId = false){
    $sc = new AdminController();
    AdminController::$adminDetails = $adminDetailsArr;
    $abl = new BLAdmins();
    $allAdmins = $abl->get();
    if ($adminId) {
      $existingAdmin = $abl->getOne($adminId);
    } else {
      if($adminDetailsArr['admin_image']['name'] === '') {
        AdminController::$defaultImage = true;
        AdminController::$adminDetails['admin_image'] = AdminController::$defaultImageName;
      }
    }

    foreach ($adminDetailsArr as $key => $detail) {
      if ($detail === '' || ctype_space($detail)) {
        $key = str_replace('_', ' ', $key);
        return AlertService::createAlert('Form Is Not Valid!',   $key  . ' field is required!', 'danger');
      }
    }

    if (!filter_var($adminDetailsArr['admin_email'], FILTER_VALIDATE_EMAIL)) {
      return AlertService::createAlert('Form Is Not Valid!',   $adminDetailsArr['admin_email']  . ' email is not valid.', 'danger');
    }

        if (!isset($existingAdmin)) {
       if(AdminController::checkNewValues($allAdmins, $adminDetailsArr)) {
        if(AdminController::checkAndMoveFile()) {
          AdminController::hashPassword();
          return true;
        }
       }
  } else {
    AdminController::$adminDetails['admin_role'] = AdminController::$adminDetails['admin_role'][0];
    $adminDetailsArr['admin_id'] = $adminId;
      if(AdminController::checkUpdatedVlues($allAdmins, $adminDetailsArr, $existingAdmin)) {
        if ($existingAdmin->admin_image !== AdminController::$adminDetails['admin_image']) {
          if(AdminController::checkAndMoveFile()) {
            $oldImage = '../uploads/profiles/images/admins/'. $existingAdmin->adminRole()->role_level . '/' . $existingAdmin->admin_image;
            if (unlink($oldImage)) {
                AdminController::updateAdmin();
            } else {
            return AlertService::createAlert('Something went wrong with changing the image!', 'Please try again', 'danger');
            }
          } 
        } else if ($existingAdmin->admin_role !== AdminController::$adminDetails['admin_role'][0]) {
          $rbl = new BLRoles();
          $newRole = $rbl->getOne(AdminController::$adminDetails['admin_role'][0]);
          $image =  AdminController::$adminDetails['admin_image'];
          rename('../uploads/profiles/images/admins/'. $existingAdmin->adminRole()->role_level . '/' .$image, '../uploads/profiles/images/admins/'. $newRole->role_level . '/' .$image);
          AdminController::$adminDetails['admin_image'] = $existingAdmin->admin_image;
          AdminController::updateAdmin();
        } else {
          AdminController::$adminDetails['admin_image'] = $existingAdmin->admin_image;
          AdminController::updateAdmin();
        }
      }
    }
}


public function hashPassword(){
  AdminController::$adminDetails['admin_password'] = md5(AdminController::$adminDetails['admin_password']); 
}

public static function checkNewValues($allAdmins, $adminDetailsArr){
  foreach ($allAdmins as $admin) {

  if ($admin->admin_email === $adminDetailsArr['admin_email']) {
    return AlertService::createAlert('Email ' . $admin->admin_email . ' is already in use!', '', 'danger');
  }
  
  if ($admin->admin_phone === $adminDetailsArr['admin_phone']) {
    return AlertService::createAlert('Phone number ' . $admin->admin_phone . ' is already in use!', '', 'danger');
}

if (strlen($adminDetailsArr['admin_phone']) < 9 || strlen($adminDetailsArr['admin_phone']) > 10) {
return AlertService::createAlert('Form Is Not Valid!', 'Phone number is invalid!', 'danger');
}

if (AdminController::$defaultImage) {
  return true;
}

if ($adminDetailsArr['admin_image']['name'] === '') {
  return AlertService::createAlert('Form Is Not Valid!', 'You didnt chose image!', 'danger');
}
if (!UploadFile::isImage($adminDetailsArr['admin_image'])) {
return AlertService::createAlert('Form Is Not Valid!', 'Upload only image files!', 'danger');
} 



}
return true;
  
}


  public function checkAndMoveFile(){
    $tempAdmin = new AdminsModel(AdminController::$adminDetails);
    if (AdminController::$defaultImage) {
      return true;
    } else {
      $file = AdminController::$adminDetails['admin_image'];
      $adminImage = new UploadFile();
      $adminImage->setName($file);
      if(!$adminImage::fileSize($file)) {
          $path = '../uploads/profiles/images/admins/'.$tempAdmin->adminRole()->role_level . '/';
          if(!$adminImage->move($file["tmp_name"], $path, $adminImage, $adminImage->getName())) {
              return AlertService::createAlert('Something Went Wrong!', 'Image uploading failed please try again.', 'danger');
            } 
          } else {
            return AlertService::createAlert('Form Is Not Valid!', 'Image file is too large!', 'danger');
          }
          AdminController::$adminDetails['admin_image'] = $adminImage->getName();
          }
            return true;
  }


  
public static function checkUpdatedVlues($allAdmins, $adminDetailsArr, $existingAdmin){
  foreach ($allAdmins as $key => $admin) {
    # code...
  if ($existingAdmin->admin_email !== $admin->admin_email && $admin->admin_email === $adminDetailsArr['admin_email']) {
    return AlertService::createAlert('Email ' . $admin->admin_email . ' is already in use!', '', 'danger');
  }
  
  if ($existingAdmin->admin_phone !== $admin->admin_phone && $admin->admin_phone === $adminDetailsArr['admin_phone']) {
    return AlertService::createAlert('Phone number ' . $admin->admin_phone . ' is already in use!', '', 'danger');
}

if (strlen($adminDetailsArr['admin_phone']) < 9 || strlen($adminDetailsArr['admin_phone']) > 10) {
  return AlertService::createAlert('Form Is Not Valid!', 'Phone number is invalid!', 'danger');
}

if ($adminDetailsArr['admin_image']['name'] !== '') {
  if ( !UploadFile::isImage($adminDetailsArr['admin_image'])) {
    return AlertService::createAlert('Form Is Not Valid!', 'Upload only image files!', 'danger');
  } 
} else {
  AdminController::$defaultImage = true;
  AdminController::$adminDetails['admin_image'] = $existingAdmin->admin_image; 
}
}
return true;
}

  
  
  public static function uploadAdmin($adminDetailsArr) {
    $abl = new BLAdmins();
    $newAdmin = new AdminsModel(AdminController::$adminDetails);
    AdminController::$adminDetails = null;
    $abl->set($newAdmin);
    $_POST = array('');
    header('location:administration');
  }

  public static function updateAdmin(){
    $updatedAdmin = new AdminsModel(AdminController::$adminDetails);
    $abl = new BLAdmins();
    $abl->update($updatedAdmin);
    $_POST = array();
  }


  public static function deleteAdmin($adminId) {
    $abl = new BLAdmins();
    $deletedAdmin = $abl->getOne($adminId);
    if ($deletedAdmin->admin_image !== 'defaultStudent.png') {
      $deletedAdminImage = "../uploads/profiles/images/admins/" . $deletedAdmin->adminRole()->role_level . '/' . $deletedAdmin->admin_image;
      if (unlink($deletedAdminImage)) {
        $abl->delete($adminId);
      } else {
        $abl->delete($adminId);
      }
    } else {
      $abl->delete($adminId);
    }
  }




}

?>