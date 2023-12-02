<?php
session_start();
$servername = "localhost";
$server_user = "root";
$server_pass = "";
$dbname = "manufacturefood";

// Check if the session variables are set
$name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

// Use try-catch to catch any exceptions
try {
    $conn = new mysqli($servername, $server_user, $server_pass, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Fatal error: " . $e->getMessage());
}

// Assuming your registration form sends data via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    // ... add other fields as needed

    // Check if the username already exists
    $checkQuery = "SELECT * FROM users WHERE username=?";
    
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Error: Username already exists.";
    } else {
        // Example query to insert data into a users table using prepared statement
        $insertQuery = "INSERT INTO users (username, password) VALUES (?, ?)";
        
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ss", $username, $password);
        
        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
