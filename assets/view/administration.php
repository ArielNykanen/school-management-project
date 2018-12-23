<?php
$abl = new BLAdmins();
$allAdmins = $abl->get();
?>
<!-- Admins Section -->

<div class="col-md-6 col-lg-4 order-3 order-lg-1 bg-sections">
<ul class="list-group">
<li class="list-group-item d-flex justify-content-between align-items-center">
  <h4>Courses</h4>
    <div  align=right>
        <button name='add-course' class='btn btn-danger'>+</button>
    </div>
  </li>
  <?php foreach ($allAdmins as $index => $admin) {
    
  ?>  
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <button name='course<?php echo $admin->admin_id ?>' type='submit' value='<?php echo $admin->admin_id ?>' class='btn section-btn'>
      <div class="row">
        <div class="col-5 mr-2">
          <img style="width:100px; height:100px;" src="../uploads/profiles/images/admins/<?php echo $admin->adminRole()->role_level; ?>/<?php echo $admin->admin_image; ?>" alt="admin-image">
        </div>
        <div class="col-5 mr-2">
          <p><?php echo $admin->admin_name ?></p>
        </div>
      </div>
    </button>
  </li>
  <?php
  } 
  ?>
</ul>
</div>
