<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../sign_in/php/authenticate.php");
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

$timeline = "today";
$query = "SELECT * FROM events WHERE user_id = $user_id AND TIMESTAMP(CURDATE()) <= TIMESTAMP(start_date, start_time) AND TIMESTAMP(CURDATE(), '23:59:59') >= TIMESTAMP(start_date, start_time)";
if (isset($_POST['timeline']))
    $timeline = htmlspecialchars($_POST['timeline']);
else if ($_SESSION['timeline']) {
    $timeline = $_SESSION['timeline'];
    $_SESSION['timeline'] = null;

}

if ($timeline) {
    switch ($timeline) {
        case "weekly":
            $query = "SELECT * FROM events WHERE user_id = $user_id AND TIMESTAMP(CURDATE()) <= TIMESTAMP(start_date, start_time) AND TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 6 DAY), '23:59:59') >= TIMESTAMP(start_date, start_time)";
            break;
        case "monthly":
            $query = "SELECT * FROM events WHERE user_id = $user_id AND TIMESTAMP(CURDATE()) <= TIMESTAMP(start_date, start_time) AND TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL 29 DAY), '23:59:59') >= TIMESTAMP(start_date, start_time)";
            break;
        default:

    }
}

$events = [];
if ($result = $conn->query($query)) {
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
    <link rel="stylesheet" href="styles/styles.css" type="text/css" />
</head>

<body>
    <div>
        <div class="header-nav-bar">
            <a href="../index.php">
                <div class="logo"></div>
            </a>
            <div class="nav-buttons">
                <a href="../sign_in/sign_in.php" class="logout-button">Logout</a>
                <a href="pomodoro/pomodoro.html">Pomodoro</a>
                <a href="contact_us/contact_us.php">Contact Us</a>
            </div>
        </div>

        <div class="card-container">
            <div class="card">
                <div class="card-content">
                    <h1>Dashboard</h1>
                    <br>
                    <label for="timeline">Timeline:</label>
                    <form method="POST" action="">
                        <select name="timeline" id="timeline" onchange="this.form.submit()">
                            <option value="">Select</option>
                            <option value="today" <?php echo $timeline && $timeline == 'today' ? 'selected' : ''; ?>>Today</option>
                            <option value="weekly" <?php echo $timeline && $timeline == 'weekly' ? 'selected' : ''; ?>>7 Days</option>
                            <option value="monthly" <?php echo $timeline && $timeline == 'monthly' ? 'selected' : ''; ?>>30 Days</option>
                        </select>
                    </form>
                    <div class="output-container">
                        <div class="divTable">
                            <div class="divTableHeading">
                                <div class="divTableRow">
                                    <div class="divTableHead">Event Name</div>
                                    <div class="divTableHead">Start Date</div>
                                    <div class="divTableHead">Start Time</div>
                                    <div class="divTableHead">End Date</div>
                                    <div class="divTableHead">End Time</div>
                                    <div class="divTableHead">Details</div>
                                    <div class="divTableHead">Action</div>
                                </div>
                            </div>
                            <div class="divTableBody">
                                <?php if (!!$events && !empty(array_filter($events))) { ?>
                                    <?php foreach ($events as $event) { ?>
                                        <div class="divTableRow">
                                            <div class="divTableCell">
                                                <?php echo $event['event_name'] ?>
                                            </div>
                                            <div class="divTableCell">
                                                <?php echo $event['start_date'] ?>
                                            </div>
                                            <div class="divTableCell">
                                                <?php echo $event['start_time'] ?>
                                            </div>
                                            <div class="divTableCell">
                                                <?php echo $event['end_date'] ?>
                                            </div>
                                            <div class="divTableCell">
                                                <?php echo $event['end_time'] ?>
                                            </div>
                                            <div class="divTableCell">
                                                <?php echo $event['details'] ?>
                                            </div>
                                            <div class="divTableCell" style="text-align: right">
                                                <a href="" id="update" onClick='showPopupEdit(event, <?php echo json_encode($event) ?>)' style="display: inline">Update</a>
                                                <a href="" id="delete" onclick="showPopupDelete(event, <?php echo $event['event_id'] ?>)">Delete</a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="divTableRow">No events for this time. </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="calendar">
            <div style="text-align: right;margin-bottom: 16px"><button type="button" onclick="showPopup()" style="width: 156px;font-size: 20px;">Add New Event</button></div>
            <div id="month">
                <span id="prev" onclick="prevMonth()">&#10094;</span>
                <span id="month-name"></span>
                <span id="next" onclick="nextMonth()">&#10095;</span>
            </div>
            <div id="days-of-week">
                <div class="weekend">Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div class="weekend">Sat</div>
            </div>
            <div id="days"></div>
        </div>

        <div id="popupBackground"></div>
        <div id="addEventPopup">
            <h2 id="addEventPopupTitle">Add Event</h2>
            <form id="eventForm" method="post" action="php/insert_event.php">
                <div class="field">
                    <div class="label"><label for="event_name">Event Name:</label></div>
                    <div class="input"><input type="text" id="event_name" name="event_name" required></div>
                </div>
                <div class="field">
                    <div class="label"><label for="start_date">Start Date:</label></div>
                    <div class="input"><input type="date" id="start_date" name="start_date" required></div>
                </div>
                <div class="field">
                    <div class="label"> <label for="start_time">Start Time:</label></div>
                    <div class="input"><input type="time" id="start_time" name="start_time" required></div>
                </div>
                <div class="field">
                    <div class="label"> <label for="end_date">End Date:</label></div>
                    <div class="input"><input type="date" id="end_date" name="end_date" required></div>
                </div>
                <div class="field">
                    <div class="label"> <label for="end_time">End Time:</label></div>
                    <div class="input"><input type="time" id="end_time" name="end_time" required></div>
                </div>
                <div class="field">
                    <div class="label"> <label for="details">Details:</label></div>
                    <div class="input"><textarea id="details" name="details" rows="5"></textarea></div>
                </div>

                <input type="hidden" id="event_id" name="event_id" />
                <input type='hidden' name="timeline" value='<?php echo $timeline ?>'>

                <div class="field">
                    <div class="btn cancel"><button type="button" onclick="closePopup()">Cancel</button></div>
                    <div class="btn submit" style="text-align: right;"><input type="submit" id="event_btn" value="Add Event" name="add_event" /></div>
                </div>
            </form>
        </div>
        <div id="deleteEventPopup">
            <h2 id="deleteEventPopupTitle">Are you sure you want to delete this event?</h2>
            <form method='post' action='php/delete_event.php' style="display: inline" id="form-delete" name="delete_event">
                <input type='hidden' id='delete_event_id' name="event_id" value=''>
                <input type='hidden' name="timeline" value='<?php echo $timeline ?>'>
                <div class="field">
                    <div class="btn cancel"><button type="button" onclick="closeDeletePopup()">Cancel</button></div>
                    <div class="btn submit" style="text-align: right;">
                        <input type="submit" id="delete_event_btn" value="DELETE" name="delete_event" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="script/script.js"></script>
</body>

</html>
