<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="http://localhost/school-management-project/public/"> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>>>>23<<<</title>
  </head> 
  <div id="bg-img-school">
</div>
    <?php
    require_once "../assets/view/main-navbar.php";
    ?>
  <body> 
  <div class="container-fluid">
    
    <?php
// create the routing system

// will require the files automaticaly 

function __autoload($class_name) {
  if (file_exists("../app/classes/".$class_name.".php")) {
    require_once "../app/classes/".$class_name.".php";
  } else if (file_exists("../app/controllers/".$class_name.".php")) { 
    require_once "../app/controllers/".$class_name.".php";
  } else if (file_exists("../app/bl/".$class_name.".php")) { 
    require_once "../app/bl/".$class_name.".php";
  } else if (file_exists("../app/models/".$class_name.".php")) {
    require_once "../app/models/".$class_name.".php";
  }
}


require_once "../app/classes/Routes.php";

?>

</div>
<footer>
  <?php
  include "../assets/view/footer.php";
  ?>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/2.3.2/mustache.js"></script>
</body>
</html>
