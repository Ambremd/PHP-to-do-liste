<!doctype html>
<html>
    <head> </head>

    <body>
        <header>
            <h1>To Do Liste</h1>
            

            <nav>
            <ul>
                <li><a href="ToDoListe.php">To Do Liste</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                <?php
                // Vérifier si l'utilisateur est connecté
                session_start();
                if(isset($_SESSION["LOGGED_USER"])) {
                    echo '<li><a href="profil.php">Profil</a></li>';
                }
                ?>
            </ul>
        </header>
    </body>
</html>
