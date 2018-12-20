<?php
    require_once 'BusinessLogic.php';
    require_once '../app/models/AdminsModel.php';

class BLStudents extends BusinessLogic {

  public function get()
  {
      $query = 'SELECT * FROM `students`';

      $result = $this->dal->select($query);
      $resultsArray = [];

      while ($row = $result->fetch()) {
          array_push($resultsArray, new StudentModel($row));
      }
      return $resultsArray;
  }

  public function getByEmail($email)
  {
      $q = 'SELECT * FROM `students` WHERE student_email=?';
      
      $params = array(
          $email
      );

      $results = $this->dal->select($q, $params);
      $resultsArray = [];

      while ($row = $results->fetch()) {
          array_push($resultsArray, new StudentModel($row));
      }

      return $resultsArray;
  }

  public function getOne($id, $loadSubModels = false)
  {
      $queryStudent = 'SELECT * FROM `students` WHERE student_id = :studentId';
      $resultsStudent = $this->dal->select($queryStudent, [
          'studentId' => $id
      ]);
      $row = $resultsStudent->fetch();
      $student = new StudentModel($row);
      if ($loadSubModels) {
          $course = new BLCourses;
          $queryCourse = 'SELECT * FROM `sc-connector` WHERE student_id = :studentId';
          $enrolledResults = $this->dal->select($queryCourse, [
              'studentId' => $id
          ]);
          
          while ($row = $enrolledResults->fetch()) {
              array_push($student->courseModelArray, $course->getOne($row['course_id']));
          }
      }
      return $student;
  }

  public function set($newStudent)
  {   
      // todo make it for the student
      $query = "INSERT INTO `students`( `student_name`, `student_phone`, `student_email`, `student_image`) VALUES (:sn, :sp, :se, :si)";
      $params = array(
          "sn" => $newStudent->student_name,
          "sp" => $newStudent->student_phone,
          "se" => $newStudent->student_email,
          "si" => $newStudent->student_image,
      );

      $this->dal->insert($query, $params);
  }

  public function update($a)
  {

    //todo make it update by array of name id or any other ways coalesce
      // todo make it for the student

      $query = "UPDATE `users` SET `users_name`=? WHERE `users_id`=?";

      $params = array(
          $a->getUserName(),
          $a->getUserId()
      );

      $this->dal->update($query, $params);
  }

  public function delete($studentId)
  {
      // todo make it for the student

      $query = "DELETE FROM `students` WHERE `student_id` = :si";

      $params = array(
          "si" => $studentId
      );

      $this->dal->delete($query, $params);
  }

  public function deleteAllCourses($studentId) {

    $query = "DELETE FROM `sc-connector` WHERE `student_id` = :si";

    $params = array(
        "si" => $studentId
    );

    $this->dal->delete($query, $params);
  }

}


?>