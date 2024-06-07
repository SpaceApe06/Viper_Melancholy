<?php
session_start();
include("db_connect.php");

// kjører kun hvis det er en POST request og setter form data til variabler
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // sjekker om passordene er like
    if ($password !== $confirm_password) {
        echo "Passwords do not match";
        exit();
    }

    // Hasher passordene før det blir lagret i database
    $hashed_password = hash("sha256", $password);

    // legger til data i database
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Hvis registreringen er vellykket, sender brukeren tilbake til index.php
        header("Location: index.php");
        exit();
    } else {
        // Hvis registreringen feiler, skriver ut en feilmelding
        echo "Registration failed";
    }
}
?>
