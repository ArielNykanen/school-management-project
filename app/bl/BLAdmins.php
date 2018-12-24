<?php
    require_once 'BusinessLogic.php';
    require_once '../app/models/AdminsModel.php';

class BLAdmins extends BusinessLogic {

  public function get()
  {
      $query = 'SELECT * FROM `administrator`';

      $result = $this->dal->select($query);
      $resultsArray = [];

      while ($row = $result->fetch()) {
          array_push($resultsArray, new AdminsModel($row));
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

  public function getOne($id)
  {
    //todo make it get by array of name id or any other ways coalesce

      $q = "SELECT * FROM `administrator` WHERE admin_id= :id";

      $results = $this->dal->select($q, [
          'id' => $id
      ]);
      $row = $results->fetch();
      return new AdminsModel($row);
  }

  public function set($admin)
  {   
      $query = "INSERT INTO `administrator`( `admin_name`, `admin_role`, `admin_phone`, `admin_email`, `admin_image`, `admin_password`) VALUES (:an, :ar, :aph, :ae, :ai, :ap)";

      $params = array(
          "an" => $admin->admin_name,
          "ar" => $admin->admin_role,
          "aph" => $admin->admin_phone,
          "ae" => $admin->admin_email,
          "ai" => $admin->admin_image,
          "ap" => $admin->admin_password,
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