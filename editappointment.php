<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>

<body style="margin: 50px;">
    <h1>Appointments List</h1>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Parish</th>
                <th>Service</th>
                <th>Appliance</th>
                <th>Date</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
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

            // Read table data
            $sql = "SELECT * FROM appointmentsdata";
            $result = $conn->query($sql);

            if (!$result) {
                die("Invalid query: " . $conn->error);
            }

            // Read each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["FirstName"] . "</td>
                    <td>" . $row["LastName"] . "</td>
                    <td>" . $row["Phone"] . "</td>
                    <td>" . $row["Email"] . "</td>
                    <td>" . $row["Address"] . "</td>
                    <td>" . $row["Parish"] . "</td>
                    <td>" . $row["Service"] . "</td>
                    <td>" . $row["Appliance"] . "</td>
                    <td>" . $row["Date"] . "</td>
                    <td>" . $row["Description"] . "</td>
                    <td>
                        <a class='btn btn-primary' href='update.php?id=" . $row["id"] . "'>Update</a>
                        <a class='btn btn-danger' href='delete.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>
