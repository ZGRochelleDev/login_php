<!-- source: http://php.net/manual/en/function.session-destroy.php -->

<?php
session_name( 'KM-Homework-Session' );
session_start();
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body onload="deleteCookie()">

</body>

<script>

function deleteCookie() {
    var pathBits = location.pathname.split('/');
    var pathCurrent = ' path=';
    document.cookie = "KM-Homework-Cookie" + '=; expires=Thu, 01-Jan-1970 00:00:01 GMT;';
    for (var i = 0; i < pathBits.length; i++) {
        pathCurrent += ((pathCurrent.substr(-1) != '/') ? '/' : '') + pathBits[i];
        document.cookie = "KM-Homework-Cookie" + '=; expires=Thu, 01-Jan-1970 00:00:01 GMT;' + pathCurrent + ';';
    }
	location.href = "https://www.zoerochelle.com/php/project/login/loginpage.html";

}

</script>

</html>
