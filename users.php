<?php
$users = [
    [
        "id" => "1",
        "prenom" => "Sabine",
        "nom" => "Dalmasso",
        "email" => "sabine@gmail.com",
        "mot_de_passe" => "123",
        "genre" => "femme",
        "backgroundColor" => "Clair"
    ],
    [
        "id" => "2",
        "prenom" => "Ambre",
        "nom" => "Mercier Dalmasso",
        "email" => "ambre@gmail.com",
        "mot_de_passe" => "456",
        "genre" => "femme",
        "backgroundColor" => "Sombre"
    ],
    [
        "id" => "3",
        "prenom" => "Sebastien",
        "nom" => "Mercier Baldoni",
        "email" => "Sebastien@gmail.com",
        "mot_de_passe" => "789",
        "genre" => "homme",
        "backgroundColor" => "Sombre"
    ]
];


// Convertir les données en format JSON
$users_jason = json_encode($users, JSON_PRETTY_PRINT);
 
// Nom du fichier JSON
$nom_fichier = 'users.json';
 
// Écrire les données JSON dans le fichier
if (file_put_contents($nom_fichier, $users_jason)) {
    echo "";
} else {
    echo "Erreur lors de l'écriture dans le fichier JSON.";
}
 
?>