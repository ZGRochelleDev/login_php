<?php
require __DIR__ . '/vendor/autoload.php';
use \Firebase\JWT\JWT;

function verifyJWT($jwt) {
	try {
	$key = 12345;
	//$key = 1234; //$wrong_key
	$decoded = JWT::decode($jwt, $key, array('HS256'));
	} catch (\Exception $e) {
    echo FALSE;
	}
	$array = json_decode(json_encode($decoded), true);

   /* If Key is correct, decode will create 3 arrays,
   if the array count != 3, then don't let them through */
	if (count($array) != 3) {
		echo FALSE;
	}
	else {
		echo TRUE;
		//return array(TRUE, $jwt);
	}
}
$jwt = $_POST[new_jwt];
verifyJWT($jwt);
?>
