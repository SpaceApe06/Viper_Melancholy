<?php
session_start();
include "db_connect.php";


if(isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
// sjekekr om brukernavn og passord er fylt ut
$username = validate($_POST['username']);
$password = validate($_POST['password']);

// Hvis brukernavn eller passord er mangler, send brukeren med tilbake til index.php med error melding i url
if(empty($username)) {
    header ("Location: index.php?error=Username is required!");
    exit();
}
else if(empty($password)) {
    header ("Location: index.php?error=Password is required!");
    exit();
}

$hashed_password = hash("sha256", $password);

$sql = "SELECT * FROM users WHERE username='$username'"; 

$result = mysqli_query($conn, $sql);


if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['username'] === $username && $row['password'] === $hashed_password) {
        echo "Logged in";
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['admin'] = $row['admin'];
        header("Location: game.php");
        
        exit();
    }
    else{
        header("Location: index.php?error=Something went wrong, check if username, password is correct!");    
        exit();
    }
}
else {
    header("Location: index.php?error=Invalid username or password!");
    exit();
}

?>