<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $taskId = $_GET['id'];

    // Vérifier si la tâche existe dans la session
    if (isset($_SESSION['tasks'][$taskId])) {
        // Supprimer la tâche de la session
        unset($_SESSION['tasks'][$taskId]);

        // Rediriger vers la page principale avec un message de succès
        header("Location: ToDoListe.php?success=task_deleted");
        exit();
    } else {
        echo "Tâche non trouvée.";
        exit();
    }
} else {
    echo "ID de tâche non spécifié.";
    exit();
}
?>
