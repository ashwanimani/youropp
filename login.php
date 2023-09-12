<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $user_password = $_POST['user_password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'youropp');

    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed: " . $conn->connect_error);
    } else {
        // Prepare and execute the SQL query
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND user_password = ?");
        $stmt->bind_param("ss", $email, $user_password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // User is authenticated, redirect to a welcome page or perform desired actions
            header("Location: profile.html");
            exit();
        } else {
            // Authentication failed, display an error message
            echo "Authentication failed. Please check your email and password.";
        }

        // Close the statement and the database connection
        $stmt->close();
        $conn->close();
    }
}
?>
