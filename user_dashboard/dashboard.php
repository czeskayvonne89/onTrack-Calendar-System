<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../sign_in/sign_in.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$servername = "localhost";
$username = "root";
$db_password = "";
$dbname = "sign_up";

$conn = new mysqli($servername, $username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$events = [];
if ($result = $conn->query("SELECT * FROM events WHERE user_id = $user_id")) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
    $result->free();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../reboot.css" />
    <link rel="stylesheet" href="styles/styles.css" />
</head>
<body>
    <div>
        <div class="header-nav-bar">
            <a href="../index.php">
                <div class="logo"></div>
            </a>
            <ul>
                <li><a href="#">&nbsp;</a></li>
            </ul>
        </div>
        <form method="POST" action="">
            <div class="card-container">
                <div class="card">
                    <div class="card-content">
                        <h1>Dashboard</h1>
                        <br>
                        <label for="timeline">Timeline:</label>
                        <select name="timeline" id="timeline" onchange="this.form.submit()">
                            <option value="">Select</option>
                            <option value="today" <?php echo isset($_POST['timeline']) && $_POST['timeline'] == 'today' ? 'selected' : ''; ?>>Today</option>
                            <option value="weekly" <?php echo isset($_POST['timeline']) && $_POST['timeline'] == 'weekly' ? 'selected' : ''; ?>>7 days</option>
                            <option value="monthly" <?php echo isset($_POST['timeline']) && $_POST['timeline'] == 'monthly' ? 'selected' : ''; ?>>Monthly</option>
                        </select>
                        <div class="output-container">
                            <?php
                            foreach ($events as $event) {
                                echo "<div class='event'>";
                                echo "<h3>{$event['eventName']}</h3>";
                                echo "<p><strong>Start:</strong> {$event['startDate']} {$event['startTime']}</p>";
                                echo "<p><strong>End:</strong> {$event['endDate']} {$event['endTime']}</p>";
                                echo "<p><strong>Repeating:</strong> {$event['repeating']}</p>";
                                echo "<p>{$event['details']}</p>";

                                // Delete button for each event
                                echo "<form method='post' action='delete_event.php'>";
                                echo "<input type='hidden' name='event_id' value='{$event['eventID']}'>";
                                echo "<button type='submit'>Delete</button>";
                                echo "</form>";

                                echo "</div>";
                            }

                            if (isset($_POST['timeline'])) {
                                $timeline = htmlspecialchars($_POST['timeline']);
                                switch ($timeline) {
                                    case "today":
                                        // Filter and display today's events
                                        break;
                                    case "weekly":
                                        // Filter and display this week's events
                                        break;
                                    case "monthly":
                                        // Filter and display this month's events
                                        break;
                                }
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="calendar">
                <button type="button" onclick="showPopup()">Add New Event</button>
                <div id="month">
                    <span id="prev" onclick="prevMonth()">&#10094;</span>
                    <span id="month-name"></span>
                    <span id="next" onclick="nextMonth()">&#10095;</span>
                </div>
                <div id="days-of-week">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div id="days"></div>
            </div>
            <div id="popupBackground"></div>
            <div id="addEventPopup">
                <h2>Add Event</h2>
                <form id="addEventForm" method="post" action="event/session.php">
                    <label for="event_name">Event Name:</label>
                    <input type="text" id="event_name" name="event_name" required>
                    <br><br>
                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" required>
                    <br><br>
                    <label for="start_time">Start Time:</label>
                    <input type="time" id="start_time" name="start_time" required>
                    <br><br>
                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date" required>
                    <br><br>
                    <label for="end_time">End Time:</label>
                    <input type="time" id="end_time" name="end_time" required>
                    <br><br>
                    <label for="repeating">Repeating? (Y/N):</label>
                    <input type="text" id="repeating" name="repeating" maxlength="1" required>
                    <br><br>
                    <label for="details">Details:</label>
                    <textarea id="details" name="details" rows="4"></textarea>
                    <br><br>
                    <button type="submit">Add Event</button>
                    <br><br>
                </form>
                <button type="button" onclick="closePopup()">Close</button>
            </div>
        </form>
    </div>
    <script src="script/script.js"></script>
</body>
</html>
