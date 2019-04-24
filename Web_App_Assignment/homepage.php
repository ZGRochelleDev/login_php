<!-- https://stackoverflow.com/questions/2144386/how-to-delete-a-cookie -->

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
  <h4 class="center-text">This is a very pretty page.</h4>
  <p class="center-text"><a href=".//page1.php">Page 1</a>	||	<a href=".//page2.php">Page 2</a></p>
  <div class="center-text"><?php echo '<a href="./logout.php"><button>LOGOUT?</button></a>' ?></div>
  </div>
<div class="panel-center">
<div class="panel panel-default">
<div class="panel-heading">
<h1 class="panel-title">Cookies</h1>
</div>
<div class="panel-body">

<?php foreach ($_COOKIE as $key=>$val) {
	echo $key .' is:  '. $val ."<br>\n";
}
?>

</div>
</div>
</div>

</body>

<script>
/* removes cookie on logout */
function deleteCookie() {
    var pathBits = location.pathname.split('/');
    var pathCurrent = ' path=';
    document.cookie = "KM-Homework-Cookie" + '=; expires=Thu, 01-Jan-1970 00:00:01 GMT;';
    for (var i = 0; i < pathBits.length; i++) {
        pathCurrent += ((pathCurrent.substr(-1) != '/') ? '/' : '') + pathBits[i];
        document.cookie = "KM-Homework-Cookie" + '=; expires=Thu, 01-Jan-1970 00:00:01 GMT;' + pathCurrent + ';';
    }

}
</script>

</html>
