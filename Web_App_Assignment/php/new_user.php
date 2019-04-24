<?php
require_once('conn.php');
require_once('../token.php');

function jsRedirect($url) {
	echo ('<script type="text/javascript">window.location="'.$url.'";</script>');
	exit(0);
}

/*check to see if user exists*/
function get_login($username,$db) {
  $user_check = $db->prepare('SELECT ID from users where username = :username');
  $user_check->execute(array('username' => $username));
  $rs = $user_check->fetch();
  return $rs[0];
}

/*insert new user*/
function new_user($username,$password,$db) {
	//$user_insert = $db->prepare("INSERT INTO users (username, password) VALUES (:username, MD5(:password))");
	$user_insert = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
	$user_insert->execute(array('username' => $username, 'password' => $password));
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
if (!is_null(get_login($_REQUEST['username'],$db))) {
		/* please try another username */
    header("location: https://www.zoerochelle.com/php/project/login/loginpage.html?user_exists=1");
}
else {
  new_user($_REQUEST['username'],$_REQUEST['password'],$db);
	/* Create and verify JWT token -- https://codular.com/curl-with-php */
	$new_jwt = generate_jwt($username_var); //located in ../token.php
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
	elseif ($response == FALSE) {
		echo "cURL False: " . curl_error($ch);
		jsRedirect('https://www.zoerochelle.com/php/project/login/loginpage.html?bad_JWT=1');
	}

	curl_close($curl);

  jsRedirect('https://www.zoerochelle.com/php/project/login/homepage.php');
}

$db = null;

?>
