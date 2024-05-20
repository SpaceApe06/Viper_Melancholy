<!-- Hvis en side ikke eksisterer så vil man havne her-->
<?php
header("HTTP/1.0 404 Not Found");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>404 Not Found</title>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body id=error_container>
            <h1>This page does not exist</h1>
            <img src="\public\Snake_404.svg" alt="A Snake has eaten your page">
    </body>
</html>