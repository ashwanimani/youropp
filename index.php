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
        $stmt = $conn->prepare("INSERT INTO users (email, user_password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $user_password);
        
        if ($stmt->execute()) {
            echo "Registration successful.";
            
            // Redirect to login.html
            header('Location: login.html');
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and the database connection
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Opinion Sharing Platform - Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Additional styles for the login form */
        .login-form {
            background-color: #f8f8f8;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-form h2 {
            text-align: center;
            color: #007BFF;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 98.5%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
        }

        .register-link a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <h1 class="page-title">Your Opinion Sharing Platform</h1>
        <nav class="main-nav">
            <a href="home.html">Home</a>
            <a href="poll-creation.html">Create a Poll</a>
            <a href="login.html">Login</a>
            <a href="index.html">Register</a>
            <a href="contact.html">Contact</a> <!-- Added "Contact" link here -->
        </nav>
    </header>
    <main>
        <section class="login-form">
            <h2>Login</h2>
            <!-- Login form -->
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Login"> 
                </div>
            </form>
            <div class="register-link">
                <p>Don't have an account? <a href="register.html">Register here</a></p>
            </div>
        </section>
    </main>
    <footer>
        <p class="copyright">Copyright &copy; 2023 Your Opinion Sharing Platform</p>
    </footer>
</body>
</html>
