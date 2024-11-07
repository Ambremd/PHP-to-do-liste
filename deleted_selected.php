<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_tasks'])) {
    $selectedTasks = $_POST['selected_tasks'];

    // Vérifier si des tâches ont été sélectionnées
    if (!empty($selectedTasks)) {
        // Parcourir les tâches sélectionnées et les supprimer de la session
        foreach ($selectedTasks as $taskId) {
            if (isset($_SESSION['tasks'][$taskId])) {
                unset($_SESSION['tasks'][$taskId]);
            }
        }
        // Rediriger vers la page principale avec un message de succès
        header("Location: ToDoListe.php?success=tasks_deleted");
        exit();
    } else {
        // Rediriger vers la page principale avec un message d'erreur si aucune tâche n'a été sélectionnée
        header("Location: ToDoListe.php?error=no_tasks_selected");
        exit();
    }
} else {
    // Rediriger vers la page principale si la requête n'est pas de type POST ou si aucune tâche n'a été sélectionnée
    header("Location: ToDoListe.php");
    exit();
}
?>
