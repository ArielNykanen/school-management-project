<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <div class="footer" id='footer'>
      <div class="container">
              <a href='#'><i class="fa fa-twitch fa-3x fa-fw"></i></a>
              <a href='#'><i class="fa fa-facebook fa-3x fa-fw"></i></a>
              <a href='#'><i class="fa fa-twitter fa-3x fa-fw"></i></a>
              <a href='#'><i class="fa fa-youtube-play fa-3x fa-fw"></i></a>
              <a href='#'><i class="fa fa-rss fa-3x fa-fw"></i></a>
              <a href='#'><i class="fa fa-vine fa-3x fa-fw"></i></a>
              <a href='#'><i class="fa fa-flickr fa-3x fa-fw"></i></a>
              <a href='#'><i class="fa fa-linkedin fa-3x fa-fw"></i></a>
            </span>
      </div>
    </div>
    <script>
    function setFooterStyle() {
        var docHeight = $(window).height();
        var footerHeight = $('#footer').outerHeight();
        var footerTop = $('#footer').position().top + footerHeight;
        if (footerTop < docHeight) {
            $('#footer').css('margin-top', (docHeight - footerTop) + 'px');
        } else {
            $('#footer').css('margin-top', '2%');
        }
        $('#footer').removeClass('invisible');
    }
    $(document).ready(function() {
        setFooterStyle();
        window.onresize = setFooterStyle;
    });
</script>