<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mes_styles.css">
</head>
<body>
    <h1 class="style-titre1">THE AUTO ECOLE</h1>
    

    <div class="box">
    <h2 class="style-titre3-type1">Interface Note</h2>
        <?php
            
            $seanceId = $_POST["menuChoixSeance"];

           
            if (!empty($seanceId)) {
                include("connexion.php");

                // Sélectionner les élèves inscrits à la séance spécifiée
                $query = "SELECT eleves.*, inscription.note FROM eleves INNER JOIN inscription ON eleves.ideleve = inscription.ideleve WHERE inscription.idseance = $seanceId";
                $result = mysqli_query($connect, $query);

                if ($result) {
                    echo "<form method='POST' action='noter_eleves.php' class='form-container'>";
                    echo "<input type='hidden' name='seanceId' value='$seanceId'>";
                    while ($eleve = mysqli_fetch_assoc($result)) {
                        $eleveId = $eleve['ideleve'];
                        $nomEleve = $eleve['nom'];
                        $prenomEleve = $eleve['prenom'];
                        $noteEleve = $eleve['note'];

                        echo "<div class='form-group'>";
                        echo "<label for='note_$eleveId' class='form-label'>$prenomEleve $nomEleve (ID:$eleveId):</label>";
                        if ($noteEleve >= 0) {
                            echo "<input type='number' name='notes[$eleveId]' id='note_$eleveId' min='0' max='40' step='1' value='$noteEleve' class='form-input'><br>";
                        } else {
                            echo "<input type='number' name='notes[$eleveId]' id='note_$eleveId' min='0' max='40' step='1' class='form-input'><br>";
                        }
                        echo "</div>";
                    }
                    echo "<input type='submit' value='Enregistrer les notes' class='form-button'>";
                    echo "</form>";
                } else {
                    echo "Une erreur s'est produite lors de la récupération des élèves inscrits.";
                    echo "<br><a href='validation_seance.php' target='contenu'><button class='form-button'>Retour</button></a>";
                }
                
                // Fermer la connexion à la base de données
                mysqli_close($connect);
            } else {
                echo "Veuillez sélectionner une séance valide.";
            }
        ?>
    </div>
    
</body>
</html>
