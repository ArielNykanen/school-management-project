<?php
require_once "controller.php";
require_once "../app/classes/upload.php";

class CourseController extends Controller {
  private static $cbl;
  private static $courseDetails;
  
  public static function validateForm($courseDetails, $courseId = false){
    CourseController::$cbl = new BLCourses();
    CourseController::$courseDetails = $courseDetails;
    $cbl = new BLCourses();
    $allCourses = $cbl->get();
    foreach ($courseDetails as $key => $detail) {
      if ($detail === '' || ctype_space($detail)) {
      $key = str_replace('_', ' ', $key);
      return AlertService::createAlert('Form Is Not Valid!',   $key  . ' field is required!', 'danger');
    }
  }

  if (!$courseId) {
    foreach ($allCourses as $course) {
      if ($course->course_name === $courseDetails['course_name']) {
        return AlertService::createAlert('Course named  ' . $course->course_name . ' is already in the database!', '', 'danger');
      }
    }
    if (!UploadFile::isImage($courseDetails['course_image'])) {
      return AlertService::createAlert('Form Is Not Valid!', 'Upload only image files!', 'danger');
    }  
    return true;
  } else {
    $editableCourse = $cbl->getOne($courseId);
    foreach ($allCourses as $course) {
      if ($editableCourse->course_name !== $course->course_name && $course->course_name === $courseDetails['course_name']) {
        return AlertService::createAlert('Course named  ' . $course->course_name . ' is already in the database!', '', 'danger');
      }
    }
    if (is_array($courseDetails['course_image'])) {
      if (!UploadFile::isImage($courseDetails['course_image'])) {
        return AlertService::createAlert('Upload only Images!', '', 'danger');
      } else {
        $oldImage = 'C:/xampp/htdocs/school-management-project/uploads/courses/courses-cover-images/'. $editableCourse->course_image;
        if (unlink($oldImage)) {
          if(CourseController::checkAndMoveFile($courseDetails['course_image'])) {
            CourseController::updateCourse();
          }
        } else {
        return AlertService::createAlert('Something went wrong with changing the image!', 'Please try again', 'danger');
        }
      }
    } else if (!is_array($courseDetails['course_image']) && $courseDetails['course_image'] === $editableCourse->course_image) {
      CourseController::updateCourse();
    }
  }
  }

  public function checkAndMoveFile($file){
    $courseImage = new UploadFile();
    $courseImage->setName($file);
    if(!$courseImage::fileSize($file)) {
      $path = '../uploads/courses/courses-cover-images/';
      if(!$courseImage->move($file["tmp_name"], $path, $courseImage, $courseImage->getName())) {
        return AlertService::createAlert('Something Went Wrong!', 'Image uploading failed please try again.', 'danger');
      } 
    } else {
      return AlertService::createAlert('Form Is Not Valid!', 'Image file is too large!', 'danger');
    }
    
    CourseController::$courseDetails['course_image'] = $courseImage->getName();

    return true;

  }

  public static function updateCourse(){
    $updatedCourse = new CourseModel(CourseController::$courseDetails);
    CourseController::$cbl->update($updatedCourse);
    // $_POST = array();
    // header('Location: school');
  }




  public static function uploadCourse($courseDetailsArr) {
    $cbl = new BLCourses();
    $imageFile = $courseDetailsArr['course_image'];
    $courseImage = new UploadFile();
    $courseImage->setName($imageFile);
    if(!$courseImage::fileSize($imageFile)) {
      $path = '../uploads/courses/courses-cover-images/';
      if($courseImage->move($imageFile["tmp_name"], $path, $courseImage, $courseImage->getName())) {
        $courseDetailsArr['course_image'] = $courseImage->getName();
        $newCourse = new CourseModel($courseDetailsArr);
        $cbl->set($newCourse);
        $_POST = array();
        header('Location: school');
      } else {
        return AlertService::createAlert('Something Went Wrong!', 'Image uploading failed please try again.', 'danger');
      }
    } else {
      return AlertService::createAlert('Form Is Not Valid!', 'Image file is too large!', 'danger');
    }
  }

  public static function  getAllEnrolled($courseId){
    $cbl = new BLCourses();
    $sbl = new BLStudents();
    $enrolledStudents = $cbl->getAllEnrolled($courseId);
    $courseDetails = $cbl->getOne($courseId, true);
    return $courseDetails;
  }

  public static function  getLeftPlaces($courseId){
    $cbl = new BLCourses();
    $enrolledStudents = $cbl->getAllEnrolled($courseId);
    $courseDetails = $cbl->getOne($courseId);
    return $courseDetails->course_max_students - count($enrolledStudents);
  }
  


  public static function checkIfHasStudents($courseId) {
    $cbl = new BLCourses();
    $result = $cbl->getAllEnrolled($courseId);
    return $result;
  }
  
  public static function deleteCourse($courseId){
    $cbl = new BLCourses();
    $deletedCourse = $cbl->getOne($courseId);
    $deletedCourseImage = "../uploads/courses/courses-cover-images/".$deletedCourse->course_image;
     
    if (unlink($deletedCourseImage)) {
      $cbl->delete($courseId);
      } else {
      return AlertService::createAlert('Something went wrong try again', '', 'danger');
      }
  }
}

?>