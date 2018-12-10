<?php
require_once "app/bl/BusinessLogic.php";
class Controller extends BusinessLogic {
  public static function createView ($view) {
      require_once "assets/view/$view";
  }
  
  function get() {}
  function set($r) {}
  function update($r) {}
  function delete($r) {}
}
?>