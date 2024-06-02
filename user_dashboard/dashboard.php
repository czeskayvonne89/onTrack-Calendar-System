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
else 
    $timeline = $_SESSION['timeline'];

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
                                            <a href="" onClick='showPopupEdit(event, <?php echo json_encode($event) ?>)'
                                                style="display: inline">Update</a>

                                            <form method='post' action='php/delete_event.php' style="display: inline"
                                                id="form-<?php echo $event['event_id'] ?>">
                                                <input type='hidden' name='event_id'
                                                    value='<?php echo $event['event_id'] ?>'>
                                                <input type='hidden' name="timeline"
                                                    value='<?php echo $timeline ?>'>
                                                <a href=""
                                                    onclick="event.preventDefault(); document.getElementById('form-<?php echo $event['event_id'] ?>').submit()">Delete</a>
                                            </form>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="calendar">
            <div style="text-align: right;"><button type="button" onclick="showPopup()"
                    style="width: 156px;font-size: 20px;">Add New Event</button></div>
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

                <div class="field">
                    <div class="btn cancel"><button type="button" onclick="closePopup()">Cancel</button></div>
                    <div class="btn submit" style="text-align: right;"><input type="submit" id="event_btn"
                            value="Add Event" name="add_event" /></div>
                </div>
        </div>
        </form>
    </div>
    <script src="script/script.js"></script>
</body>

</html>