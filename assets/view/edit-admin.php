



 
  <form action="" method="POST" enctype="multipart/form-data">
<div class="col-md-12 col-lg-3 order-1 order-lg-3"> 
    <div class="card border-default mb-3 bg-card text-center" style="width: 30rem;">
  <div class="card-header bg-dark border-default">
    <h4>
    Edit Admin
    </h4>
  </div>
  <div class="card-body text-default">
    <h5 class="card-title">
      <div id="preview">
          <img style='height:200px; max-height: 200px; width: 50%;' id="imagePre" src="../uploads/profiles/images/admins/<?php echo $editAdmin->adminRole()->role_level; ?>/<?php echo $admin->admin_image; ?>" alt="">
        </div>
    </h5>

    <label>Image</label>
    <input name='admin-image' type="file"  onchange="readURL(this);" class='form-control'>
    <label>Name</label>
    <input name='admin-name' class="text-dark form-control" value="<?php echo $editAdmin->admin_name; ?>">
    <label>Phone</label>
    <input name='admin-phone' class="text-dark form-control" value="<?php echo $editAdmin->admin_phone; ?>">
    <label>Email</label>
    <input name='admin-email' class="text-dark form-control" value="<?php echo $editAdmin->admin_email; ?>">
    <label>Password</label>
    <input name='admin-password' class="text-dark form-control" placeholder='re-enter password to save'>
   
    <label>Change Role</label>
    <select class='form-control' name="admin-role[]" id="">
    <?php
  
    $rbl = new BLRoles(); 
    $allRoles = $rbl->get();
    foreach ($allRoles as $key => $role) {
      if ($editAdmin->admin_role > 1 && $role->role_id > 1 && $loggedAdmin[0]->admin_role === 1) {
    ?>
    <option value="<?php echo $role->role_id ?>"><?php echo $role->role_level ?></option>
    <?php
      } else if ($editAdmin->admin_role >= 2 && $role->role_id === 2) {
    ?>
        <option value="<?php echo $role->role_id ?>"><?php echo $role->role_level ?></option>
    <?php
      } else if ($editAdmin->admin_role > 2 && $role->role_id >= 2) {
        ?>
        <option value="<?php echo $role->role_id ?>"><?php echo $role->role_level ?></option>
        <?php
      }
    }
    ?>
    </select>

  </div>
  <div class="card-footer bg-dark border-default">
  <div class="mr-2 text-center">
  <button name='save-edit' value='<?php echo $editAdmin->admin_id ?>' class='btn btn-lg btn-primary'>Save Changes</button>
  <?php
  if ($loggedAdmin[0]->admin_role > 1 && $editAdmin->admin_role !== 2) {
    ?>
  <button name='delete-admin' value='<?php echo $editAdmin->admin_id ?>' class='btn btn-lg btn-danger ml-4'>Delete Admin</button>
  <?php
  } else if ($loggedAdmin[0]->admin_role === 1) {
    ?>
    <button name='delete-admin' value='<?php echo $editAdmin->admin_id ?>' class='btn btn-lg btn-danger ml-4'>Delete Admin</button>
  <?php
  }
  ?>
  </div>
  </div>
</div>
  </div>
  </form>

  <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imagePre').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
  </script>
