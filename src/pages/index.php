<html>
<head>
    <title>logg inn</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
	<body>
        <div id=logg_inn_body>
            
            <div id=Logg_inn_logo_container>
                <img src="public/Viper_melancholy_logo.svg" alt="Viper Melancholy logo" id="Logg_inn_logo" height="100px">
                <p id="Logo_tekst"> Vipers's Melancholy is a clicker game where you click to upgrade the 
                                  snake against enemies and bosses. </p>
            </div>

            <!-- logg inn -->
            <div id="logg_inn">
                <form method="post" action="log_inn.php">
                    <div id="logg_inn_label">
                        <h3>Logg inn</h3>
                        
                    <div id="logg_inn_label">
                        <label for="username">Name:</label>
                        <input type="text" id="username" name="username" placeholder="Username" maxlength="20">
                    </div>
                    <div id="logg_inn_label">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Password" maxlength="20">
                    </div>

                    <!-- hvis brukeren eksisterer går den til påmelding siden, hvis ikke er det en link til å registrere seg -->
                    <div id="login_button_container">
                        <button id="Login_button" type="submit">Login</button><br/>
                    </div>
                        
                    <p>Don't have an account? <a href="register_page.php">Sign Up</a></p>
                </form>
            </div>
        </div>
    </body>
</html>
