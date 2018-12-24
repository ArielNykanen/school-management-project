<div class="col-md-12 col-lg-3 order-1 order-lg-3"> 
    <div class="card border-default mb-3 bg-card text-center" style="width: 30rem;">
  <div class="card-header bg-dark border-default">
    <h4>
    Edit Admin
    </h4>
  </div>
  <div class="card-body text-default">
  <img style='height:200px; max-height: 200px; width: 50%;' src="../uploads/profiles/images/admins/<?php echo $editAdmin->adminRole()->role_level; ?>/<?php echo $admin->admin_image; ?>" alt="">
    <h5 class="card-title">
    <div id="preview">
            <img width="160px" height="120px" src="#" alt='Image Preview' id="imagePre" />
        </div>
    </h5>

    <label>Image</label>
    <input type="file"  onchange="readURL(this);" class='form-control'>
    <label>Name</label>
    <input class="text-dark form-control" value="<?php echo $editAdmin->admin_name; ?>">
    <label>Phone</label>
    <input class="text-dark form-control" value="<?php echo $editAdmin->admin_phone; ?>">
    <label>Email</label>
    <input class="text-dark form-control" value="<?php echo $editAdmin->admin_email; ?>">
    <?php
    if ($loggedAdmin[0]->admin_role <= 1) {

    ?>
    <label>Change Role</label>
    <select class='form-control' name="adminRole[]" id="">
    <?php

    $rbl = new BLRoles();
    $allRoles = $rbl->get();
    foreach ($allRoles as $key => $role) {
    ?>
    <option value="<?php $role->role_id ?>"><?php echo $role->role_level ?></option>
    <?php
      }
    }
    ?>
    </select>
  </div>
  <div class="card-footer bg-dark border-default">
  <div class="mr-2 text-center">
  <button name='save-admin-edit' value='<?php echo $editAdmin->admin_id ?>' class='btn btn-lg btn-primary'>Save Changes</button>
  </div>
  </div>
</div>
  </div>
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