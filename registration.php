<?php
session_start();

// Databasekonfigurasjon
$host = "localhost";
$username = "root";
$password = "admin";
$database = "ticket_system";

// Opprett tilkobling til databasen
$dbc = mysqli_connect($host, $username, $password, $database) or die('Feil ved tilkobling til MySQL-serveren.');

// Sjekk om brukeren allerede er logget inn, hvis ja, omdiriger ham til velkomstsiden
// if(isset($_SESSION['username'])) {
//     header('Location: index.php');
//     exit;
// }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    




<div class="log-in">
    <div class="log-in-text">
       <h1>Opprett ny bruker:</h1>
        <form method="post">
            <label for="username" >Brukernavn:</label>
            <input type="text" class="input-box" name="username" required /><br />

            <label for="epost">Epost:</label>
            <input type="email"  class="input-box" name="epost"  required /><br /> 

            <label for="password">Passord:</label>
            <input type="password" class="input-box" name="password" required /><br />


            
            <input type="submit" value="Logg inn" name="submit" class="LoginButton"/>
        </form>    
        <p class="registrer">Eller klikk <a href="login.php">her</a> for å Logge in</p>
        </div>
   </div>
    </body>
    
    
    <?php
        if(isset($_POST['submit'])){
            //Gjøre om POST-data til variabler
            $brukernavn = $_POST['username'];
            $epost = $_POST['epost'];
            $passord = $_POST['password'];   
            
            //Koble til databasen
            $dbc = mysqli_connect('localhost', 'root', 'admin', 'ticket_system');
             

            
            //Gjøre klar SQL-strengen
            $query = "INSERT INTO users (username, email, password) VALUES ('$brukernavn', '$epost', '$passord')";
            

            
            //Utføre spørringen
            $result = mysqli_query($dbc, $query)
              or die('Error querying database.');
            
            //Koble fra databasen
            mysqli_close($dbc);

            //Sjekke om spørringen gir resultater
            if($result){
                //Gyldig login
                header('location: index.php');
            }else{
                //Ugyldig login
                echo "Noe gikk galt, prøv igjen!";
            }
        }
    ?>



</body>
</html>