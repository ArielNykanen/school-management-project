<?php

class Route {
  private static $mainPage = 'index.php';
  private static $notFoundPage = 'not-found';
  public static $validRoutes = array('login', 'school');

  public static function set($route, $function){
    foreach (self::$validRoutes as $route) {
     if ($_GET['url'] === $route) {
      $function->__invoke($route);
      return;
    }
  }
  
  if ($_GET['url'] === 'index.php') {
    $function->__invoke('school');
  } else {
    // if the current url is not in the array of urls it will direct user to not found page.
    $function->__invoke(self::$notFoundPage);
  }

  }
}
?>