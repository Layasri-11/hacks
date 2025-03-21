<?php
// Database connection settings
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";  // Replace with your database password
$dbname = "client_db";  // Replace with your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data and sanitize it to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);

    // SQL query to insert data into the clients table
    $sql = "INSERT INTO clients (name, age, email, height, weight) 
            VALUES ('$name', '$age', '$email', '$height', '$weight')";

    // Execute the query and check if the data was inserted successfully
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully!";
        // Redirect to another page after the data is inserted (optional)
        header("Location: next_page.html");  // Replace with your actual next page URL
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
