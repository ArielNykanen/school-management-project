<?php
require_once "controller.php";
require_once "../app/classes/upload.php";

class AddCourseController extends Controller {

  public static function validateForm($courseDetails){
    $cbl = new BLCourses();
    $allCourses = $cbl->get();
    foreach ($courseDetails as $key => $detail) {
      if ($detail === '' || ctype_space($detail)) {
      $key = str_replace('_', ' ', $key);
      return AlertService::createAlert('Form Is Not Valid!',   $key  . ' field is required!', 'danger');
    }
  }
  
  foreach ($allCourses as $course) {
    if ($course->course_name === $courseDetails['course_name']) {
      return AlertService::createAlert('Course named  ' . $course->course_name . ' is already in the database!', '', 'danger');
    }
  }

  if (!UploadFile::isImage($courseDetails['course_image'])) {
    return AlertService::createAlert('Form Is Not Valid!', 'Upload only image files!', 'danger');
  }

  return true;

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
}

?>