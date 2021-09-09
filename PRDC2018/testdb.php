<?php
// Usage without mysql_list_dbs()
$link = mysql_connect('db', 'prdc2018', 'willy,lutaichung');
$res = mysql_query("SHOW DATABASES");

while ($row = mysql_fetch_assoc($res)) {
    echo $row['Database'] . "\n";
}
try{
	$conn = new PDO("mysql:host=db;dbname=prdc2018;charset=UTF8MB4;port=3306", "prdc2018", 'willy,lutaichung');
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo "DB Connection failed: " . $e->getMessage();
}

?>