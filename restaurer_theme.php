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
        
        
        if(empty($Idtheme)){
            echo "<br><br><br><label class='message'>Aucun thème n'a été selectionné. Veuillez choisir un thème existant.</label><br><br><br>";
            echo "<a href='restauration_theme.php' class='form-button' target='contenu'><button>Revenir en arrière</button></a>";
        }else{

            include("connexion.php");
        
            $tnomquery = "SELECT * FROM themes WHERE idtheme='$Idtheme'";
            $tnomreuslt = mysqli_query($connect, $tnomquery);
    
            $tnomassoc = mysqli_fetch_assoc($tnomreuslt);
            $tnom = $tnomassoc['nom'];
    

                
                $query = "UPDATE themes SET supprime = 0 WHERE idtheme = $Idtheme";
                $result = mysqli_query($connect, $query);

                // Vérifier si la mise à jour a réussi
                if ($result) {
                    echo"<div class='box'>";
                    echo "<label class='form-label'>Le thème $Idtheme: $tnom, a été restauré. </label>";
                    echo "<br><br><br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
                    echo "<br><a href='restauration_theme.php' target='contenu'><button class='form-button'>Restaurer un thème</button></a>";
                    echo"</div>";
                } else {
                    echo "<div class='message'>Une erreur s'est produite lors de la mise à jour du thème $Idtheme.</div>";
                    echo "<br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
                }
            mysqli_close($connect);
        }
        
        
    ?>
</body>
</html>