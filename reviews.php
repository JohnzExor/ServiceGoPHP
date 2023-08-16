<?php
if (isset($_POST['submit-review'])) {
    $userId = $_SESSION['user_id'];
    $serviceId = $_POST['serviceId'];
    $content = $_POST['review-content'];
    $rating = $_POST['rating'];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "servicego_db";
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $content = $conn->real_escape_string($content);

    $insertSql = "INSERT INTO reviews (user_id, service_id, content, rating)
        VALUES ('$userId', '$serviceId', '$content', '$rating')";

    if ($conn->query($insertSql) === TRUE) {
        echo "<div class='review-success'>";
        echo    "<i class='fa fa-check' aria-hidden='true'></i>";
        echo    "<p>Review submitted successfully!</p>";
        echo "</div>";
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!-- Add this code to the HTML section -->
<div class="review-panel" id="review-details">
    <h2 id="service-name-review">Leave a Review</h2>
    <p id="service-details-review"></p>
    <form id="review-form" method="POST" action="">
        <div class="left">
            <input type="hidden" id="serviceId" name="serviceId">
            <label for="review-content">Review:</label>
            <textarea id="review-content" name="review-content" required></textarea>
        </div>
        <div class="right">
            <label for="rating">Rating:</label>
            <select id="rating" name="rating" required>
                <option value="5">5 Stars</option>
                <option value="4">4 Stars</option>
                <option value="3">3 Stars</option>
                <option value="2">2 Stars</option>
                <option value="1">1 Star</option>
            </select>
            <button type="submit" name="submit-review">Submit Review</button>
        </div>
    </form>
</div>
