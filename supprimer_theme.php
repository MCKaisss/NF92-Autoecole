<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Désinscrire un élève d'une séance</title>
    <link rel="stylesheet" href="mes_styles.css">
</head>
<body>
    <h1 class="style-titre2">RECAPITULATIF</h1>
    <?php
        $Idtheme = $_POST["menuChoixTheme"];

        include("connexion.php");

        $themeCheckQuery = "SELECT * FROM seances WHERE Idtheme='$Idtheme' AND DateSeance > NOW();";
        $themeCheckResult = mysqli_query($connect, $themeCheckQuery);

        $tnomquery = "SELECT * FROM themes WHERE idtheme='$Idtheme'";
        $tnomreuslt = mysqli_query($connect, $tnomquery);

        $tnomassoc = mysqli_fetch_assoc($tnomreuslt);
        $tnom = $tnomassoc['nom'];
        

        if (mysqli_fetch_row($themeCheckResult) != 0) {
            echo"<div class='box'>";
            echo"<h2 class='style-titre3-type1'>Erreur</h2>";
            echo "<label class='message'>Il y a une séance sur ce thème prévue dans le futur.</label><br><br>";
            echo "<A href='suppression_theme.php' target='contenu'><button class='form-button'>Revenir en arrière</button></A>";
            echo"</div>";
        } else {

            // Mettre à jour la note dans la table "inscription"
            $query = "UPDATE themes SET supprime = 1 WHERE idtheme = $Idtheme";
            $result = mysqli_query($connect, $query);

            // Vérifier si la mise à jour a réussi
            if ($result) {
                echo"<div class='box'>";
                echo "<label class='form-label'>Le thème $Idtheme: $tnom, a été supprimé. </label>";
                echo "<br><br><br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
                echo "<br><a href='suppression_theme.php' target='contenu'><button class='form-button'>Supprimer un thème</button></a>";
                echo"</div>";
            } else {
                echo "<div class='message'>Une erreur s'est produite lors de la mise à jour du thème $Idtheme.</div>";
                echo "<br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
            }
        }
        mysqli_close($connect);
    ?>
</body>
</html>
