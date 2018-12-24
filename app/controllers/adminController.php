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
          return true;
        }
       }
  } else {
    $adminDetailsArr['admin_id'] = $studentId;
    $updatedStudent = new StudentModel($adminDetailsArr);
      if(AdminController::checkUpdatedVlues($allAdmins, $adminDetailsArr, $existingAdmin)) {
        if ($existingAdmin->admin_image !== $adminDetailsArr['admin_image']) {
          if(AdminController::checkAndMoveFile()) {
            AdminController::updateStudent($updatedStudent);
          } 
        } else {
          AdminController::$adminDetails['admin_image'] = $existingAdmin->admin_image;
          AdminController::updateStudent($updatedStudent);
        }
      }
    }
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
    if (AdminController::$defaultImage) {
      return true;
    } else {
      $file = AdminController::$adminDetails['student_image'];
      $studentImage = new UploadFile();
      $studentImage->setName($file);
      if(!$studentImage::fileSize($file)) {
          $path = '../uploads/profiles/images/students/';
          if(!$studentImage->move($file["tmp_name"], $path, $studentImage, $studentImage->getName())) {
              return AlertService::createAlert('Something Went Wrong!', 'Image uploading failed please try again.', 'danger');
            } 
          } else {
            return AlertService::createAlert('Form Is Not Valid!', 'Image file is too large!', 'danger');
          }
          AdminController::$adminDetails['student_image'] = $studentImage->getName();
          }
            return true;
  }


  
public static function checkUpdatedVlues($allAdmins, $adminDetailsArr, $existingAdmin){
  foreach ($allAdmins as $key => $student) {
    # code...
  if ($existingAdmin->student_email !== $admin->admin_email && $admin->admin_email === $adminDetailsArr['student_email']) {
    return AlertService::createAlert('Email ' . $admin->admin_email . ' is already in use!', '', 'danger');
  }
  
  if ($existingAdmin->student_phone !== $admin->admin_phone && $admin->admin_phone === $adminDetailsArr['student_phone']) {
    return AlertService::createAlert('Phone number ' . $admin->admin_phone . ' is already in use!', '', 'danger');
}

if (strlen($adminDetailsArr['student_phone']) < 9 || strlen($adminDetailsArr['student_phone']) > 10) {
  return AlertService::createAlert('Form Is Not Valid!', 'Phone number is invalid!', 'danger');
}

if ($existingAdmin->student_image !== $adminDetailsArr['student_image']) {
  if ( !UploadFile::isImage($adminDetailsArr['student_image'])) {
    return AlertService::createAlert('Form Is Not Valid!', 'Upload only image files!', 'danger');
  }

} 
}
return true;
}

  
  
  public static function uploadAdmin($adminDetailsArr) {
    $sbl = new BLStudents();
    $newStudent = new StudentModel(AdminController::$adminDetails);
    AdminController::$adminDetails = null;
    $sbl->set($newStudent);
    $_POST = array();
    header('Location: school');
    
  }

  public static function updateAdmin($updatedStudent){
    $sbl = new BLStudents();
    
    $updatedStudent->student_image = AdminController::$studentImage;  
      $sbl->update($updatedStudent);
      AdminController::$studentImage = '';
      $_POST = array();
      header('Location: school');
  }


  public static function deleteStudent($studentId) {
    $sbl = new BLStudents();
    $deletedStudent = $sbl->getOne($studentId);
    $deletedStudentImage = "../uploads/profiles/images/students/".$deletedStudent->student_image;
    if (unlink($deletedStudentImage)) {
      $sbl->delete($studentId);
      } else {
      return AlertService::createAlert('Something went wrong try again', '', 'danger');
      }
  }




}

?>