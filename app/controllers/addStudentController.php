<?php
require_once "controller.php";
require_once "../app/classes/upload.php";

class AddStudentController extends Controller {


  public static function validateForm($studentDetailsArr){
    $sbl = new BLStudents();
    $allStudents = $sbl->get();
    foreach ($studentDetailsArr as $key => $detail) {
      if ($detail === '' || ctype_space($detail)) {
      $key = str_replace('_', ' ', $key);
      return AlertService::createAlert('Form Is Not Valid!',   $key  . ' field is required!', 'danger');
    }
  }
  
  foreach ($allStudents as $student) {
    if ($student->student_email === $studentDetailsArr['student_email']) {
      return AlertService::createAlert('Email ' . $student->student_email . ' is already in use!', '', 'danger');
    }
    
    if ($student->student_phone === $studentDetailsArr['student_phone']) {
      return AlertService::createAlert('Phone number ' . $student->student_phone . ' is already in use!', '', 'danger');
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
    $imageFile = $studentDetailsArr['student_image'];
    $studentImage = new UploadFile();
    $studentImage->setName($imageFile);
    if(!$studentImage::fileSize($imageFile)) {
      $path = '../uploads/profiles/images/students/';
      if($studentImage->move($imageFile["tmp_name"], $path, $studentImage, $studentImage->getName())) {
        $studentDetailsArr['student_image'] = $studentImage->getName();
        $newStudent = new StudentModel($studentDetailsArr);
        $sbl->set($newStudent);
        $_POST = array();
        header('Location: school');
      } else {
        return AlertService::createAlert('Something Went Wrong!', 'Image uploading failed please try again.', 'danger');
      }
    } else {
      return AlertService::createAlert('Form Is Not Valid!', 'Image file is too large!', 'danger');
    }
  }
}

?>