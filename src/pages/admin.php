<?php
session_start();
include("db_connect.php");

// sjekker hvis brukeren er logget inn
if(!isset($_SESSION['user_id'])) {
    echo "You are not properly logged inn";
    exit;
};
    // sjekker hvis brukeren er en admin
    $query = "SELECT admin FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
?>
<html>
    <head>
        <title>Admin Side</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>	

    <body>
        <!-- Navbar -->
        <nav id="navBar">
            <a id="navKnapp" href="/game.php">Game</a>
            <a id="navKnapp" href="/board.php">Stats</a>
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
                        // henter brukere fra databasen
                        $result = "SELECT * FROM users";
                        $result = $conn->query($result);
                        if ($result->num_rows > 0) {
                            // vil gå gjennom alle brukere i databasen og gi info om dem
                            while($user = $result->fetch_assoc()) {
                                echo "<p>ID: " . $user['user_id'] . "</p>";
                                echo "<p>Username: " . $user['username'] . "</p>";

                                // viser hvem som er admin
                                if ($user['admin'] == 1) {
                                    echo "<p>Is Admin</p>";
                                } else {
                                    echo "<p>Not Admin</p>";
                                }
                                
                                // legger til admin knapp
                                echo "<button onclick='addAdmin(" . $user['user_id'] . ")'>Add Admin</button>";
            
                                // Slett bruker knapp
                                echo "<button onclick='deleteUser(" . $user['user_id'] . ")'>Delete</button>";   
                                echo "<hr>";
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>

                    </div>
                </div>
        </div>
    </body>

    <script src="\api\admin.js"></script>
</html>