<?php
  $logged = Session::has('admin_logged');
if ($logged) {
$adminDetails = Session::get('admin_logged');
$abl = new BLAdmins();
echo $logged['admin_email'];
$loggedAdmin = $abl->getByEmail($adminDetails['admin_email']);
$loggedAdminRole = $loggedAdmin[0]->adminRole();
?>
<nav class="main-navbar navbar navbar-expand-md navbar-light bg-navbar">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white" href="school">School <span class="sr-only">(current)</span></a>
      </li>
      <?php
      if ($loggedAdmin[0]->admin_role < 3) {
        ?>
      <li class="nav-item">
        <a class="nav-link text-white" href="administration">Administration<span class="sr-only">(current)</span></a>
      </li>
      <?php 
      }
      ?>
    </ul>
        <ul class='navbar-nav navbar-right'>
          <li class="nav-item">
            <div class="text-white">
              <span class='mr-4'><?php echo $loggedAdmin[0]->admin_name; ?>. <?php echo $loggedAdminRole->role_level ?></span>
              <img id='admin-profile-pic' src="../uploads/profiles/images/admins/<?php echo $loggedAdminRole->role_level; ?>/<?php echo $loggedAdmin[0]->admin_image; ?>" alt="profile image">
            </div>
          </li>
          <li class="nav-item text-white">
          <a class='nav-link text-white' href="log-out">
            Log Out
            <i class="fa fa-sign-out" aria-hidden="true"></i>
          </a>
          </li>
        </ul>
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