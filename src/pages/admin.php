<?php
session_start();
include("db_connect.php");

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    echo "You must be logged in to join the LAN party.";
    exit;
};
    // Check if user is admin
    $query = "SELECT admin FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
?>
<html>
<head>
	<title>game</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>	
<body>
    <nav id="navBar">
        <a id="navKnapp" href="/game.php">Game</a>
        <a id="navKnapp" href="/board.php">Leaderboard</a>
        <a id="navKnapp" href="/FAQ.php">FAQ</a>
        <!-- Hvis admin så vil denne knappen til admin siden dukke opp -->
        <?php if ($user['admin'] == 1): ?>
            <a id="navKnapp" href="/admin.php">Admin</a>
        <?php endif; ?>
        <a id="navKnapp" href="/index.php">Log out</a>
    </nav>
    <div>
        <h1>User list for Adminstrators</h1>
        <p>Here you can see all users and their information</p>
        <div id="admin_container">
            <div id="user_container">
                <div id="user_info">
                    <?php
                    // Fetch users from database
                    $result = "SELECT * FROM users";
                    $result = $conn->query($result);
                    if ($result->num_rows > 0) {
                        // Loop through users and display their info
                        while($user = $result->fetch_assoc()) {
                            echo "<p>ID: " . $user['user_id'] . "</p>";
                            echo "<p>Username: " . $user['username'] . "</p>";

                            // Display whether user is an admin
                            if ($user['admin'] == 1) {
                                echo "<p>Is Admin</p>";
                            } else {
                                echo "<p>Not Admin</p>";
                            }
                            
                            // Add admin button
                            echo "<button onclick='addAdmin(" . $user['user_id'] . ")'>Add Admin</button>";
        
                            // Delete user button
                            echo "<button onclick='deleteUser(" . $user['user_id'] . ")'>Delete</button>";   
                            echo "<hr>"; // Add a horizontal line for visual separation
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </div>
                <!-- <div id="admin_list">
                    <?php
                    // Fetch admin users from database
                    // $result = "SELECT * FROM users WHERE admin = 1";
                    // $result = $conn->query($result);
                    // if ($result->num_rows > 0) {
                    //     // Loop through users and display their info
                    //     while($user = $result->fetch_assoc()) {
                    //         echo "<p>ID: " . $user['user_id'] . "</p>";
                    //         echo "<p>Username: " . $user['username'] . "</p>";
                    //         echo "<hr>"; // Add a horizontal line for visual separation
                    //     }
                    // } else {
                    //     echo "No admin users found";
                    // }
                    // ?> 
                </div> -->
            </div>
    </div>
</body>
<script src="\api\admin.js"></script>
</html>