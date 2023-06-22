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
    <div class="box">
        <h2 class="style-titre3-type1">Consulter un profil élève</h2>
        <?php
            include("connexion.php");
            
            
            $result1 = mysqli_query($connect, "SELECT * FROM eleves");

            echo "<form method='POST' action='consulter_eleve.php' class='form-container'>";
            
            echo "<div class='form-group'>";
            echo "<label for='menuChoixEleve' class='form-label'>Elève:</label>";
            echo "<select class='form-input form-input-type1' name='menuChoixEleve' required> ";
            while ($eleve = mysqli_fetch_assoc($result1)){
                $ideleve = $eleve['ideleve'];
                $nom = $eleve['nom'];
                $prenom = $eleve['prenom'];

                
                
                echo "<option value='$ideleve' nom='$nom' prenom='$prenom'>$prenom $nom (Id: $ideleve)</option>";
            }
            echo "</select><br><br>";
            echo "</div>";
            echo "<input type='submit' value='Ouvrir' class='form-button'>";
            
            echo "</form>";
            
        
        ?>
    </div>
    <footer>
        <p class="style-text-footer">© 2023 The Auto Ecole. Tous droits réservés.</p>
    </footer>
</body>
</html>
