<?php
echo "config page!<br>";

$connectionInfo = array("UID" => "jordan", "pwd" => "levy2019!", "Database" => "4ww3db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:4ww3dbserver.database.windows.net,1433";

try {
	$conn = sqlsrv_connect($serverName, $connectionInfo);
	echo "database connected I think!<br>";
	var_dump($conn);
} catch (Exception $e) {
	$code = $e->getCode();
	$msg = $e->getMessage();
	echo $code.": ".$error_message."<br />";

}

?>