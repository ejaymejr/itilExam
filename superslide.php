<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
?>
<?php include_once 'lib/_headerFile.php'; ?>
<?php include_once 'lib/_navigationBar.php'; ?>
<?php include_once 'lib/_connection.php'; ?>
<body class="metro">
  <div id="slides">
    <div class="slides-container">
      <img src="images/people.jpeg" alt="Cinelli">
      <img src="images/surly.jpeg" width="1024" height="682" alt="Surly">
      <img src="images/cinelli-front.jpeg" width="1024" height="683" alt="Cinelli">
      <img src="images/affinity.jpeg" width="1024" height="685" alt="Affinity">
    </div>

    <nav class="slides-navigation">
      <a href="#" class="next">Next</a>
      <a href="#" class="prev">Previous</a>
    </nav>
  </div>
  <script src="javascripts/jquery.easing.1.3.js"></script>
  <script src="javascripts/jquery.animate-enhanced.min.js"></script>
  <script src="../dist/jquery.superslides.js" type="text/javascript" charset="utf-8"></script>
  <script>
    $(function() {
      $('#slides').superslides({
        hashchange: true
      });
    });
  </script>
</body>

