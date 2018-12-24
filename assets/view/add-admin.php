
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="col-lg-3 order-1 order-lg-3">
      <div class="card border-default mb-3 bg-card text-center">
            <div class="card-header bg-dark border-default">
              <h4>
              Add New Admin
            </h4>
          </div>
          
          <div class="card-body text-default">
            <h5 class="card-title">
              <div id="preview">
                <img width="160px" height="120px" src="../uploads/profiles/images/students/defaultStudent.png" alt='Image Preview' id="imagePre" />
              </div>
            </h5>
            <label>Admin Name
              <input name='admin-name' type="text" class='form-control'>
            </label>
            <label>Admin Phone
                <input name='admin-phone' type="text" class='form-control'>
              </label>
              <label>Admin Email
                <input name='admin-email' type="text" class='form-control'>
              </label>
              <label>Admin Password
                <input name='admin-password' type="password" class='form-control'>
              </label>
              <label>Admin Role
                <select class='form-control' name="admin-role">
                  <?php 
                $rbl = new BLRoles();
                $allRoles = $rbl->get();
                foreach ($allRoles as $role) {
                  if ($loggedAdmin[0]->admin_role < 2 && $role->role_id < 2 && $role->role_id < 4) {
                    ?>
              <option value="<?php echo $role->role_id ?>"><?php echo $role->role_level ?></option>
              <?php
              } else if ($loggedAdmin[0]->admin_role >= 1 && $role->role_id > 1 && $role->role_id < 4) {
              ?>
              <option value="<?php echo $role->role_id ?>"><?php echo $role->role_level ?></option>
              <?php
              }
              }
              ?>
              </select>
            </label>
            <label>Admin Image
              <div class="custom-file">
                <input name='admin-image' onchange="readURL(this);" value='default-image' type="file" class="custom-file-input" id="inputGroupFile02">
                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"></label>
              </div>
            </label>
          </div>
          <div class="card-footer bg-dark border-default">
            <button name='add-admin' class='btn btn-lg btn-success'>Add Admin</button>
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

</form>