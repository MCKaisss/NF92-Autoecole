<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrire un élève à une séance</title>
    <link rel="stylesheet" href="mes_styles.css">
</head>
<body>
    <h1 class="style-titre1">THE AUTO ECOLE</h1>
    <div class="box">
        
        <h2 class="style-titre3-type1">Desinscrire un élève</h2>

        <?php
            include("connexion.php");
            $currentDate = date("Y-m-d");
            $result = mysqli_query($connect, "SELECT * FROM seances WHERE DateSeance >= '$currentDate'");

            
            echo "<form method='POST' action='desinscrire_eleve.php' class='form-container'>";
            echo "<div class='form-group'>";
            echo "<label for='menuChoixSeance' class='form-label'>Séance:</label>";
            echo "<select name='menuChoixSeance' id='menuChoixSeance' class='form-input form-input-type1' required>";
            while ($seance = mysqli_fetch_assoc($result)){
                $idseance = $seance['idseance'];
                $dateSeance = $seance['DateSeance'];
                $idtheme = $seance['Idtheme'];

                //prendre les noms des themes depuis la BDD theme
                $result2 = mysqli_query($connect, "SELECT nom FROM themes WHERE idtheme = $idtheme");
                $theme = mysqli_fetch_assoc($result2);
                $nomTheme = $theme['nom'];
                
                echo "<option value='$idseance' idtheme='$idtheme' date='$dateSeance'>Séance $idseance - Thème: $nomTheme - $dateSeance</option>";
            }
            echo "</select>";
            echo "</div><br><br>";
            
            $result2 = mysqli_query($connect, "SELECT * FROM eleves");
            
            echo "<div class='form-group'>";
            echo "<label for='menuChoixEleve' class='form-label'>Elève:</label>";
            echo "<select name='menuChoixEleve' id='menuChoixEleve' class='form-input form-input-type1' required>";
            while ($eleve = mysqli_fetch_assoc($result2)){
                $ideleve = $eleve['ideleve'];
                $nom = $eleve['nom'];
                $prenom = $eleve['prenom'];
                echo "<option value='$ideleve'>$prenom $nom (ID: $ideleve)</option>";
            }
            echo "</select>";
            echo "</div><br><br>";
            
            echo "<input type='submit' value='Enregistrer' class='form-button'>";
            echo "</form>";
            mysqli_close($connect);
        ?>
    </div>
    <footer>
        <p class="style-text-footer">© 2023 The Auto Ecole. Tous droits réservés.</p>
    </footer>
</body>
</html>