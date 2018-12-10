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

if (isset($_POST['login-submit'])) {

  LoginController::checkValidForm();

}

?>


<div id="loginRegisterWrap">
  <div align=center >
 
			<div class="col-md-6 col-md-offset-3">
        <h1>Log->In</h1>
      </div>
          <hr>
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="" method="post" role="form">
								
									<div class="form-group">
                  <label>Email</label>
										<input type="email" name="email" id="username" class="form-control w-50" placeholder="Enter Email" value="">
                  
									</div>
									<div class="form-group">
                  <label>Password</label>
										<input type="password" name="password" id="password" tabindex="2" class="form-control w-50" placeholder="Enter Password">
									</div>
								
									<!-- <div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div> -->
									<div align=center class="form-group">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-success  w-50" value="Log In">
											</div>
									</div>
						
							<div class="col-xs-6">
              <label>Not Registered?</label>
								<a href="register" id="register-form-link">Click To Register</a>
							</div>
									<!-- <div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="https://phpoll.com/recover" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div> -->
        </form>
    </div>
  </div>
</div>

							