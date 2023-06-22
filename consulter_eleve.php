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
    <h1 class="style-titre1">THE AUTO ECOLE</h1>
    

    <div class="box2">
    <h2 class="style-titre3-type1">Consultation du profil Eleves </h2>
        <?php
            include("connexion.php");
            $ideleve = $_POST["menuChoixEleve"];
            
            $result1 = mysqli_query($connect, "SELECT * FROM eleves WHERE ideleve = $ideleve");

            if ($eleve = mysqli_fetch_assoc($result1)){
                $id = $eleve['ideleve'];
                $nom = $eleve['nom'];
                $prenom = $eleve['prenom'];
                $dateNaiss = $eleve['dateNaiss'];
                $dateInscription = $eleve['dateInscription'];

                echo "<label class='message'>Nom : $nom</label>";
                echo "<label class='message2'>Prénom : $prenom</label>";
                echo "<label class='message2'>ID : $id</label><br><br><br>";
                echo "<label class='message'>Date de naissance : $dateNaiss</label>";
                echo "<label class='message'>Date d'inscription : $dateInscription</label><br><br><br><br>";

                $query = "SELECT inscription.idseance, seances.DateSeance, themes.nom AS theme_nom, inscription.note
                FROM inscription
                INNER JOIN seances ON inscription.idseance = seances.idseance
                INNER JOIN themes ON seances.idtheme = themes.idtheme
                WHERE inscription.ideleve = $ideleve";
                $result = mysqli_query($connect, $query);

                if ($result) {
                    echo "<table class='style-table'>";
                    echo "<tr class='message-tab'><th>ID Séance</th><th>Date</th><th>Thème</th><th>Note</th></tr>";
                
                    while ($row = mysqli_fetch_assoc($result)) {
                        $idseance = $row['idseance'];
                        $date = $row['DateSeance'];
                        $theme_nom = $row['theme_nom'];
                        $note = $row['note'];
                        $currentDate = date("Y-m-d");
                        

                        if ($note < 0) {
                            $note = 'A venir';
                        }
                        

                        echo "<tr class='message-tab'><td>$idseance</td><td>$date</td><td>$theme_nom</td><td>$note</td></tr>";
                    }
                
                    echo "</table>";
                } else {
                    echo "<label class='message'>Aucune inscription trouvée pour cet élève.</label>";
                    echo "<br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
                    
                    
                }
            }

            // Fermer la connexion à la base de données
            mysqli_close($connect);
            echo "<br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
        ?>

    </div>
    
</body>
</html>
