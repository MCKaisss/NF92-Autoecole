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
    <h1 class="style-titre2">Recapitulatif</h1>
    <?php
        $tnom = $_POST["tnom"];
        $description = $_POST["description"];

        include('connexion.php');

        $escaped_tnom = mysqli_real_escape_string($connect, $tnom);

        $escaped_description = mysqli_real_escape_string($connect, $description);
        // Verification de la validité des données
        if (empty($escaped_tnom) || empty($escaped_description)) {
            echo "<div class='message'>Veuillez insérer toutes les informations nécessaires.</div><br><br>";
            echo "<a href='ajout_theme.html' target='contenu'><button class='form-button'>Retour</button></a>";
        } else {
            

            $checkquery = "SELECT * FROM themes WHERE nom='$escaped_tnom'";
            $checkresult = mysqli_query($connect, $checkquery);

            if (mysqli_fetch_row($checkresult) > 0) {
                $alivecheck = mysqli_query($connect,"SELECT * FROM themes WHERE nom='$escaped_tnom' AND supprime = '1'");
                if (mysqli_fetch_row($alivecheck) > 0) {

                    $query2 = "UPDATE themes SET supprime = 0 WHERE nom = '$escaped_tnom'";
                    $result2 = mysqli_query($connect, $query2);

                    // Vérifier si la mise à jour a réussi
                    if ($result2) {
                        echo"<div class='box'>";
                        echo "<label class='message'>Le thème $escaped_tnom a été restauré. </label>";
                        echo "<br><br><br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
                        echo"/<div>";
                    } else {
                        echo"<div class='box'>";
                        echo"<h2 class='style-titre3-type1'>Erreur</h2>";
                        echo "<label class='message'>Une erreur s'est produite lors de la mise à jour du thème $escaped_tnom.</dilabelv>";
                        echo "<br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
                        echo"</div>";

                    }
                } else {
                    echo"<div class='box'>";
                    echo"<h2 class='style-titre3-type1'>Erreur</h2>";
                    echo "<label class='message'>Le thème existe déjà.</label>";
                    echo "<br><br><a href='ajout_theme.html' target='contenu'><button class='form-button'>Retour</button></a>";
                    echo"</div>";
                    
                }
            } else {
                $query  = "INSERT INTO themes VALUES(NULL, '$escaped_tnom', FALSE, '$escaped_description')";
                $result = mysqli_query($connect, $query);

                if (!$result) {
                    echo "<p>La requête $query a échoué: " . mysqli_error($connect) . "</p>";
                } else {
                    echo"<div class='box'>";
                    echo "<label class='form-label'>Mise à jour réussie !</label><br><br><br>";
                    echo "<label class='message-box'>Nom :</label><br><br>";
                    echo "<label class='message'>$escaped_tnom</label><br><br><br>";
                    echo "<label class='message-box'>Description :</label><br><br>";
                    echo "<label class='message'>$escaped_description</label><br><br><br>";
                    
                    echo "<br><br><br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
                    echo "<br><a href='ajout_theme.html' target='contenu'><button class='form-button'>Ajouter un thème</button></a>";
                    echo"</div>";
                }

                
            }  
        }
        mysqli_close($connect);
    ?>

</body>
</html>

            

</body>
</html>