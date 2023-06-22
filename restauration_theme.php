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
        
        <h2 class="style-titre3-type1">Restaurer un theme</h2>

        <?php
            include("connexion.php");
            $currentDate = date("Y-m-d");
            $result = mysqli_query($connect, "SELECT * FROM themes WHERE supprime = 1");

            
            echo "<form method='POST' action='restaurer_theme.php' class='form-container'>";
            echo "<div class='form-group'>";
            echo "<label for='menuChoixTheme' class='form-label'>Theme:</label>";
            echo "<select name='menuChoixTheme' id='menuChoixTheme' class='form-input form-input-type1' required>";
            while ($theme = mysqli_fetch_assoc($result)){
                $idtheme = $theme['idtheme'];
                $nom = $theme['nom'];
                
                echo "<option value='$idtheme' nom='$nom'>Theme $idtheme - : $nom</option>";
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
