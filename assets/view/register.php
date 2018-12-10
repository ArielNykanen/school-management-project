<?php
// foreach ($allUsers as $user) {
  
//   echo $user->user_name . "<br>";
//   echo $user->user_email . "<br>";
//   echo $user->user_lastname . "<br>";
//   echo $user->user_password . "<br>";
  
// }

$dal = new BusinessLogic();
$users = new BLUsers();
$allUsers = $users->get();

if (isset($_POST['register-submit'])){

  // todo do some validation you need to.

  // todo if (empty etc...) {} 

$users->set(
  $user = new UsersModel([
    'users_name' => $_POST['username'],
    'users_lastname' => $_POST['lastname'],
    'users_email' => $_POST['email'],
    'users_password' => md5($_POST['password']),
    ])
  );
  
}

?>


<div id="loginRegisterWrap">
  <div align=center >
 
			<div class="col-md-6 col-md-offset-3">
        <h1>Register</h1>
      </div>
          <hr>
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="register" method="post" role="form">
									<div class="form-group">
                  <label>Name</label>
										<input type="text" name="username" class="form-control w-50" placeholder="Enter Username" value="">
                  
                  </div>
                  
									<div class="form-group">
                  <label>Last Name</label>
										<input type="text" name="lastname" id="lastname" class="form-control w-50" placeholder="Enter Lastname" value="">
                  
									</div>
									<div class="form-group">
                  <label>Email</label>
										<input type="email" name="email" class="form-control w-50" placeholder="Enter Email" value="">
                  
									</div>
									<div class="form-group">
                  <label>Password</label>
										<input type="password" name="password" tabindex="2" class="form-control w-50" placeholder="Enter Password">
									</div>
									<div class="form-group">
                  <label>Repeat Password</label>
										<input type="password" name="password" tabindex="2" class="form-control w-50" placeholder="Repeat Password">
									</div>
									<!-- <div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div> -->
									<div align=center class="form-group">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-success  w-50" value="Register">
											</div>
									</div>
						
							<div class="col-xs-6">
              <label>Registered?</label>
								<a href="login" id="register-form-link">Click To Log in</a>
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

							