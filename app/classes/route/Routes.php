<?php
Route::set($_GET['url'],function($route) {
  HomePageController::createView("$route.php");   
}); 
 
?>