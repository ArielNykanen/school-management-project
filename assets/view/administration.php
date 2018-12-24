<?php

if (
isset($_POST['add-admin']) &&
isset($_POST['admin-name']) &&
isset($_POST['admin-phone']) &&
isset($_POST['admin-email']) &&
isset($_POST['admin-password']) &&
isset($_POST['admin-role'])
) {
  
  $adminDetails = [
    'admin_name' => $_POST['admin-name'],
    'admin_phone' => $_POST['admin-phone'],
    'admin_email' => $_POST['admin-email'],
    'admin_password' => $_POST['admin-password'],
    'admin_role' => $_POST['admin-role'],
    'admin_image' => $_FILES['admin-image'],
  ];


  if(AdminController::validateForm($adminDetails)) {
    AdminController::uploadAdmin($adminDetails);
  }

}

if (
  isset($_POST['save-edit']) &&
  isset($_POST['admin-name']) &&
  isset($_POST['admin-phone']) &&
  isset($_POST['admin-email']) &&
  isset($_POST['admin-password']) &&
  isset($_POST['admin-role'])
  ) {
    
    $adminDetails = [
      'admin_id' => $_POST['save-edit'],
      'admin_name' => $_POST['admin-name'],
      'admin_phone' => $_POST['admin-phone'],
      'admin_email' => $_POST['admin-email'],
      'admin_password' => $_POST['admin-password'],
      'admin_role' => $_POST['admin-role'],
      'admin_image' => $_FILES['admin-image'],
    ];
  
  
    if(AdminController::validateForm($adminDetails, $adminDetails['admin_id'])) {
      // AdminController::uploadAdmin($adminDetails);
    }
  
  }


$abl = new BLAdmins();
$allAdmins = $abl->get();

?>

<!-- Admins Section -->
<form action="administration" method="POST" enctype="multipart/form-data">
<div class="col-md-6 col-lg-4 order-3 order-lg-1 bg-sections">
<ul class="list-group">
<li class="list-group-item d-flex justify-content-between align-items-center">
  <h4>Admins</h4>
    <div  align=right>
        <button name='add-admin' class='btn btn-danger'>+</button>
    </div>
  </li>
  <?php
  $adminDetails = Session::get('admin_logged');
  $loggedAdmin = $abl->getByEmail($adminDetails['admin_email']);
  foreach ($allAdmins as $index => $admin) {
    if ($admin->admin_role === 1 && $loggedAdmin[0]->admin_role > 1) {
    ?>  
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <button type='button' class='btn section-btn' disabled>
      <div class="row">
        <div class="col-5 mr-2">
          <img style="width:100px; height:100px;" src="../uploads/profiles/images/admins/<?php echo $admin->adminRole()->role_level; ?>/<?php echo $admin->admin_image; ?>" alt="admin-image">
        </div>
        <div class="col-5 mr-2">
          <p><?php echo $admin->admin_name ?></p>
          <p><?php echo $admin->adminRole()->role_level ?></p>
        </div>
      </div>
    </button>
  </li>
  <?php
  } else {
    ?>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <button name='admin<?php echo $admin->admin_id ?>' type='submit' value='<?php echo $admin->admin_id ?>' class='btn section-btn'>
      <div class="row">
        <div class="col-5 mr-2">
          <img style="width:100px; height:100px;" src="../uploads/profiles/images/admins/<?php echo $admin->adminRole()->role_level; ?>/<?php echo $admin->admin_image; ?>" alt="admin-image">
        </div>
        <div class="col-5 mr-2">
          <p><?php echo $admin->admin_name ?></p>
          <p><?php echo $admin->adminRole()->role_level ?></p>
        </div>
      </div>
    </button>
  </li>

    <?php
  }
  } 
  ?>
</ul>
</div>



</form>
<form action="administration" method="POST" enctype="multipart/form-data">
<?php
foreach ($allAdmins as $admin) {
  if (isset($_POST['admin'.$admin->admin_id])) {
  $selectedAdmin = $abl->getOne($_POST['admin'.$admin->admin_id]);
?>
  <div class="col-md-12 col-lg-3 order-1 order-lg-3"> 
    <div class="card border-default mb-3 bg-card text-center" style="width: 30rem;">
  <div class="card-header bg-dark border-default">
    <h4>
    Admin Info
    </h4>
  </div>
  <div class="card-body text-default">
  <img style='height:200px; max-height: 200px; width: 50%;' src="../uploads/profiles/images/admins/<?php echo $admin->adminRole()->role_level; ?>/<?php echo $admin->admin_image; ?>" alt="">
    <h5 class="card-title">
    </h5>
    <p class="card-text">Name: <?php echo $selectedAdmin->admin_name; ?></p>
    <p class="card-text">Phone: <?php echo $selectedAdmin->admin_phone; ?></p>
    <p class="card-text">Email: <?php echo $selectedAdmin->admin_email; ?></p>
    
  </div>
  <div class="card-footer bg-dark border-default">
  <div class="mr-2 text-center">
  <button name='edit-admin<?php echo $selectedAdmin->admin_id ?>' value='<?php echo $selectedAdmin->admin_id ?>' class='btn btn-lg btn-primary'>Edit Admin</button>
  </div>
  </div>
</div>
  </div>
  <?php 
  }


}

?>
</form>
<?php
    if (isset($_POST['add-admin'])) {
      include_once "add-admin.php";
      }
    
      foreach ($allAdmins as $admin) {
      if (isset($_POST['edit-admin'.$admin->admin_id])) {
        $editAdmin = $abl->getOne($_POST['edit-admin'.$admin->admin_id]);
        include_once "edit-admin.php";
      }
      }
?>
