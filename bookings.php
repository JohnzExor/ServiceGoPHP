<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "servicego_db";
$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM bookings WHERE booked_id = $user_id";
$result = $conn->query($sql);

if ($result === false) {
    echo "Error executing the query: " . $conn->error;
} elseif ($result->num_rows > 0) {
    echo "<table>
        <tr>
            <th>Booking ID</th>
            <th>Selected Service</th>
            <th>Booking Date</th>
            <th>Booking Time</th>
            <th>Payment Method</th>
        </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>".$row['id']."</td>
            <td>".$row['selected_service']."</td>
            <td>".$row['booking_date']."</td>
            <td>".$row['booking_time']."</td>
            <td>".$row['payment_method']."</td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "No bookings found for the user.";
}

$conn->close();
?>
