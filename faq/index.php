<?
include_once('database.php');

$faq_query = "select * from faq ";
$faq_query_run = mysqli_query($conn,$faq_query);

?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="js/script.js"></script>
  <title>jQuery FAQ Slider Demo</title>
 <? include_once('../header.php');?>
</head>

<body>
  <?
  include_once('../nav_bar.php');
  ?>



  <div id="container">
    <h1>jQuery FAQ Slider Demo</h1>
    <div class="title">
      <h3>FAQ Slider Using jQuery</h3>
    </div>
    <? while($faq_query_get_data = mysqli_fetch_assoc($faq_query_run)){ ?>
    <ul class="faq">
      <li class="q"><img src="img/arrow.png"><? echo $faq_query_get_data['question'] ?></li>
      <li class="a"><? echo $faq_query_get_data['answer'] ?></li>
    </ul>
    <? } ?>
  </div>
  <? include_once('../fotter.php') ?>
  <script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function () {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

    </script>
  
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>

</body>

</html>