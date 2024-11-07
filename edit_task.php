<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) || $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        $taskId = $_GET['id'];
    }
    else {
        $taskId = $_POST['id'];
    }
    // Vérifier si la tâche existe dans la session
    if (isset($_SESSION['tasks'][$taskId])) {
        // Charger les informations de la tâche dans le formulaire
        $task = $_SESSION['tasks'][$taskId];
    } else {
        echo "Tâche non trouvée.";
        exit();
    }
} else {
    echo "ID de tâche non spécifié.";
    exit();
}

// Vérifier si le formulaire est soumis pour la mise à jour de la tâche
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Mettre à jour les informations de la tâche dans la session
    $_SESSION['tasks'][$taskId] = [
        "name" => $_POST["ajouter"],
        "date" => $_POST["date"],
        "priorite" => $_POST["priorite"],
        "categorie" => $_POST["categories"],
        "avancement" => $_POST["avancement"]
    ];

    // Rediriger vers la page principale avec un message de succès
    header("Location: ToDoListe.php?success=task_updated");
    exit();
}
?>

<!-- Formulaire de modification de tâche -->
<div>
    <h2>Modifier la tâche :</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=$taskId"); ?>" method="post">
        <input id="prodId" name="id" type="hidden" value="<?php echo $taskId ?>" />
        <label for="ajouter"> Ajouter :</label>
        <input type="message" id="ajouter" name="ajouter" value="<?php echo $task['name']; ?>"><br>

        <label for="date"> Date Limite :</label>
        <input type="date" id="date" name="date" value="<?php echo $task['date']; ?>"><br>

        <label for="priorite">Priorité :</label>
        <input type="radio" id="prioritebasse" name="priorite" value="basse" <?php echo ($task['priorite'] == 'basse') ? 'checked' : ''; ?>>
        <label for="basse">basse</label>
        <input type="radio" id="prioritemoyenne" name="priorite" value="moyenne" <?php echo ($task['priorite'] == 'moyenne') ? 'checked' : ''; ?>>
        <label for="moyenne">moyenne</label>
        <input type="radio" id="prioritehaute" name="priorite" value="haute" <?php echo ($task['priorite'] == 'haute') ? 'checked' : ''; ?>>
        <label for="haute">haute</label><br>

        <label for="categories">Catégories :</label>
        <select id="categories" name="categories">
            <option value="à faire" <?php echo ($task['categorie'] == 'à faire') ? 'selected' : ''; ?>>à faire</option>
            <option value="course" <?php echo ($task['categorie'] == 'course') ? 'selected' : ''; ?>>course</option>
            <option value="ménage" <?php echo ($task['categorie'] == 'ménage') ? 'selected' : ''; ?>>ménage</option>
        </select><br>

        <label for="avancement">Niveau d'avancement :</label>
        <select id="avancement" name="avancement">
            <option value="non commencé" <?php echo ($task['avancement'] == 'non commencé') ? 'selected' : ''; ?>>non commencé</option>
            <option value="en cours" <?php echo ($task['avancement'] == 'en cours') ? 'selected' : ''; ?>>en cours</option>
        </select><br><br>

        <input type="submit" value="Modifier" name="submit">
    </form>
</div>