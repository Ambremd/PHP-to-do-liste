<?php
    include_once 'users.php';
    session_start();
    $data = $_POST;
    if(
        !isset($data["email"]) || empty($data["email"]) ||
        !isset($data["mot_de_passe"]) || empty($data["mot_de_passe"]) ||
        !filter_var($data["email"], FILTER_VALIDATE_EMAIL)
    ) {
        echo "Il y a une erreur dans le formulaire";
        return;
    }
    else{
        // for each sur le tableau users
        foreach($users as $user) {
            if($user["email"] === $data["email"] 
            && $user["mot_de_passe"] === $data["mot_de_passe"])
            {
                $_SESSION["LOGGED_USER"] = [
                    "id" => $user["id"],
                    "email" => $user["email"],
                    "nom" => $user["nom"],
                    "genre" => $user["genre"]
                ];
            }   
        }

    }
   

   /* if(
        (!isset($data["email"]) || empty($data["email"]) ||
        !isset($data["mot_de_passe"]) || empty($data["mot_de_passe"]) ||
        !filter_var($data["email"], FILTER_VALIDATE_EMAIL)) && !isset($_SESSION["LOGGED_USER"])
    ) {
        echo "Il y a une erreur dans le formulaire";
        return;
    }
    else{
        $userFound = false;
        foreach($users as $user) {
           echo "<br>---------";
            echo "<br>Email USER: " . $user["email"];
            echo "<br>Email DATA: " . $data["email"];
            echo "<br>Mot de passe USER: " . $user["mot_de_passe"];
            echo "<br>Mot de passe DATA: " . $data["mot_de_passe"];
            echo "<br>---------";

            if($user["email"] === $data["email"] 
            && $user["mot_de_passe"] === $data["mot_de_passe"])
            {
                $userFound = true;
                session_start();
                session_regenerate_id();
                $_SESSION["LOGGED_USER"] = [
                    "email" => $user["email"],
                    "prenom" => $user["prenom"],
                    "genre" => $user["genre"]
                ];
            }   
            else {
                echo "pas de correspondance<br>";
                if(!$userFound) {
                    echo "pas d'utilisateur<br>";
                    if(isset($_SESSION["LOGGED_USER"])) {
                        echo "session détruite<br>";
                        session_unset();
                        session_destroy();
                    }
                }
            }
        }


    }*/
?>

<main>
    <?php if(isset($_SESSION["LOGGED_USER"])) : ?>
        <a href="ToDoListe.php">To do liste</a>
    <?php else : ?>
        <h2>Echec</h2>
    <?php endif; ?>
</main>


