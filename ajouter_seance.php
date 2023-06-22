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
    <?php
        $DateSeance = $_POST["DateSeance"];
        $EffMax = $_POST["EffMax"];
        $theme = $_POST["menuChoixTheme"];
        $currentDate = date("Y-m-d");

        if (empty($DateSeance) || empty($EffMax) || empty($theme)) {
            echo "<label class='message'>Veuillez insérer toutes les infos nécessaires.</label>";
            echo "<br><br><A HREF=ajout_seance.php TARGET=contenu> <button class='form-button'>Retour</button></A>";
        } else{
            if($DateSeance < $currentDate){
                echo"<div class='box'>";
                echo"<h2 class='style-titre3-type1'>Erreur</h2>";
                echo "<label class='message'>La date insérée est dépassée. </label>";
                echo "<br><br><A HREF=ajout_seance.php TARGET=contenu> <button class='form-button'>Retour</button></A>"; 
                echo"</div>";
                  
            }else{

                if($EffMax < 1) {
                    echo"<div class='box'>";
                    echo"<h2 class='style-titre3-type1'>Erreur</h2>";
                    echo "<label class='message'>L'effectif est inférieur à 1. </label><br><br>";
                    echo "<a href='ajout_seance.php'  target='contenu'><button class='form-button'>Revenir en arrière</button></a>";
                    echo"</div>";
                }else{

                    include("connexion.php");

                    $query  = "INSERT INTO seances VALUES(NULL,'$DateSeance','$EffMax','$theme')";

                    //To double check
                    $DateCheck = "SELECT * from seances where DateSeance='$DateSeance' AND  idtheme='$theme'";
                    $check=mysqli_query($connect,$DateCheck);
                    

                    if( mysqli_fetch_row($check) !=0) {

                        echo "<label class='message'>Il existe déjà un séance sur ce thème le même jour.<br></label><br><br>";
                        echo "<a href='ajout_seance.php' target='contenu'><button class='form-button'>Revenir en arrière</button></a>";
                        
                    //End of double check
                    } else {
                        $result = mysqli_query($connect, $query);

                    

                        if (!$result) {
                            echo "<div class='message'>La requête $query a échoué: " , mysqli_error($connect) ."</div>";
                        } else {

                            $themeResult = mysqli_query($connect, "SELECT nom FROM themes WHERE idtheme = '$theme'");
                            $themeRow = mysqli_fetch_assoc($themeResult);
                            $tnom = $themeRow['nom'];

                            echo"<div class='box'>";
                            echo "<label class='form-label'>Mise à jour réussie !</label><br><br><br>";
                            echo"<label class='message'>Theme: $tnom</label>";
                            echo"<label class='message'>Idtheme: $theme</label><br><br><br>";
                            echo "<label class='message'>Date : $DateSeance</label><br><br><br>";
                            echo "<label class='message'>Effectif Max : $EffMax</label><br><br><br>";
                            echo "<a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
                            echo "<a href='ajout_seance.php' target='contenu'><button class='form-button'>Ajouter une séance</button></a>";
                            echo"</div>";
                        }
                    }
                    mysqli_close($connect);   
                }
            }
            
        }
            
       

       
    ?>
    

</body>
</html>