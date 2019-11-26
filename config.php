<?php
echo "config page!";

// //define the sql login credentials
// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');
// define('DB_NAME', '4WW3');
 
// //try to connect to sql database
// $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// //if we couldn't connect, stop
// if($link === false){
//     die("ERROR: Could not connect. " . mysqli_connect_error());
// }

// require_once "vendor/autoload.php";
// use WindowsAzure\Common\ServicesBuilder;
// use WindowsAzure\Common\ServiceException;

// $connectionString = "DefaultEndpointsProtocol=https;AccountName=[yourAccount];AccountKey=[yourKey]"
// $tableRestProxy = ServicesBuilder::getInstance()->createTableService($connectionString);

// try {
//   // Create table.
//   $tableRestProxy->listTables();
// } catch(ServiceException $e){
//   $code = $e->getCode();
//   $error_message = $e->getMessage();
//   echo $code.": ".$error_message."<br />";
// }

$connectionInfo = array("UID" => "jordan", "pwd" => "levy2019!", "Database" => "4ww3db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:4ww3dbserver.database.windows.net,1433";

try {
	$conn = sqlsrv_connect($serverName, $connectionInfo);
	$conn.disconnect();
} catch (Exception $e) {
	$code = $e->getCode();
	$msg = $e->getMessage();
	echo $code.": ".$error_message."<br />";

}

?>