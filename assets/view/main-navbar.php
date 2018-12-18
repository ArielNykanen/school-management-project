<?php
  $logged = Session::has('admin_logged');
if ($logged) {
$adminDetails = Session::get('admin_logged');
$abl = new BLAdmins();
echo $logged['admin_email'];
$loggedAdmin = $abl->getByEmail($adminDetails['admin_email']);
$loggedAdminRole = $loggedAdmin[0]->adminRole();

?>
<nav class="navbar navbar-expand-lg navbar-light bg-navbar">
  <a class="navbar-brand text-white"  href="school">S-M-P</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ">
      <li class="nav-item">
        <a class="nav-link text-white" href="school">School <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#">Administraton<span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item text-white" href="#">Action</a>
          <a class="dropdown-item text-white" href="#">Another action</a> 
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-white" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled  text-white" href="#">Disabled</a>
      </li>
    </ul>
        <div class="row">
          <div class="col-md-6 text-white">
            <p><?php echo $loggedAdmin[0]->admin_name; ?>. <?php echo $loggedAdminRole->role_level ?></p>
          </div> 
        <div class="col-md-6">
        
        <img style="width:100px; height:70px;" src="../uploads/profiles/images/admins/<?php echo $loggedAdminRole->role_level; ?>/<?php echo $loggedAdmin[0]->admin_image; ?>" alt="profile image">
        <!-- <img style="width:200px; height:200px;" src="uploads/admins/ss.jpg" alt="<?php echo $loggedAdmin[0]->admin_image; ?>"> -->
        </div>
        </div>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
  </div>
</nav>
<?php 
} else {
  ?>
<nav class="navbar navbar-expand-lg navbar-light bg-navbar">
  <a class="navbar-brand text-white" href="school">S-M-P</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-white" href="school">Login<span class="sr-only">(current)</span></a>
      </li>
</nav>
<?php
}
?>