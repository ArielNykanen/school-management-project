<?php

class BLAlerts extends BusinessLogic {

  function createAlert($header, $msg, $type) {
    echo `
    <div class="alert alert-$type" role="alert">
    <h4 class="alert-heading">$header</h4>
    <p>$msg</p>
    </div>
   `;
  }

}

?>