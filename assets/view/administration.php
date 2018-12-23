<?php
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
        <button name='add-course' class='btn btn-danger'>+</button>
    </div>
  </li>
  <?php foreach ($allAdmins as $index => $admin) {
    
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
  ?>
</ul>
</div>



</form>

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
  <button name='edit-student<?php echo $selectedAdmin->admin_id ?>' value='<?php echo $selectedAdmin->admin_id ?>' class='btn btn-lg btn-primary'>Edit Admin</button>
  </div>
  </div>
</div>
  </div>
  <?php 
  }


}
?>
