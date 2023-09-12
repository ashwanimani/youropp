<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page or handle it as needed
    // For example, you can add a header redirect:
    header('Location: login.html');
    exit;
}

// Connect to the database (replace these with your database credentials)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'youropp';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the $email variable
$email = "";

// Retrieve the user's ID from the session
$user_id = $_SESSION['user_id'];

// Retrieve user data from the database using a prepared statement
$sql = "SELECT email FROM users WHERE user_id = ?"; // Assuming your user ID column is 'user_id'
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error in preparing the SQL query: " . $conn->error);
}

// Bind the user_id as a parameter
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
    } else {
        echo "User not found.";
    }
} else {
    echo "Error executing the query: " . $stmt->error;
}

// Close the statement and the database connection
$stmt->close();

// Include the HTML content from profile.html.php and pass the $email variable
include('profile.html.php');
?>
