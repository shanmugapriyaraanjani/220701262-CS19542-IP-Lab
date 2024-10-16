<?php
if (isset($_POST['m1']) && isset($_POST['m2']) && isset($_POST['m3']) && isset($_POST['m4']) && isset($_POST['m5']) && isset($_POST['m6'])) {
    $emp_id = $_POST['m1'];
    $emp_name = $_POST['m2'];
    $designation = $_POST['m3'];
    $dept = $_POST['m4'];
    $doj = $_POST['m5'];
    $salary = $_POST['m6'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "employeedb");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    // Prepare and bind for customer insertion
    $stmt1 = $conn->prepare("INSERT INTO employee (emp_id, name , designation , dept , doj, salary) VALUES (?, ? , ? ,? ,? ,?)");
    $stmt1->bind_param("issssi", $emp_id, $emp_name, $designation, $dept, $doj, $salary);

    
    // Execute the statements
    if ($stmt1->execute() == TRUE) {
        echo "<h2>New record inserted successfully</h2>";
    } else {
        echo "Error: " . $stmt1->error ;
    }

    // Close the statements
    $stmt1->close();
    // Display query: Fetch all customer and account details
    $sql = "SELECT * FROM employee";
            
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<h2>Customer and Account Information</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th>Date Of Join</th>
                    <th>Salary</th>
                </tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['emp_id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['designation'] . "</td>
                    <td>" . $row['dept'] . "</td>
                    <td>" . $row['doj'] . "</td>
                    <td>" . $row['salary'] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    // Close the connection
    $conn->close();
} else {
    echo "Error: Required fields are missing.";
}
?>
