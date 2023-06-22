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
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $dateNaiss = $_POST["dateNaiss"];
        date_default_timezone_set("Europe/Paris");
        $date = date("Y\-m\-d");


        if (empty($nom) || empty($prenom) || empty($dateNaiss)) {
            echo"<div class='box'>";
            echo "<label class='message-box'>Veuillez insérer toutes les infos nécessaires.</label>";
            echo "<a href='ajout_eleve.html' target='contenu'><button class='form-button'>Réesayer</button></a>";
            echo"</div>";
        } else{
            
            if(strtotime($dateNaiss) > strtotime('-15 years')) {
                echo"<div class='box'>";
                echo"<h2 class='style-titre3-type1'>Erreur</h2>";
                $nomImage = 'gmk.jpeg';
                echo '<img src="' . $nomImage . '" alt="gmk">';
                echo "<br><label class='message-box'>L'élève $prenom $nom a moins de 15 ans. <br><br></label>";
                echo "<br><br><a href='ajout_eleve.html' target='contenu'><button class='form-button'>Réesayer</button></a>";
                echo"</div>";
            }else{

                $dbhost ='tuxa.sme.utc';
                $dbuser = 'nf92p044';
                $dbpass = '9HjRD55HJnni';
                $dbname = 'nf92p044';

                $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

                // Test de Connexion
                if (!$connect) {
                    die("Erreur de connection à MySql");
                }

                mysqli_set_charset($connect, "utf8");

                $query  = "INSERT INTO eleves VALUES(NULL,'$nom', '$prenom', '$dateNaiss', '$date')";

                //To double check
                $NameCheck = "SELECT * from eleves where nom='$nom' ";
                $SurnameCheck = "SELECT * from eleves where prenom='$prenom' ";
                $check=mysqli_query($connect,$NameCheck);
                $check2=mysqli_query($connect,$SurnameCheck);

                if( mysqli_fetch_row($check)>0 && mysqli_fetch_row($check2)>0 )
                {
                    echo "<div class='message'>Il existe déjà un compte avec les mêmes nom et prénom.<br>Voulez-vous continuer?</div>";
                    echo "<br><A HREF=autoecole.html TARGET=accueil><button class='form-button'>Annuler</button></A>";
                    echo "<form action='valider_eleve.php' method='POST'>";
                        echo "<input type='hidden' name='nom' value='$nom'>";
                        echo "<input type='hidden' name='prenom' value='$prenom'>";
                        echo "<input type='hidden' name='dateNaiss' value='$dateNaiss'>";
                        echo "<input  class='form-button' type='submit' value='Valider'><br>";
                    echo "</form>";
                //End of double check
                } else {
                    $result = mysqli_query($connect, $query);

                    if (!$result) {
                        echo "<p>La requête $query a échoué: " , mysqli_error($connect) ."</p>";
                    } else {
                        echo"<div class='box'>";
                        echo "<label class='form-label'>Mise à jour réussie !</label><br><br><br>";
                        echo "<label class='message'>Nom : $nom</label><br><br><br>";
                        echo "<label class='message'>Prénom : $prenom</label><br><br><br>";
                        echo "<label class='message'>Date de naissance : $dateNaiss</label>";
                        echo "<br><br><br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
                        echo "<br><a href='ajout_eleve.html' target='contenu'><button class='form-button'>Ajouter un élève</button></a>";
                        echo"</div>";
                        
                       
                        
                    }
                    mysqli_close($connect);
                }   

            }
          
        };

       
    ?>

</body>
</html>