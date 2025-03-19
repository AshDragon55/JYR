<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "j&yrefrigeration_db";

// Create Connection
$conn = new mysqli($servername, $username, $password, $database);

// Check Connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Check if ID is provided
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Delete query
    $sql = "DELETE FROM appointmentsdata WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Redirect back to main page
    header("Location: editappointment.php");
    exit();
} else {
    echo "Invalid request!";
}
?>
