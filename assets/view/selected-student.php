<?php
if(isset($_POST['student'])) {
  $selectedStudent = $sbl->getOne($_POST['student']);
?>
  <div class="col-lg-4 order-1 order-lg-3"> 
    <div class="card border-default mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-default"><?php echo $selectedStudent->student_name ?></div>
  <div class="card-body text-default">
  <img style='height:200px; max-height: 200px; width: 100%;' src="https://pixabay.com/get/e830b4072ce9002ad25a5840981318c3fe76e7d11cb1144392f7c1/book-15584_1920.jpg" alt="">
    <h5 class="card-title">
    <?php
     echo $selectedStudent->student_name;
    ?>
    </h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
  <div class="card-footer bg-transparent border-default">
  <div class="row">
  <div class="col-xs-5 mr-2">
  <button name='edit-student' value='<?php echo $selectedStudent->student_id ?>' class='btn btn-warning'>Edit Student</button>
  </div> 
  </div>
  </div>
</div>
  </div>
  <?php 
}
?>
