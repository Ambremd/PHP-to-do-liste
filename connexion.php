<?php
include_once "compris/header.php";
include_once 'users.php';

//session_start();
session_regenerate_id();
?>

<body>
        
    <h2> Connexion </h2>
    <form action ="submit_login.php" method="POST">
        <div>
            <label for="email">identifiant (adress mail):</label><br>
            <input type="text" id="email" name="email"><br>
        </div>
        <div>
            <label for="mot_de_passe">mot de passe:</label><br>
            <input type="password" id="mot_de_passe" name="mot_de_passe"><br>
        </div>
        <input type="submit" value="Submit">
    </form>  
</body>

<?php
    include_once "compris/footer.php";
?>