<?php
session_start();

// Sjekk om brukerens sesjonsvariabel for bruker-ID ikke er satt
if (!isset($_SESSION['user_id'])) {
    // Omdiriger til login.php
    header("Location: login.php");
    exit(); // Stopp videre kjøring av skriptet
}

// Databasekonfigurasjon
$host = "localhost";
$brukernavn = "root";
$passord = "admin";
$database = "ticket_system";

// Opprett tilkobling til databasen
$dbc = mysqli_connect($host, $brukernavn, $passord, $database) or die('Feil ved tilkobling til MySQL-serveren.');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ticket_system</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Ticket System</h1>


<a href="Ticket.php">Trenger Hjelp?</a>



<?php
if (isset($_SESSION['username'])) {
    // Hvis innlogget, vis utloggingsknapp
    $brukernavn = $_SESSION['username']; // Hent verdien av $brukernavn fra sesjonen
    $user_id = $_SESSION['user_id']; // Hent bruker-ID fra sesjonen
    echo '<h2>Hei ' . $brukernavn . '</h2>';
    echo '<form method="post">';
    echo '<input type="submit" value="Logg ut" name="logout" />';
    echo '</form>';
    

} else {
    // Hvis ikke innlogget, vis melding
    echo '<li><a href="login.php">Login</a></li>';
}

// Hent billetter fra databasen for innlogget bruker
$sql = "SELECT title, description FROM tickets WHERE user_id = ?";
$stmt = mysqli_prepare($dbc, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>





<h1>Dine Biletter:</h1>

<?php
  // Vis billetter
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<h4>{$row['title']}</h4>";
    echo "<p>{$row['description']}</p>";
}

// Sjekk om utloggingsknappen er klikket
if (isset($_POST['logout'])) {
    // Avslutt sesjonen
    session_unset();
    session_destroy();
    // Omdiriger til login.php
    header("Location: login.php");
    exit();
}
?>


</body>
</html>
