<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!-- todo make the footer change when you open tabs -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <div class="footer bg-dark" id='footer'>
      <div class="container bg-default text-center">
        <a href='#'><i class="fa fa-linkedin fa-3x fa-fw"></i></a>
        <a href='#'><i class="fa fa-github fa-3x fa-fw"></i></a>
      </div>
      <span class='text-white ml-4'>© 2018 Ariel Nykänen All Rights Reserved.</span>
    </div>
    
    <script>

    $(document).ready(function() {
  
  function setFooter() {
  var docHeight = $(window).height();
  var footerHeight = $('#footer').height();
  var footerTop = $('#footer').position().top + footerHeight;

  if (footerTop < docHeight) {
    $('#footer').css('margin-top', 10+ (docHeight - footerTop) + 'px');
  }
  };
  setFooter();
  $(document).click(function() {
    setTimeout(() => {
    setFooter();
    }, 150);
  });
  
  });
</script>