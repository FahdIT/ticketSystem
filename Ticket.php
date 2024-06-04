<?php
session_start();

// Sjekk om brukeren ikke er logget inn
if (!isset($_SESSION['user_id'])) {
    // Omdiriger til login.php
    header("Location: login.php");
    exit(); // Stopp videre utførelse av skriptet
}

// Hent verdien av $brukernavn fra sesjonen
$brukernavn = $_SESSION['username'];

// Hent brukerens ID fra sesjonen
$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket System</title>
</head>
<body>
    <h1>Ticket System</h1>
    
    <?php

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_ticket'])) {
        $ticket_description = $_POST['ticket_description'];
        $user_id = $_SESSION['user_id'];
        $dbc = mysqli_connect('localhost', 'root', 'admin', 'ticket_system');

        // Sjekk om brukeren er logget inn
        if (!isset($_SESSION['user_id'])) {
            // Omdiriger til login.php
            header("Location: login.php");
            exit(); // Stopp videre utførelse av skriptet
        }

        $Title = $_POST['ticket_title'];
        $ticket_description = $_POST['ticket_description'];

        // Forbered SQL-setningen for å sette inn billetten i databasen
        $sql = "INSERT INTO tickets (user_id, title, description, created_at) VALUES (?, ?, ?, NOW())";

        // Forbered statement
        $stmt = mysqli_prepare($dbc, $sql);
        if (!$stmt) {
            die("Feil ved forberedelse av statement: " . mysqli_error($dbc));
        }

        // Bind parametere
        mysqli_stmt_bind_param($stmt, "iss", $user_id, $Title, $ticket_description);

        // Utfør statement
        if (mysqli_stmt_execute($stmt)) {
            // Billetten ble sendt inn vellykket
            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
            header("Location: index.php");
            exit();
        } else {
            // Håndter feil hvis utførelsen av statement feiler
            echo "Feil ved utførelse av statement: " . mysqli_error($dbc);
            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        }
    }

    echo '<p>Hva vil du rapportere? ' . $brukernavn . '</p>';
    ?>
    
    <form method="post" action='ticket.php'>
        <label for="ticket_title">Tittel:</label><br>
        <input type="text" id="ticket_title" name="ticket_title"><br><br>

        <label for="ticket_description">Beskriv problemet:</label><br>
        <textarea id="ticket_description" name="ticket_description" rows="4" cols="50"></textarea><br><br>
        
        <input type="submit" value="Send inn billett" name="submit_ticket">
    </form>
</body>
</html>
