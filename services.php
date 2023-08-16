<?php
if (isset($_POST['submit'])) {
    $serviceId = $_POST['serviceId'];
    $selectedService = $_POST['selected-service'];
    $bookingDate = $_POST['booking-date'];
    $bookingTime = $_POST['booking-time'];
    $paymentMethod = $_POST['payment-method'];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "servicego_db";
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $selectedService = $conn->real_escape_string($selectedService);
    $bookingDate = $conn->real_escape_string($bookingDate);
    $bookingTime = $conn->real_escape_string($bookingTime);
    $paymentMethod = $conn->real_escape_string($paymentMethod);

    $userId = $_SESSION['user_id'];
    $insertSql = "INSERT INTO bookings (booked_id, id, selected_service, booking_date, booking_time, payment_method)
        VALUES ('$userId', '$serviceId', '$selectedService', '$bookingDate', '$bookingTime', '$paymentMethod')";

    if ($conn->query($insertSql) === TRUE) {
        echo "<div class='book-success page-template'>";
        echo    "<i class='fa fa-check' aria-hidden='true'></i>";
        echo    "<p>Booking successful!</p>";
        echo    "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 3000);</script>";
        echo "</div>";
        
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
        $conn->close();
    }
?>
<div class="booking-reviews page-template" id="booking-reviews">
        <i class="fa fa-times" aria-hidden="true" onclick="closeReview()"></i>
        <h2 id="review-title">"Review Title"</h2>
        <?php 
        include 'reviews.php'
        ?>
</div>
<div class="booking-panel" id="booking-details">
    <i class="fa fa-times" aria-hidden="true" onclick="closeBookingDetails()"></i>
    <h2 id="service-name">Booking Details</h2>
    <p id="service-details"></p>
        <form id="booking-form" method="POST" action="">
            <div class="left">
                <input type="hidden" id="serviceId" name="serviceId">
                <input type="hidden" id="selected-service" name="selected-service">
                <label for="booking-date">Date:</label>
                <input type="date" id="booking-date" name="booking-date" required>
                <label for="booking-time">Time:</label>
                <input type="time" id="booking-time" name="booking-time" required>
            </div>
            <div class="right">
                <p id="staff">"staff_name"</p>
                <p id="rate_per_hour" class="service_rate"></p>
                <label for="payment-method">Payment Method:</label>
                <select id="payment-method" name="payment-method" required>
                    <option value="online">Online</option>
                    <option value="actual">Actual</option>
                </select>
                <button type="submit" name="submit">Book</button>
            </div>
        </form>
    
</div>


<?php
$data = array(
    array(
        'service_id' => '1',
        'title' => 'Barbers',
        'text' => 'Experience precision cuts and stylish grooming at our premier barber shop.',
        'image' => './images/image1.jpg',
        'rate_per_hour' => '25.99',
        'staff' => 'Lei Joshua Salvacion'
    ),
    array(
        'service_id' => '2',
        'title' => 'House Cleaning',
        'text' => 'Relax in a sparkling clean home with our professional house cleaning service.',
        'image' => './images/image2.jpg',
        'rate_per_hour' => '25.99',
        'staff' => 'May Ailyn Gadiano'
    ),
    array(
        'service_id' => '3',
        'title' => 'Massage Therapist',
        'text' => 'Indulge in pure relaxation with a rejuvenating massage by skilled therapists.',
        'image' => './images/image3.jpg',
        'rate_per_hour' => '25.99',
        'staff' => 'Mary An Gonzales '
    ),
    array(
        'service_id' => '4',
        'title' => 'Babysitter',
        'text' => 'Trustworthy and caring babysitters ensuring a safe and fun environment.',
        'image' => './images/image4.jpg',
        'rate_per_hour' => '25.99',
        'staff' => 'Jannah Mae Daquer'
    ),
    array(
        'service_id' => '5',
        'title' => 'Laundry',
        'text' => 'Convenient and efficient laundry service for fresh and crisp clothes.',
        'image' => './images/image5.jpg',
        'rate_per_hour' => '25.99',
        'staff' => 'Olive Jasmine Jimenez'
    ),
    array(
        'service_id' => '6',
        'title' => 'Manicure and Pedicure',
        'text' => 'Pamper yourself with luxurious manicures and pedicures for perfectly polished nails.',
        'image' => './images/image6.jpg',
        'rate_per_hour' => '25.99',
        'staff' => 'Shajanna Gaco'
    ),
    array(
        'service_id' => '7',
        'title' => 'Electrician',
        'text' => 'Expert electricians providing reliable solutions for all your electrical needs.',
        'image' => './images/image7.jpg',
        'rate_per_hour' => '25.99',
        'staff' => 'Raico Liam'
    ),
    array(
        'service_id' => '8',
        'title' => 'Plumber',
        'text' => 'Swift and reliable plumbing services for all your plumbing challenges.',
        'image' => './images/image8.jpg',
        'rate_per_hour' => '25.99',
        'staff' => 'Lei Joshua Salvacion'
    ),
    array(
        'service_id' => '9',
        'title' => 'Carpenter',
        'text' => 'Skillful carpenters crafting custom solutions for your woodworking and carpentry needs.',
        'image' => './images/image9.jpg',
        'rate_per_hour' => '25.99',
        'staff' => 'May Ailyn Gadiano'
    ),
    array(
        'service_id' => '10',
        'title' => 'Mechanic',
        'text' => 'Experienced mechanics offering top-notch automotive repair and maintenance services.',
        'image' => './images/image10.jpg',
        'rate_per_hour' => '25.99',
        'staff' => 'Mary An Gonzales'
    ),
    array(
        'service_id' => '11',
        'title' => 'Caregiver',
        'text' => 'Dedicated caregivers providing compassionate support and personalized care for your loved ones.',
        'image' => './images/image11.jpg',
        'rate_per_hour' => '25.99',
        'staff' => 'Jannah Mae Daquer'
    )
);



foreach ($data as $item) {
    
    echo '<div class="service-design" style="background-image: url(' . $item['image'] . ');">';
    echo '<h2>' . $item['title'] . '</h2>';
    echo '<p>' . $item['text'] . '</p>';
    echo '<button onclick="showBookingDetails(' . $item['service_id'] . ', \'' . $item['title'] . '\', \'' . $item['text'] . '\', \'' . $item['rate_per_hour'] . '\', \'' . $item['staff'] . '\')">Visit</button>';
    echo '<button onclick="showReview(\'' . $item['title'] . '\')">Review</button></div>';
}

?>
<script>
    function showReview(title) {
        document.getElementById('review-title').textContent = title;
        document.getElementById('booking-reviews').style.display = 'block';
    }

    function closeReview() {
        document.getElementById('booking-reviews').style.display = 'none';
    }
    function showBookingDetails(serviceId, serviceTitle, serviceDetails, rate_per_hour, staff) {
        document.getElementById('staff').textContent = 'Staff: ' +staff;
        document.getElementById('serviceId').value = serviceId;
        document.getElementById('selected-service').value = serviceTitle;
        document.getElementById('service-name').textContent = serviceTitle;
        document.getElementById('service-details').textContent = serviceDetails;
        document.getElementById('booking-details').style.display = 'block';
        document.getElementById('rate_per_hour').textContent = 'Rate: ' + rate_per_hour+'/Hour';
    }

    function closeBookingDetails() {
        document.getElementById('booking-details').style.display = 'none';
    }
</script>