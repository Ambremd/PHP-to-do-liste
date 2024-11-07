<?php
include_once "compris/header.php";
//include_once 'users.php';

//valider la connexion et acces a new page
    //include_once 'users.php';
    /*if(isset($_SESSION["LOGGED_USER"])) {
        session_unset();
        session_destroy();
    }*/
    //session_start();
    $data = $_POST;
?>

<main>
    <?php if(isset($_SESSION["LOGGED_USER"])) : ?>
        <h2>Bienvenue <?php echo $_SESSION["LOGGED_USER"]["nom"]; ?></h2>
    <?php else : ?>
        <h2>Echec</h2>
    <?php endif; ?>
</main>

<?php

    /*if(isset($data["ajouter"])) {
        echo "Tâche:" . $data["ajouter"];
        $task = [
            name:
        ]
    }*/
    if (isset($data["ajouter"])) {
        // Vérifie si la tâche est vide
        if (!empty($data["ajouter"])) {
            // Initialise le tableau de tâches s'il n'existe pas encore
            if (!isset($_SESSION["tasks"])) {
                $_SESSION["tasks"] = array();
            }
    
            // Ajoute la nouvelle tâche à la liste des tâches
            /*$task = [
                "name" => $data["ajouter"]
            ];*/
        
            $task = [
                "name" => $_POST["ajouter"],
                "date" => $_POST["date"],
                "priorite" => $_POST["priorite"],
                "categorie" => $_POST["categories"],
                "avancement" => $_POST["avancement"]
            ];
            //echo /*"Ma tâche est:" .*/ var_dump($task);
    
            // Ajoute la tâche à la liste des tâches
            $_SESSION["tasks"][] = $task;
    
            /* Affiche la confirmation
            echo "Tâche ajoutée : " . $data["ajouter"];*/
        } else {
            echo "Le champ de la tâche est vide. Veuillez saisir une tâche.";
        }
    }
        // Affiche la liste des tâches
        /*if (isset($_SESSION["tasks"]) && !empty($_SESSION["tasks"])) {
            echo "<h2>Liste des tâches :</h2>";
            echo "<ul>";
            foreach ($_SESSION["tasks"] as $task) {
                if($task) {
                echo "NAme:" . $task["name"];
                echo "<li>" . htmlspecialchars($task["name"]) . "</li>";
                }
            }
            echo "</ul>";
    }
    if (!empty($_SESSION["tasks"])) {
        echo "<h2>Liste des tâches :</h2>";
        echo "<ul>";
        foreach ($_SESSION["tasks"] as $key => $task) {
            echo "<li>" . htmlspecialchars($task["name"]) . " ";
            echo "<a href='edit_task.php?id=$key'>Modifier</a> ";
            echo "<a href='delecte_task.php?id=$key'>Supprimer</a>";
            echo "</li>";
        }
        echo "</ul>";
    }*/
    if (!empty($_SESSION["tasks"])) {
        echo "<h3>Liste des tâches :</h3>";
        echo "<form action='deleted_selected.php' method='post'>"; // Ajout du formulaire pour la suppression de tâches sélectionnées
        echo "<ul>";
        foreach ($_SESSION["tasks"] as $key => $task) {
            echo "<li><input type='checkbox' name='selected_tasks[]' value='$key'>" . htmlspecialchars($task["name"]) . " "; // Ajout de la case à cocher
            echo "<select name='task_avancement[$key]'>"; // Balise select pour l'avancement de la tâche
            echo "<option value='avancement1'"; if ($task["avancement"] == "avancement1") echo " selected"; echo ">Non commencé</option>";
            echo "<option value='avancement2'"; if ($task["avancement"] == "avancement2") echo " selected"; echo ">En cours</option>";
            echo "<option value='avancement3'"; if ($task["avancement"] == "avancement3") echo " selected"; echo ">Terminé</option>";
            echo "</select>";
            echo "<a href='edit_task.php?id=$key'>Modifier</a> ";
            echo "<a href='delecte_task.php?id=$key'>Supprimer</a>";
            echo "</li>";
        }
        echo "</ul>";
        echo "<input type='submit' value='Supprimer les tâches sélectionnées'>"; // Bouton pour supprimer les tâches sélectionnées
        echo "</form>";
    }
     
    
?>

<!--formulaire-->

<div>
<h3> Formulaire : </h3>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="ajouter"> Ajouter :</label>
        <input type="message" id="ajouter" name="ajouter"><br>

        <label for="date"> Date Limite :</label>
        <input type="date" id="date" name="date"><br>

        <label for="priorite">Priorité :</label>
        <input type="radio" id="prioritebasse" name="priorite" value="basse">
        <label for="basse">basse</label>
        <input type="radio" id="prioritemoyenne" name="priorite" value="moyenne">
        <label for="moyenne">moyenne</label>
        <input type="radio" id="prioritehaute" name="priorite" value="haute">
        <label for="haute">haute</label><br>

        <label for="categories">Catégories :</label>
        <select id="categories" name="categories">
            <option value="categorie1">à faire</option>
            <option value="categorie2">course</option>
            <option value="categorie3">ménage</option>
        </select><br>

        <label for="avancement">Niveau d'avancement :</label>
        <select id="avancement" name="avancement">
            <option value="avancement1">non commencé</option>
            <option value="avancement2">en cours</option>
            <option value="avancement3">terminée</option>
        </select><br><br>


        <input type="submit" value="envoyé">
    </form>
</div>


<?php
// Function to read tasks from JSON file
function readTasks() {
    $tasksFile = 'tasks.json';
    if (file_exists($tasksFile)) {
        $tasksData = file_get_contents($tasksFile);
        return json_decode($tasksData, true);
    } else {
        return [];
    }
}
 
// Function to write tasks to JSON file
function writeTasks($tasks) {
    $tasksFile = 'tasks.json';
    file_put_contents($tasksFile, json_encode($tasks));
}
 
$tasks = readTasks();
 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && !isset($_SESSION["tasks"])) {
    $task = $_POST['task'];
    if (!empty($task)) {
        $tasks[] = $task;
        writeTasks($tasks);
    }
}
 
if (!empty($tasks)) {
    echo "<ul>";
    foreach ($tasks as $task) {
       //echo "<li>$task</li>";
    }
    echo "</ul>";
}
?>

<br>
<a href="logout.php">Déconnexion</a>

<?php
    include_once "compris/footer.php";

    // Convertir les données en format JSON
    //if(isset($_SESSION["tasks"])) {
        $tasks_jason = json_encode($_SESSION["tasks"], JSON_PRETTY_PRINT);
        
        // Nom du fichier JSON
        $nom_fichier = 'tasks.json';
        
        // Écrire les données JSON dans le fichier
        if (file_put_contents($nom_fichier, $tasks_jason)) {
            echo "";
        } else {
            echo "Erreur lors de l'écriture dans le fichier JSON.";
        }
    //}
?>
