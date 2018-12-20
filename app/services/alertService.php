<?php

class AlertService {

  static function createAlert($header, $msg, $type) {
    echo '<div class="col-12 alert alert-' . $type . '" role="alert">
    <h4 class="alert-heading">' . $header . '</h4>
    <p>' . $msg . '</p>
    </div>';
  }

  static function greetings($username) {
    echo '<div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Welcome back ' . $username . '</h4>
    </div>';


  }

}

?>