<?php
  $sql_server = "localhost";
  $sql_database = "id12404446_ticketsgdf";
  $sql_login = "id12404446_userticketsgdf";
  $sql_password = "&|z\JXbm9rHqar3Y";
  $dbh = new PDO('mysql:host=' . $sql_server . ';dbname=' . $sql_database . ';charset=utf8', $sql_login,$sql_password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
  if (!empty($_POST['upload'])) {
    $nom = $_POST['nom_depense'];
    $description = $_POST['description_depense'];
    $categorie = $_POST['categorie_depense'];
    $valeur = $_POST['valeur_depense'];
    $fichier = $_FILES['fichier']['name'];
    $date = date("Y-m-d");

    if (!empty($fichier)) {
        if( isset($_POST['upload']) ) {
            $content_dir = 'tickets/'; // dossier où sera déplacé le fichier
            $tmp_file = $_FILES['fichier']['tmp_name'];
            if( !is_uploaded_file($tmp_file) ) { exit("Le fichier est introuvable");  }
            $type_file = $_FILES['fichier']['type'];
            echo $type_file;
            $name_file = $_FILES['fichier']['name'];
            if( !move_uploaded_file($tmp_file, $content_dir . $name_file) ) { exit("Impossible de copier le fichier dans $content_dir"); }
            echo "Le fichier a bien été uploadé";
      }
        
      $query = " INSERT INTO `tickets`(`id`, `nom`, `description`, `categorie`, `valeur`, `fichier`, `date`) VALUES(NULL, :nom, :description, :categorie,:valeur,:fichier,:date); ";
      //$sth = $dbh->query($query);
      $sth = $dbh->prepare($query);
      $sth->bindParam(':nom', $nom, PDO::PARAM_STR, 100);
      $sth->bindParam(':description', $description ,PDO::PARAM_STR, 100);
      $sth->bindParam(':categorie', $categorie, PDO::PARAM_STR, 100);
      $sth->bindParam(':valeur', $valeur);
      $sth->bindParam(':fichier', $fichier, PDO::PARAM_STR, 100);
      $sth->bindParam(':date', $date);
      $resultat = $sth->execute();
      
      if ($resultat === FALSE) { $message = "Echec de l'ajout";   }
     else { $message = "Un document ajouté"; }
echo "<script>window.location.replace(\"uploadticket.php\")</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Philippe CHARRAT" />
    <title>Nouveau Ticket</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/portfolio.css">
    <script type="text/javascript" src="scriptredim.js"></script>
    <link rel="stylesheet" href="css/navbar.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet"><link rel="stylesheet" href="css/styleTime.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

  </head>
  <body onload="">
    <style>
    body {
        background:black !important;
    }    
    footer {
        display: flex;
        justify-content: center;
        background-color: black;
        color: white;
    }

    </style>
    
    <div id="corp">
        <form enctype="multipart/form-data" method="post">
            <div class="row" >
              <div class="col-lg-12 col-lg-offset-1">
                <h2>Ajouter une dépense</h2>
              </div>
              <div class="col-sm-12 col-xs-12"><label for="nom_depense" id="label">Nom de la dépence :</label></div>
              <div class="col-sm-12 col-xs-12"><input type="text" id="nom_depense" class="inputs" name="nom_depense" value=""></div>
              <div class="col-sm-12 col-xs-12"><label for="description_depense" id="label">Description de la dépence :</label></div>
              <div class="col-sm-12 col-xs-12"><input type="text" id="description_depense" class="inputs" name="description_depense" value=""></div>
        
              <div class="col-sm-12 col-xs-12"><label for="categorie_depense" id="label">Type de dépence :</label></div>
              <div class="col-sm-12 col-xs-12">
                    <select type="text" id="categorie_depense" class="inputs" name="categorie_depense">
                      <option>Intendance</option>
                      <option>Transport</option>
                      <option>Frais</option>
                      <option>Materielle</option>
                      <option>Divers</option>
                    </select>
                </div>
              <div class="col-sm-12 col-xs-12"><label for="valeur_depense" id="label">Valeur de la dépence :</label></div>
              <div class="col-sm-12 col-xs-12"><input type="number"  step="0.01" id="valeur_depense" class="inputs" name="valeur_depense" min=0 value="10"></div>
              <div class="col-sm-12 col-xs-12"><label for="ticket_depense" id="label">Sélectionner le ticket de caisse :</label></div>
              <div class="col-sm-12 col-xs-12"><center><input type="file" name="fichier" size="30" requierd></center></div>
              <center><input type="submit" name="upload" value="Uploader"></center>
            </div>
        </form>
    
    <footer>
        <p>Obtenir les comptes des résultats : <a href="gestionticket.php">ici</a></p>
    </footer>
    </div>
  </body>
</html>