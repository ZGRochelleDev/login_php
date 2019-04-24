<?php
require_once('conn.php');
require_once('../token.php');

$username_var = $_REQUEST['username'];
$password_var = $_REQUEST['password'];

function jsRedirect($url)
{
	echo ('<script type="text/javascript">window.location="'.$url.'";</script>');
	exit(0);
}

/*check to see if user exists*/
function get_login($username,$password,$db){
  //echo $username;
  //echo $password;
  $user_check = $db->prepare('SELECT ID from users where username = :username and password = :password');
  $user_check->execute(array('username' => $username, 'password' => $password));
  $rs = $user_check->fetch();
  return $rs[0];
}

/* set a cookie and session, if cookie already exists, then do not give a new jwt */
function instantiateUser($new_jwt,$username_var) {

	if(!isset($_COOKIE["KM-Homework-Cookie"])){
		setcookie("KM-Homework-Cookie", $new_jwt, time()+86400, '/');
	}
	else{
		setcookie("KM-Homework-Cookie", NULL, time()+86400, '/');
	}
	session_name( 'KM-Homework-Session' );
	session_start();
	$_SESSION['KM-Homework-Session'] = $username_var;
}

/* Check if username exists, else insert a new user */
if (!is_null(get_login($username_var,$password_var,$db))){
    $new_jwt = generate_jwt($username_var); // function is located in ../token.php

	/* How to transfer a JWT Object -- https://codular.com/curl-with-php */
	$curl = curl_init();
	curl_setopt_array($curl, [
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => 'https://www.zoerochelle.com/php/project/login/verify_jwt.php',
	    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
	    CURLOPT_POST => 1,
	    CURLOPT_POSTFIELDS => [
	        new_jwt => $new_jwt
	    ]
	]);

	$response = curl_exec($curl);

	/* If token Key is correct, then create a cookie and start a new session */
	if ($response == TRUE) {
		instantiateUser($new_jwt,$username_var);
		jsRedirect('https://www.zoerochelle.com/php/project/login/homepage.php');
	}
	if ($response == FALSE) {
		//echo "cURL False: " . curl_error($ch);
		jsRedirect('https://www.zoerochelle.com/php/project/login/loginpage.html?bad_JWT=1');
	}

	curl_close($curl);

}
else {
  header("location: https://www.zoerochelle.com/php/project/login/loginpage.html?badLogin=1");
}

$db = null;

?>
