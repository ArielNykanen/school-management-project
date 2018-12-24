    <?php
    require_once 'model.php';
    require_once '../app/bl/BLAdmins.php';

class StudentModel implements Imodel {

  private $student_id;
  private $student_name;
  private $student_phone;
  private $student_email;
  private $student_image;
  public $courseModelArray;

  public function __construct($arr) {
    if (!empty($arr['student_id']))
    $this->student_id = $arr['student_id'];

    $this->courseModelArray = [];
    $this->student_name = $arr["student_name"];
    $this->student_phone = $arr["student_phone"];
    $this->student_email = $arr["student_email"];
    $this->student_image = $arr["student_image"];
  
  }


  function getCourseModelArray() {
    return $this->courseModelArray;
}

function __get($data){
    return $this->$data;
  
}

function __set($data, $data2){
  $this->$data = $data2;
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