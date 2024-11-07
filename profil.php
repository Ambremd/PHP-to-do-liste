<?php
include_once "compris/header.php";
//include_once 'users.php';

//session_start();

// Charger les données des utilisateurs depuis le fichier users.json
$usersData = file_get_contents("users.json");
$users = json_decode($usersData, true);

// Vérifier si l'utilisateur est connecté, sinon le rediriger vers la page de connexion
if (!isset($_SESSION["LOGGED_USER"])) {
    header("Location: connexion.php");
    exit;
}

// Trouver l'utilisateur connecté dans la liste des utilisateurs
$loggedUserId = $_SESSION["LOGGED_USER"]["id"];
$loggedUserIndex = array_search($loggedUserId, array_column($users, "id"));


// Vérifier si le formulaire a été soumis
if (isset($_POST["prenom"])&& isset($_POST["nom"])
&& isset($_POST["email"])&& isset($_POST["mot_de_passe"])
&& isset($_POST["genre"])&& isset($_POST["backgroundColor"])) {
    
    // Mettre à jour les informations de l'utilisateur avec les nouvelles valeurs
    /*$users[$loggedUserIndex]["prenom"] = $_POST["prenom"];
    $users[$loggedUserIndex]["nom"] = $_POST["nom"];
    $users[$loggedUserIndex]["email"] = $_POST["email"];
    $users[$loggedUserIndex]["mot_de_passe"] = $_POST["mot_de_passe"];
    $users[$loggedUserIndex]["genre"] = $_POST["genre"];
    $users[$loggedUserIndex]["backgroundColor"] = $_POST["backgroundColor"];*/
    /*echo " prenom: " . $_POST["prenom"];
    echo " nom: " . $_POST["nom"];
    echo " email: " . $_POST["email"];
    echo " mot_de_passe: " . $_POST["mot_de_passe"];
    echo " genre: " . $_POST["genre"];
    echo " backgroundColor: " . $_POST["backgroundColor"];*/
    $newUser = [ 
    "id" => $_POST["id"],
     "prenom" => $_POST["prenom"],
     "nom" =>$_POST["nom"],
     "email"=> $_POST["email"],
     "mot_de_passe"=> $_POST["mot_de_passe"],
     "genre" =>$_POST["genre"],
     "backgroundColor" =>$_POST["backgroundColor"],
    ];

    // Enregistrer les modifications dans le fichier users.json
    $newUsersList = [];

    foreach($users as $user) {
        echo $user["id"] . " - " . $newUser["id"] . "<br>";
        if($user["id"] != $newUser["id"]){
            array_push($newUsersList, $user);
        }
        else {
            array_push($newUsersList, $newUser);            
        }
    }
    echo var_dump($newUsersList);
    $users  = $newUsersList;
    file_put_contents("users.json", json_encode($newUsersList, JSON_PRETTY_PRINT));
//foreach ($_SESSION["tasks"] as $key => $task) {
    /*foreach ($_SESSION["LOGGED_USER"]as $key => $loggedUserId){
        
    };*/
    
    // Rediriger vers la page de profil
    header("Location: ToDoListe.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil</title>
</head>
<body>
    <h1>Modifier le profil</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input id="prodId" name="id" type="hidden" value="<?php echo $loggedUserId ?>" />

        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $users[$loggedUserIndex]["prenom"]; ?>"><br><br>

        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo $users[$loggedUserIndex]["nom"]; ?>"><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $users[$loggedUserIndex]["email"]; ?>"><br><br>

        <label for="mot_de_passe">Mot de passe:</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" value="<?php echo $users[$loggedUserIndex]["mot_de_passe"]; ?>"><br><br>

        <label for="genre">Genre:</label>
        <select id="genre" name="genre">
            <option value="homme" <?php if ($users[$loggedUserIndex]["genre"] == "homme") echo "selected"; ?>>Homme</option>
            <option value="femme" <?php if ($users[$loggedUserIndex]["genre"] == "femme") echo "selected"; ?>>Femme</option>
            <option value="autre" <?php if ($users[$loggedUserIndex]["genre"] == "autre") echo "selected"; ?>>Autre</option>
        </select><br><br>

        <label for="backgroundColor">Couleur de fond:</label>
        <select id="backgroundColor" name="backgroundColor">
            <option value="clair" <?php if ($users[$loggedUserIndex]["backgroundColor"] == "clair") echo "selected"; ?>>Clair</option>
            <option value="sombre" <?php if ($users[$loggedUserIndex]["backgroundColor"] == "sombre") echo "selected"; ?>>Sombre</option>
        </select><br><br>

        <input type="submit" value="Enregistrer les modifications">
    </form>
    <br>
    <a href="logout.php">Déconnexion</a>
</body>
</html>


<?php
    include_once "compris/footer.php";
?>
