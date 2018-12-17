<?php
    require_once 'BusinessLogic.php';
    require_once 'app/models/AdminsModel.php';

class BLRoles extends BusinessLogic {

  public function get()
  {
      $query = 'SELECT * FROM `roles`';

      $result = $this->dal->select($query);
      $resultsArray = [];

      while ($row = $result->fetch()) {
          array_push($resultsArray, new RoleModel($row));
      }
      return $resultsArray;
  }

  

  public function getOne($id)
  {
    //todo make it get by array of name id or any other ways coalesce

      $q = "SELECT * FROM `roles` WHERE role_id = :id";

      $results = $this->dal->select($q, [
          'id' => $id
      ]);
      $row = $results->fetch();
      return new RoleModel($row);
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