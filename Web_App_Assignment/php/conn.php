<?php

try {
	$db = new PDO('mysql:host=localhost;dbname=central','drupaluser', 'zgrochelle');
    #$db = new PDO('mysql:host=$servername;dbname=$myDB',$username, $password);
} catch (PDOException $e) {
    echo $e->getMessage()."<br>";
    die();
}

?>
