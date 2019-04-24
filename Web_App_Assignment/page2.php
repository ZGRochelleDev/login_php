<?php include 'header.php'; ?>

<!DOCTYPE html>
<html>
<head>
<!--CSS -->
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="/js/jquery/3.3.1/jquery-3.3.1.min.js"></script>
<!--bootstrap -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
  <div>
  <h1 class="center-text"><?php echo 'Welcome ' . $_SESSION['KM-Homework-Session']; ?></h1>
  <h4 class="center-text">Page 2</h4>
  <p class="center-text"><a href=".//homepage.php">Home</a>	||	<a href=".//page1.php">Page 1</a></p>
  <div class="center-text"><?php echo '<a href="./logout.php"><button>LOGOUT?</button></a>' ?></div>
  </div>

<div class="panel-center">
<div class="panel panel-default">
<div class="panel-heading">
<h1 class="panel-title">Cookies</h1>
</div>
<div class="panel-body">
<?php foreach ($_COOKIE as $key=>$val) {
  echo $key . ' is:  ' . $val . "<br>\n";
}
?>
</div>
</div>
</div>

</body>

<script>
</script>

</html>
