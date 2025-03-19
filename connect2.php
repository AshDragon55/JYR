<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "j&yrefrigeration_db"; // Database Name
$conn = new mysqli($servername, $username, $password, $database);

// Check Connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Retrieve Form Data
$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$Email = $_POST['Email'];
$Phone = $_POST['Phone'];
$Address = $_POST['Address'];
$Parish = $_POST['Parish'];
$Service = $_POST['Service'];
$Appliance = isset($_POST['appliance']) ? implode(", ", $_POST['appliance']) : "None";
$Date = $_POST['Date'];
$Description = $_POST['Description'];

// Insert Data into Database
$stmt = $conn->prepare("INSERT INTO appointmentsdata (FirstName, LastName, Email, Phone, Address, Parish, Service, Appliance,  Date, Description) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssssssss", $FirstName, $LastName, $Email, $Phone, $Address, $Parish, $Service, $Appliance,  $Date, $Description);

if ($stmt->execute()) {
    echo "Appointment successfully booked!";
} else {
    echo "Error: " . $stmt->error;
}

// Close Connection
$stmt->close();
$conn->close();
