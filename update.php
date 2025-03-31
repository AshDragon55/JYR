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

    // Fetch record
    $sql = "SELECT * FROM appointmentsdata WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        die("Record not found!");
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $firstName = $_POST["FirstName"];
    $lastName = $_POST["LastName"];
    $phone = $_POST["Phone"];
    $email = $_POST["Email"];
    $address = $_POST["Address"];
    $parish = $_POST["Parish"];
    $service = $_POST["Service"];
    $appliance = $_POST["Appliance"];
    $date = $_POST["Date"];
    $description = $_POST["Description"];

    // Update query
    $sql = "UPDATE appointmentsdata SET 
                FirstName='$firstName', 
                LastName='$lastName', 
                Phone='$phone', 
                Email='$email', 
                Address='$address', 
                Parish='$parish', 
                Service='$service', 
                Appliance='$appliance', 
                Date='$date', 
                Description='$description' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully!";
        header("Location: editappointment.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="margin: 50px;">
    <h2>Update Appointment</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $row["id"] ?>">

        <label>First Name:</label>
        <input type="text" name="FirstName" value="<?= $row["FirstName"] ?>" required class="form-control">

        <label>Last Name:</label>
        <input type="text" name="LastName" value="<?= $row["LastName"] ?>" required class="form-control">

        <label>Phone:</label>
        <input type="text" name="Phone" value="<?= $row["Phone"] ?>" required class="form-control">

        <label>Email:</label>
        <input type="email" name="Email" value="<?= $row["Email"] ?>" required class="form-control">

        <label>Address:</label>
        <input type="text" name="Address" value="<?= $row["Address"] ?>" required class="form-control">

        <label>Parish:</label>
        <input type="text" name="Parish" value="<?= $row["Parish"] ?>" required class="form-control">

        <!-- <label for="Parish" class="form-label"  >Select Parish</label>
                        <select id="Parish" name="Parish" class="form-select " required>
                             <option value="">Select Parish</option>
                            <option value="St. Lucy">St. Lucy</option>
                            <option value="St. Peter">St. Peter</option>
                            <option value="St. Andrew">St. Andrew</option>
                            <option value="St. James">St. James</option>
                            <option value="St. Joseph">St. Joseph</option>
                            <option value="St. George">St. George</option>
                            <option value="St. Thomas">St. Thomas</option>
                            <option value="St. John">St. John</option>
                            <option value="St. Michael">St. Michael</option>
                            <option value="St. Philip">St. Philip</option>
                            <option value="Christ Church">Christ Church</option>
                        </select> -->


        <div class="mb-2">
            <label for="Service" class="form-label">Service Type</label>
            <select id="Service" name="Service" class="form-select" required>
                <option value="installation">Installation</option>
                <option value="repair">Repair</option>
                <option value="maintenance">Maintenance</option>
            </select>
        </div>

        <label>Appliance:</label>
        <input type="text" name="Appliance" value="<?= $row["Appliance"] ?>" required class="form-control">

       

        <label>Date:</label>
        <input type="datetime-local" name="Date" value="<?= $row["Date"] ?>" required class="form-control">

        <label>Description:</label>
        <textarea name="Description" required class="form-control"><?= $row["Description"] ?></textarea>

        <br>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="editappointment.php" class="btn btn-secondary">Cancel</a>
    </form>
</body>

</html>