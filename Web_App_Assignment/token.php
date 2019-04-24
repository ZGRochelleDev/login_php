<?php
require __DIR__ . '/vendor/autoload.php';
use \Firebase\JWT\JWT;
// on success generate jwt, source: https://jwt.io/introduction/
function generate_jwt($user) {
	$issuedAt = time();
	$expirationTime = $issuedAt + 100;
	$payload = array(
		'userid' => $user,
		'iat' => $issuedAt,
		'exp' => $expirationTime
	);
	/* Simple key for demonstrating the concept. Normally the Key would be much longer and stored as a file on the server */
	$key = 12345;
	$alg = array('HS256');
	$jwt = JWT::encode($payload, $key);

	return $jwt;
}
?>
