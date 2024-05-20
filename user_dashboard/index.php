<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../reboot.css" />
    <link rel="stylesheet" href="styles/styles.css" />


</head>

<div>
    <div class="header-nav-bar">
        <a href="../index.php">
            <div class="logo">
            </div>
        </a>

        <ul>
            <li><a href="#">&nbsp;</a></li>
        </ul>
    </div>
    <form method="POST" action="">
        <div class="card-container">
            <div class="card">
                <div class="card-content">
                    <h1>Dashboard</h1> <br>
                    <label for="timeline">Timeline:</label>
                    <select name="timeline" id="timeline" onchange="this.form.submit()">
                        <option value="">Select</option>
                        <option value="today" <?php echo isset($_POST['timeline']) && $_POST['timeline'] == 'today' ? 'selected' : ''; ?>>Today</option>
                        <option value="weekly" <?php echo isset($_POST['timeline']) && $_POST['timeline'] == 'weekly' ? 'selected' : ''; ?>>7 days</option>
                        <option value="monthly" <?php echo isset($_POST['timeline']) && $_POST['timeline'] == 'monthly' ? 'selected' : ''; ?>>Monthly</option>
                    </select>

                    <div class="output-container">
                        <?php

                        if (isset($_POST['timeline'])) {
                            $timeline = htmlspecialchars($_POST['timeline']);

                            switch ($timeline) {
                                case "today":
                                    echo "<p>No scheduled activities to show</p>";
                                    break;
                                case "weekly":
                                    echo "<p>No scheduled activities to show</p>";
                                    break;
                                case "monthly":
                                    echo "<p>No scheduled activities to show</p>";
                                    break;

                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="calendar">
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
    <script src="script/script.js"></script>
</div>
</form>
</body>

</html>