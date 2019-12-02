<?php
//credentials to connect to the database
$connectionInfo = array("UID" => "jordan", "pwd" => getenv("pwd"), "Database" => "4ww3db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = getenv("serverName");
$conn=false;

if ($conn == false) {
	try {
		//try to connect to the database
		$conn = sqlsrv_connect($serverName, $connectionInfo);
	} catch (Exception $e) {
		$code = $e->getCode();
		$msg = $e->getMessage();
		echo $code.": ".$error_message."<br />";
	}
}

?>