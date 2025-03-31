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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // SQL Insert Query
    $stmt = $conn->prepare("INSERT INTO appointmentsdata (FirstName, LastName, Email, Phone, Address, Parish, Service, Appliance, Date, Description) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("ssssssssss", $FirstName, $LastName, $Email, $Phone, $Address, $Parish, $Service, $Appliance, $Date, $Description);

    // Execute & Check
    if ($stmt->execute()) {
        echo " Appointment successfully booked!";
    } else {
        echo " Error: " . $stmt->error;
    }

    // Close Statement and Connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-4 mb-4">
        <div class="card p-4">
            <h2 class="mb-3">Book an Appointment</h2>
            <form action="create.php" method="POST">
                <div class="row">
                    <div class="col mb-2">
                        <label for="FirstName" class="form-label">First Name</label>
                        <input type="text" id="FirstName" name="FirstName" class="form-control" required>
                    </div>
                    <div class="col mb-2">
                        <label for="LastName" class="form-label">Last Name</label>
                        <input type="text" id="LastName" name="LastName" class="form-control" required>
                    </div>
                </div>

                <div class="mb-2">
                    <label for="Phone" class="form-label">Phone Number# (999-9999)</label>
                    <input type="tel" id="Phone" name="Phone" class="form-control" pattern="[0-9]{3}-[0-9]{4}" placeholder="999-9999" required>
                </div>

                <div class="mb-2">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" id="Email" name="Email" class="form-control">
                </div>

                <div class="row">
                    <div class="col mb-2">
                        <label for="Address" class="form-label">Address</label>
                        <input type="text" id="Address" name="Address" class="form-control" required>
                    </div>
                    <div class="col mb-2">
                        <label for="Parish" class="form-label">Select Parish</label>
                        <select id="Parish" name="Parish" class="form-select" required>
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
                        </select>
                    </div>
                </div>

                <div class="mb-2">
                    <label for="Service" class="form-label">Service Type</label>
                    <select id="Service" name="Service" class="form-select" required>
                        <option value="installation">Installation</option>
                        <option value="repair">Repair</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label class="form-label">Appliance Type</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="appliance[]" value="Refrigerator">
                                <label class="form-check-label">Refrigerator</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="appliance[]" value="Stove">
                                <label class="form-check-label">Stove</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="appliance[]" value="Washing Machine">
                                <label class="form-check-label">Washing Machine</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="appliance[]" value="Auto AC">
                                <label class="form-check-label">Auto AC</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="appliance[]" value="Commercial AC">
                                <label class="form-check-label">Commercial AC</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="appliance[]" value="Household AC">
                                <label class="form-check-label">Household AC</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label for="Date" class="form-label">Preferred Date & Time</label>
                    <input type="datetime-local" id="Date" name="Date" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label for="Description" class="form-label">Issue Description</label>
                    <textarea id="Description" name="Description" class="form-control" rows="2"></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit Appointment</button>
            </form>
        </div>
    </div>
</body>
</html>