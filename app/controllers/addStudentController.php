<?php
require_once "controller.php";
require_once "../app/classes/upload.php";

class AddStudentController extends Controller {


  public static function validateForm($studentDetailsArr){
  
    foreach ($studentDetailsArr as $key => $detail) {
      if ($detail === '' || ctype_space($detail)) {
      $key = str_replace('_', ' ', $key);
      return AlertService::createAlert('Form Is Not Valid!',   $key  . ' field is required!', 'danger');
    }
    
  }
  if (strlen($studentDetailsArr['student_phone']) < 9 || strlen($studentDetailsArr['student_phone']) > 10) {
    return AlertService::createAlert('Form Is Not Valid!', 'Phone number is invalid!', 'danger');
  }
  
  if (!UploadFile::isImage($studentDetailsArr['student_image'])) {
    return AlertService::createAlert('Form Is Not Valid!', 'Upload only image files!', 'danger');
  }

  return true;

  }

  public static function uploadStudent($studentDetailsArr) {
    $sbl = new BLStudents();
    $studentImage = new UploadFile();
    $studentImage->setName($studentDetailsArr['student_image']);
    $studentDetailsArr['student_image'] = $studentImage->getName();
    $newStudent = new StudentModel($studentDetailsArr);
    $sbl->set($newStudent);
  }
  

}

?>