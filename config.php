<?php
$servername = "localhost";      // Server name, typically "localhost" for local setups
$username = "root";             // Your MySQL username (default for XAMPP/WAMP is "root")
$password = "";                 // Your MySQL password (default is blank for "root" on local setups)
$dbname = "mlsa_members";       // Your database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
