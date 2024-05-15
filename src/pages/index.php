<html>
<head>
    <title>Viper's Melancholy</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
	<body>
        <h1>Viper's Melancholy</h1>
		<p>
			Vipers's Melancholy is a clicker game where you click to upgrade the
			snake against enemies and bosses.
		</p>
        <!-- id="loggInn" -->
        <form method="post" action="log_inn.php">
                <div id="brukernavn">
                    <label for="username">Name:</label>
                    <input type="text" id="username" name="username" placeholder="Username" maxlength="20">
                </div>
                <div id="Passord">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Password" maxlength="20">
                </div>
                <!-- hvis brukeren eksisterer går den til påmelding siden, hvis ikke er det en link til å registrere seg -->

                    <div id="login_button_container">
                        <button id="Login_button" type="submit">Login</button><br/>
                    </div>

                    <p>Don't have an account? <a href="register_page.php">Sign Up</a></p>
        </form>
		<a href="game.php">To game</a>
    </body>
<style>

    </style>
    </html>
