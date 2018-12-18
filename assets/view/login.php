<?php
// foreach ($allUsers as $user) {
  
//   echo $user->user_name . "<br>";
//   echo $user->user_email . "<br>";
//   echo $user->user_lastname . "<br>";
//   echo $user->user_password . "<br>";
  
// }Session::get('admin_role');

// $dal = new BusinessLogic();
// $admins = new BLAdmins();
// $allAdmins = $admins->get();
if (Session::has('admin_role')) {
  header('Location:school');
}
if (isset($_POST['login-submit'])) {
  LoginController::checkValidForm();
}

?>

<div id="loginRegisterWrap">
  <div align=center >
 
			<div class="col-md-6 col-md-offset-3">
        <h1>Sign In</h1>
      </div>
          <hr>
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="" method="post" role="form">
									<div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control w-50" placeholder="Enter Email" value="2323">
									</div>
									<div class="form-group">
                  <label>Password</label>
										<input type="password" name="password" id="password" tabindex="2" class="form-control w-50" placeholder="Enter Password">
									</div>
									<div align=center class="form-group">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-success  w-50" value="Log In">
											</div>
									</div>
        </form>
    </div>
  </div>
</div>

				<script>
        
      $(document).ready(() => {
        $('#email').focus(
          () => {
            console.log("from login page: make some validations using realtime js!!");
            
          }
        );
      });

        </script>			