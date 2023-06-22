<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mes_styles.css">
</head>
<body>
<h1 class="style-titre2">RECAPITULATIF</h1>
<div class="box2">
<h2 class="style-titre3-type1">Recapitulif des notes ajoutées</h2>
    <?php
        
        
        $seanceId = $_POST["seanceId"];
        $notes = $_POST["notes"];

        
        if (!empty($seanceId) || $notes>-1) {
            
            include("connexion.php");

            
            $updatedNotes = array();

            // Parcourir les notes pour chaque élève
            foreach ($notes as $eleveId => $note) {
                if ($note >= 0) {
                    
                    $query = "UPDATE inscription SET note = '$note' WHERE idseance = $seanceId AND ideleve = $eleveId";
                    $result = mysqli_query($connect, $query);
            
                    if ($result) {
                        $updatedNotes[$eleveId] = $note;
                    } 
                    if((!$result ) && $note!=0){
                        echo "<div class='message'>Une erreur s'est produite lors de la mise à jour des notes de l'élève $eleveId.</div>";
                    }
                }
            }

            // Afficher le tableau récapitulatif des notes mises à jour 

            if (!empty($updatedNotes)) {
                echo "<table class='style-table'>";
                echo "<tr class='message-tab'><th>Élève ID</th><th>Nom</th><th>Prénom</th><th>Note</th></tr>";
                foreach ($updatedNotes as $eleveId => $note) {
                    $eleveQuery = "SELECT* FROM eleves WHERE ideleve='$eleveId'";
                    $eleveResult = mysqli_query($connect, $eleveQuery);

                    $eleveassoc = mysqli_fetch_assoc($eleveResult);
                    $nom = $eleveassoc['nom'];
                    $prenom = $eleveassoc['prenom'];

                    echo "<tr class='message-tab'><td>$eleveId</td><td>$nom</td><td>$prenom</td><td>$note/40</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<div class='message'>Aucune note n'a été mise à jour.</div>";
            }

            
            mysqli_close($connect);
            echo "<br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
            echo "<a href='validation_seance.php' target='contenu'><button class='form-button'>Noter une séance</button></a>";
        } else {
            echo "<div class='message'>Veuillez soumettre des données valides.</div>";
            echo "<br><a href='ajout_eleve.html' target='contenu'><button class='form-button'>Revenir en arrière</button></a>";
        }

    ?>
    </div>
</body>
</html>
