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

  public function update($admin) {
    $id = $admin->admin_id;
    $query = "UPDATE `administrator` SET `admin_name`= ?,`admin_role`= ?,`admin_phone`= ?,`admin_email`= ?,`admin_image`= ?,`admin_password`= ? WHERE admin_id = $id";

    $params = array(
      $admin->admin_name,
      $admin->admin_role,
      $admin->admin_phone,
      $admin->admin_email,
      $admin->admin_image,
      $admin->admin_password,
    );

      $this->dal->update($query, $params);
  }

  public function delete($adminId)
  {
      $query = "DELETE FROM `administrator` WHERE `admin_id` = :ai";

      $params = array(
          "ai" => $adminId
      );

      $this->dal->delete($query, $params);
  }

}


?>