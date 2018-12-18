<?php
    require_once 'BusinessLogic.php';
    require_once '../app/models/AdminsModel.php';

class BLCourses extends BusinessLogic {

  public function get() {
      $query = 'SELECT * FROM `courses`';

      $result = $this->dal->select($query);
      $resultsArray = [];

      while ($row = $result->fetch()) {
          array_push($resultsArray, new CourseModel($row));
      }
      return $resultsArray;
  }

  public function getByEmail($email)
  {
      $q = 'SELECT * FROM `administrator` WHERE admin_email=?';
      
      $params = array(
          $email
      );

      $results = $this->dal->select($q, $params);
      $resultsArray = [];

      while ($row = $results->fetch()) {
          array_push($resultsArray, new AdminsModel($row));
      }

      return $resultsArray;
  }

  public function getOne($id, $loadSubModels = false)
        {
            $queryCourse = 'SELECT * FROM `courses` WHERE course_id = :courseId';
            $resultsCourse = $this->dal->select($queryCourse, [
                'courseId' => $id
            ]);
            $row = $resultsCourse->fetch();
            $course = new CourseModel($row);
            if ($loadSubModels) {
                $student = new BLStudents;
                
                $queryStudent = 'SELECT * FROM `sc-connector` WHERE course_id = :courseId';
                
                $enrolledResults = $this->dal->select($queryStudent, [
                    'courseId' => $id
                ]);
                while ($row = $enrolledResults->fetch()) {
                    array_push($course->studentModelArray, $student->getOne($row['student_id']));
                }
            }
            return $course;
        }

  public function set($a)
  {   
      $query = "INSERT INTO `users`( `users_name`, `users_lastname`, `users_email`, `users_password`) VALUES (:un, :uln, :ue, :up)";

      $params = array(
          "un" => $a->user_name,
          "uln" => $a->user_lastname,
          "ue" => $a->user_email,
          "up" => $a->user_password,
      );


      $this->dal->insert($query, $params);
  }

  public function update($a)
  {

    //todo make it update by array of name id or any other ways coalesce

      $query = "UPDATE `users` SET `users_name`=? WHERE `users_id`=?";

      $params = array(
          $a->getUserName(),
          $a->getUserId()
      );

      $this->dal->update($query, $params);
  }

  public function delete($id)
  {
      $query = "DELETE FROM `users` WHERE `users_id` = :ui";

      $params = array(
          "ui" => $id
      );

      $this->dal->delete($query, $params);
  }

}


?>