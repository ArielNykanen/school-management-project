<?php
require_once "controller.php";
require_once "../app/classes/upload.php";

class StudentController extends Controller {

  private static $studentDetails;
  private static $defaultImage;
  private static $defaultImageName = 'defaultStudent.png';

  public static function validateForm($studentDetailsArr, $studentId = false){
    $sc = new StudentController();
    StudentController::$studentDetails = $studentDetailsArr;
    $sbl = new BLStudents();
    $allStudents = $sbl->get();
    if ($studentId) {
      $existingStudent = $sbl->getOne($studentId);
    } else {
      if($studentDetailsArr['student_image']['name'] === '') {
        StudentController::$defaultImage = true;
        StudentController::$studentDetails['student_image'] = StudentController::$defaultImageName;
      }
    }

    foreach ($studentDetailsArr as $key => $detail) {
      if ($detail === '' || ctype_space($detail)) {
        $key = str_replace('_', ' ', $key);
        return AlertService::createAlert('Form Is Not Valid!',   $key  . ' field is required!', 'danger');
      }
    }
      
      
  
        if (!isset($existingStudent)) {
       if(StudentController::checkNewValues($allStudents, $studentDetailsArr)) {
        if(StudentController::checkAndMoveFile()) {
          return true;
        }
       }
  } else {
    $studentDetailsArr['student_id'] = $studentId;
    $updatedStudent = new StudentModel($studentDetailsArr);
      if(StudentController::checkUpdatedVlues($allStudents, $studentDetailsArr, $existingStudent)) {
        if ($existingStudent->student_image !== $studentDetailsArr['student_image']) {
          if(StudentController::checkAndMoveFile()) {
            StudentController::updateStudent($updatedStudent);
          } 
        } else {
          StudentController::$studentDetails['student_image'] = $existingStudent->student_image;
          StudentController::updateStudent($updatedStudent);
        }
      }
    }
}

public static function checkNewValues($allStudents, $studentDetailsArr){
  foreach ($allStudents as $student) {

  if ($student->student_email === $studentDetailsArr['student_email']) {
    return AlertService::createAlert('Email ' . $student->student_email . ' is already in use!', '', 'danger');
  }
  
  if ($student->student_phone === $studentDetailsArr['student_phone']) {
    return AlertService::createAlert('Phone number ' . $student->student_phone . ' is already in use!', '', 'danger');
}

if (strlen($studentDetailsArr['student_phone']) < 9 || strlen($studentDetailsArr['student_phone']) > 10) {
return AlertService::createAlert('Form Is Not Valid!', 'Phone number is invalid!', 'danger');
}

if (StudentController::$defaultImage) {
  return true;
}

if ($studentDetailsArr['student_image']['name'] === '') {
  return AlertService::createAlert('Form Is Not Valid!', 'You didnt chose image!', 'danger');
}
if (!UploadFile::isImage($studentDetailsArr['student_image'])) {
return AlertService::createAlert('Form Is Not Valid!', 'Upload only image files!', 'danger');
} 



}
return true;
  
}


  public function checkAndMoveFile(){
    if (StudentController::$defaultImage) {
      return true;
    } else {
      $file = StudentController::$studentDetails['student_image'];
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
          StudentController::$studentDetails['student_image'] = $studentImage->getName();
          }
            return true;
  }


  
public static function checkUpdatedVlues($allStudents, $studentDetailsArr, $existingStudent){
  foreach ($allStudents as $key => $student) {
    # code...
  if ($existingStudent->student_email !== $student->student_email && $student->student_email === $studentDetailsArr['student_email']) {
    return AlertService::createAlert('Email ' . $student->student_email . ' is already in use!', '', 'danger');
  }
  
  if ($existingStudent->student_phone !== $student->student_phone && $student->student_phone === $studentDetailsArr['student_phone']) {
    return AlertService::createAlert('Phone number ' . $student->student_phone . ' is already in use!', '', 'danger');
}

if (strlen($studentDetailsArr['student_phone']) < 9 || strlen($studentDetailsArr['student_phone']) > 10) {
  return AlertService::createAlert('Form Is Not Valid!', 'Phone number is invalid!', 'danger');
}

if ($existingStudent->student_image !== $studentDetailsArr['student_image']) {
  if ( !UploadFile::isImage($studentDetailsArr['student_image'])) {
    return AlertService::createAlert('Form Is Not Valid!', 'Upload only image files!', 'danger');
  }

} 
}
return true;
}

  
  
  public static function uploadStudent($studentDetailsArr) {
    $sbl = new BLStudents();
    $newStudent = new StudentModel(StudentController::$studentDetails);
    StudentController::$studentDetails = null;
    $sbl->set($newStudent);
    $_POST = array();
    header('Location: school');
    
  }

  public static function updateStudent($updatedStudent){
    $sbl = new BLStudents();
    
    $updatedStudent->student_image = StudentController::$studentImage;  
      $sbl->update($updatedStudent);
      StudentController::$studentImage = '';
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

  public static function deleteAllStudentCourses($studentId) {
    $sbl = new BLStudents();
    $sbl->deleteAllCourses($studentId);
  }
  
  
  public static function addCourse($studentId, $courseId) {
    $sbl = new BLStudents();
    $sbl->addCourse($studentId, $courseId);
  }

  public static function removeCourse($studentId, $courseId){
  
    $sbl = new BLStudents();
    $sbl->deleteOneCourse($studentId, $courseId);
    
  }



}

?>