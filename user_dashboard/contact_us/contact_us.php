<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }

        .contact-form-container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 80px; 
        }

        .contact-form-container h1 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            background-color: #28a745;
            color: white;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
        }

        .form-group button:hover {
            background-color: #218838;
        }

        .header-nav-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: rgb(254, 249, 239);
            padding: 10px;
            position: fixed;
            top: 0;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .logo {
            height: 50px;
            width: 200px;
            background-image: url("../photos/logo.png");
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center right;
            margin-right: auto; /* Pushes the nav buttons to the right */
        }

        .nav-buttons {
            display: flex;
            align-items: center;
        }

        .nav-buttons a {
            color: #545454;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .nav-buttons a:hover {
            background-color: #c1dabe;
        }

        .logout-button {
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div>
        <div class="header-nav-bar">
            <a href="../../index.php">
                <div class="logo"></div>
            </a>
            <div class="nav-buttons">
                <a href="../../sign_in/sign_in.php" class="logout-button">Logout</a>
                <a href="../dashboard.php">Dashboard</a>
                <a href="../pomodoro/pomodoro.php">Pomodoro</a>
            </div>
        </div>

        <div class="contact-form-container">
            <h1>Contact Us</h1>
            <form action="contact_us.php" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="improvements">Suggestions for Improvements:</label>
                    <textarea id="improvements" name="improvements" rows="7"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
