<?php
if(!Session::has('user_id')) {
  header('Location:login');
}

Session::get('admin_role');



  



?>