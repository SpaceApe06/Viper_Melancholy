<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id=logg_inn_body>
        <!-- <br><br> -->
        <!-- logo -->
        <div id=Logg_inn_logo_container>
            <img src="public/Viper_melancholy_logo.svg" alt="Viper Melancholy logo" id="register_inn_logo" height="100px">
            <p id="Logo_tekst"> Vipers's Melancholy is a clicker game where you click to upgrade the 
                snake against enemies and bosses. </p>
        </div>


    <!-- registrer -->
        <div id="logg_inn">
            <form action="register.php" method="post">
                <div id="logg_inn_label">
                    <label for="register_username">Username:</label>
                    <input type="text" id="register_username" placeholder="Username" name="username" required>
                </div>
                <div id="logg_inn_label">
                    <label for="register_password">Password:</label>
                    <input type="password" id="register_password" placeholder="Password" name="password" required>
                </div>
                <div id="logg_inn_label">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" placeholder="Confirm Password" name="confirm_password" required>
                </div>
                
                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <a href="index.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
