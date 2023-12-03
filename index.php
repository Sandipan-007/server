<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "visitor_tracking";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get visitor's IP address
$ip_address = $_SERVER['REMOTE_ADDR'];

// Insert visitor information into the database
$sql = "INSERT INTO visitors (ip_address) VALUES ('$ip_address')";
$conn->query($sql);

// Display visitor information
echo "<h1>Welcome to the Website</h1>";
echo "<p>Your IP Address: $ip_address</p>";

// Display a list of recent visitors
echo "<h2>Recent Visitors</h2>";
$sql = "SELECT * FROM visitors ORDER BY timestamp DESC LIMIT 10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row['ip_address'] . " at " . $row['timestamp'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No recent visitors.";
}

$conn->close();
?>
