<?php
	
echo "<h2> PDO demo!</h2>";
$username = 'bl54';
$password = '4qIHGWPk';
$hostname = 'sql2.njit.edu';
 
$dsn = "mysql:host=$hostname;dbname=$username";

try {
	$conn = new PDO($dsn, $username, $password);
	echo "Connected successfully<br>";
} catch(PDOException $e) {;
	echo "Connection Failed: " . $e->getMessage();
}
//connecting to the MySQL host

$conn = null;

$query = 'SELECT * FROM bl54.accounts WHERE id < 6';
//pulling info from the db=database
$statement = $db->prepare($query);

$statement->bindValue('id' , $id );

$statement->execute();

$products = $statement->fetchAll();

$statement->closeCursor();

//ECHO THE RESULTS??

foreach ($products as $product)  { ;
//the table with the actual info
echo '<tr>';
	echo '<td>' .$product [ 'id' ]. '</td>';
	echo '<td>' .$product [ 'email'].  '</td>';
'</tr>';  

}
?>

/bin/bash: spell: command not found

/bin/bash: spell: command not found
