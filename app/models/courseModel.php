<?php
    require_once 'model.php';
    require_once '../app/bl/BLAdmins.php';

class CourseModel implements Imodel {

  private $course_id;
  private $course_name;
  private $course_description;
  private $course_image;
  private $course_max_students;
  private $created_at;
  private $updated_at;
  public $studentModelArray;
  
  public function __construct($arr) {
    if (!empty($arr['course_id']))
    $this->course_id = $arr['course_id'];
    
    $this->studentModelArray = [];
    $this->course_name = $arr["course_name"];
    $this->course_description = $arr["course_description"];
    $this->course_image = $arr["course_image"];
    $this->course_max_students = $arr["course_max_students"];
    
  }

  function getStudentModelArray() {
    return $this->studentModelArray;
}

function __get($data){
    return $this->$data;
  
}

function __set($data, $data2){

}



// Lazy load
//  function someModel() {
//   if (empty($this->someModel)) {
//       $sbl= new BusinessLogicSome();
//       $this->someModel = $pbl->getOne($this->some_id);
//   }
//   return $this->someModel;
// }

}

?>