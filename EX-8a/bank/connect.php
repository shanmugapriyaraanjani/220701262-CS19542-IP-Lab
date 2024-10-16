<?php
if (isset($_POST['m1']) && isset($_POST['m2']) && isset($_POST['m3']) && isset($_POST['m4']) && isset($_POST['m5'])) {
    $cus_id = $_POST['m1'];
    $cus_name = $_POST['m2'];
    $acc_no = $_POST['m3'];
    $acc_type = $_POST['m4'];
    $balance = (float)$_POST['m5'];  // Assuming balance is numeric

    echo $cus_id . "<br>";
    echo $cus_name . "<br>";

    // Database connection
    $conn = new mysqli("localhost", "root", "", "bankdatabase");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind for customer insertion
    $stmt1 = $conn->prepare("INSERT INTO customer (C_id, C_name) VALUES (?, ?)");
    if (!$stmt1) {
        die("Prepare failed for customer insertion: " . $conn->error);
    }
    $stmt1->bind_param("ss", $cus_id, $cus_name);

    // Prepare and bind for account insertion
    $stmt2 = $conn->prepare("INSERT INTO account (acc_no, acc_type, balance, c_id) VALUES (?, ?, ?, ?)");
    if (!$stmt2) {
        die("Prepare failed for account insertion: " . $conn->error);
    }
    $stmt2->bind_param("ssds", $acc_no, $acc_type, $balance, $cus_id);

    // Execute the statements
    if ($stmt1->execute() && $stmt2->execute()) {
        echo "<h2>New record inserted successfully</h2>";
    } else {
        echo "Error inserting customer: " . $stmt1->error . "<br>";
        echo "Error inserting account: " . $stmt2->error;
    }

    // Close the statements
    $stmt1->close();
    $stmt2->close();

    // Display query: Fetch all customer and account details
    $sql = "SELECT c.C_id, c.C_name, a.acc_no, a.acc_type, a.balance 
            FROM customer c 
            JOIN account a ON c.C_id = a.c_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<h2>Customer and Account Information</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Account Number</th>
                    <th>Account Type</th>
                    <th>Balance</th>
                </tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['C_id'] . "</td>
                    <td>" . $row['C_name'] . "</td>
                    <td>" . $row['acc_no'] . "</td>
                    <td>" . $row['acc_type'] . "</td>
                    <td>" . $row['balance'] . "</td>
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
