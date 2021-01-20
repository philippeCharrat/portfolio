<?php
  $sql_server = "localhost";
  $sql_database = "id12404446_ticketsgdf";
  $sql_login = "id12404446_userticketsgdf";
  $sql_password = "&|z\JXbm9rHqar3Y";
  $dbh = new PDO('mysql:host=' . $sql_server . ';dbname=' . $sql_database . ';charset=utf8', $sql_login,$sql_password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  $query = "SELECT * FROM `tickets`";  
  $sth = $dbh->query($query);
  $data = $sth->fetchAll(PDO::FETCH_ASSOC);
  $tableau = "<table><thead><th>id</th><th>Nom</th><th>date</th></thead><tbody>";
  $sommeIntendance = 0;
  $sommeTransport = 0;
  $sommeHebergement = 0; 
  $sommeFrais = 0;
  $sommeMaterielle = 0;
  $sommeDivers =0; 
  $texte = "";
  $alert = 0;
  foreach($data as $row) {
      if ($row['categorie'] == "Intendance") {
            $sommeIntendance = $sommeIntendance + $row['valeur'];
      } elseif ($row['categorie'] == "Transport") {
            $sommeTransport = $sommeTransport + $row['valeur'];
      } elseif ($row['categorie'] == "Hebergement") {
             $sommeHebergement = $sommeHebergement + $row['valeur'];
      } elseif ($row['categorie'] == "Frais") {
             $sommeFrais = $sommeFrais + $row['valeur'];
      } elseif ($row['categorie'] == "Materielle") {
            $sommeMaterielle = $sommeMaterielle + $row['valeur'];
      } elseif ($row['categorie'] == "Divers") {
             $sommeDivers = $sommeDivers + $row['valeur'];
      }
      $tableau = $tableau . '<tr><td><a href="ticket.php?id='.$row['id'].'">'.$row['id'].'</a></td><td>'.$row['nom']."</td><td>".$row['date']."</td></tr>";
      $texte = $texte.$row['nom'].";".$row['categorie'].";".$row['valeur'].";".$row['date']."\n";
    }
    
    $tableau = $tableau. "</tbody></table>";
    file_put_contents('bilan.txt', $texte);
    $sommeTotal = $sommeIntendance + $sommeTransport + $sommeHebergement + $sommeMaterielle + $sommeFrais + $sommeMaterielle;
    $sommeIntendanceP = $sommeIntendance/$sommeTotal*100;
    $sommeTransportP = $sommeTransport/$sommeTotal*100;
    $sommeMaterielleP = $sommeMaterielle/$sommeTotal*100;
    $sommeFraisP = $sommeFrais/$sommeTotal*100;
    $sommeHebergementP = $sommeHebergement/$sommeTotal*100;
    $sommeDiversP = $sommeDivers/$sommeTotal*100;
    
    
    $sommeIntendanceMax = 3038;
    $sommeMaterielleMax = 200;
    $sommeFraisMax = 382;
    $sommeDiversMax = 80; 
    $sommeTransportMax = 1600+1463+200+30+221;
    
    $sommeIntendanceVerif = $sommeIntendance/$sommeIntendanceMax*100 ;
    $sommeMaterielleVerif = $sommeMaterielle/$sommeMaterielleMax*100;
    $sommeFraisVerif = $sommeFrais/$sommeFraisMax*100;
    $sommeDiversVerif = $sommeDivers/$sommeDiversMax*100;
    $sommeTransportVerif = $sommeTransport/$sommeDiversMax*100;
    
    $sommeIntendanceReste = $sommeIntendanceMax-$sommeIntendance ;
    $sommeMaterielleReste = $sommeMaterielleMax-$sommeMaterielle;
    $sommeFraisReste = $sommeFraisMax - $sommeFrais;
    $sommeDiversReste = $sommeDiversMax - $sommeDivers;
    $sommeTransportReste = $sommeTransportMax - $sommeTransport;
    $budget = "Théorique ;".$sommeIntendanceMax .";".$sommeMaterielleMax.";".$sommeFraisMax.";". $sommeDiversMax.";". $sommeTransportMax."\n";
    $budget = $budget ."Dépenser ;".  $sommeIntendance .";".$sommeMaterielle.";".$sommeFrais.";". $sommeDivers.";". $sommeTransport."\n";
    $budget = $budget ."Restant ;".  $sommeIntendanceReste .";".$sommeMaterielleReste.";".$sommeFraisReste.";". $sommeDiversReste.";". $sommeTransportReste."\n";
    file_put_contents('budget.txt', $budget);
    
    if(isset($_POST['submit'])) {
        require('fpdf.php');
        class PDF extends FPDF {
        // Load data
        function LoadData($file)
        {
            // Read file lines
            $lines = file($file);
            $data = array();
            foreach($lines as $line)
                $data[] = explode(';',trim($line));
            return $data;
        }
        
        // Simple table
        function BasicTable($header, $data)
        {
            // Header
            foreach($header as $col)
                $this->Cell(40,7,$col,1);
            $this->Ln();
            // Data
            foreach($data as $row)
            {
                foreach($row as $col)
                    $this->Cell(40,6,$col,1);
                $this->Ln();
            }
        }
        
        // Better table
        function ImprovedTable($header, $data)
        {
            // Column widths
            $w = array(50, 35, 40, 45);
            // Header
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7,$header[$i],1,0,'C');
            $this->Ln();
            // Data
            foreach($data as $row)
            {
                $this->Cell($w[0],6,$row[0],'LR');
                $this->Cell($w[1],6,$row[1],'LR');
                $this->Cell($w[2],6,$row[2],'LR');
                $this->Cell($w[3],6,$row[3],'LR');
                $this->Ln();
            }
            // Closing line
            $this->Cell(array_sum($w),0,'','T');
        }
        
        // Colored table
        function FancyTable($header, $data)
        {
            // Colors, line width and bold font
            $this->SetFillColor(255,0,0);
            $this->SetTextColor(255);
            $this->SetDrawColor(128,0,0);
            $this->SetLineWidth(.3);
            $this->SetFont('','B');
            // Header
            $w = array(80, 35, 40, 45);
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
            $this->Ln();
            // Color and font restoration
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(0);
            $this->SetFont('');
            // Data
            $fill = false;
            foreach($data as $row)
            {
                $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
                $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
                $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
                $this->Cell($w[3],6,$row[3],'LR',0,'R',$fill);
                $this->Ln();
                $fill = !$fill;
            }
            // Closing line
            $this->Cell(array_sum($w),0,'','T');
        }
        
        function FancyTableBudget($header, $data)
        {
            // Colors, line width and bold font
            $this->SetFillColor(52,201,36);
            $this->SetTextColor(255);
            $this->SetDrawColor(128,0,0);
            $this->SetLineWidth(.3);
            $this->SetFont('','B');
            // Header
            $w = array(40, 40, 30, 30, 30,30);
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
            $this->Ln();
            // Color and font restoration
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(0);
            $this->SetFont('');
            // Data
            $fill = false;
            foreach($data as $row)
            {
                $this->Cell($w[0],6,utf8_decode($row[0]),'LR',0,'L',$fill);
                $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
                $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
                $this->Cell($w[3],6,$row[3],'LR',0,'R',$fill);
                $this->Cell($w[4],6,$row[4],'LR',0,'R',$fill);
                $this->Cell($w[5],6,$row[5],'LR',0,'R',$fill);
                $this->Ln();
                $fill = !$fill;
            }
            // Closing line
            $this->Cell(array_sum($w),0,'','T');
        }
        }
        
        $pdf = new PDF();
        // Column headings
        $header = array('Nom', 'Categorie', 'Valeur', 'date');
        // Data loading
        $data = $pdf->LoadData('bilan.txt');
        $budget = $pdf->LoadData('budget.txt');
        
        $pdf->AddPage();
        $pdf->SetFont('Times','B',16);
        $pdf->Cell(190,10,utf8_decode("Résumé des dépenses enregistrés"),0,1,'C');
        $pdf->SetFont('Times','B',10);
        $pdf->FancyTable($header,$data);
        $pdf->Ln(20);
        
        $pdf->SetFont('Times','B',16);
        $pdf->Cell(190,10,utf8_decode("Budget Max, dépensé,  restant"),0,1,'C');
        $pdf->SetFont('Times','B',10);
        $header = array( utf8_decode('Catégorie'),'Intendance', utf8_decode('Matérielle'), 'Frais', 'Divers', 'Transport');
        $pdf->FancyTableBudget($header,$budget);
        $pdf->Output();
            
    }

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Philippe CHARRAT" />
    <meta http-equiv="refresh" content="60;"> 
    <title>Gestion des Tickets</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/portfolio.css">
    <script type="text/javascript" src="scriptredim.js"></script>
    <link rel="stylesheet" href="css/navbar.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet"><link rel="stylesheet" href="css/styleTime.css">
    
  </head>
  <body>
    <style>
    table {
        width: 80%;
    }
    td,th {
        border: solid 1px white!important;
    }
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
    <center>
        <h1>
            Tableaux des tickets 
        </h1>
        <h3> Ajouter un nouveau ticket : <a href="uploadticket.php"> ici </a></h3>
    <?= $tableau ?>
    </br>
    <!--
    
    <table>
        <thead>
            <th>Catégorie</th><th>Somme Restante du budget</th>
        </thead>
        <tr>
            <td> Intendance : </td>
            <td>
                <?php 
                    if (80 > $sommeIntendanceVerif) {
                        echo "<span style='color:green'>".$sommeIntendanceReste."</span>";
                        
                    } elseif (90 > $sommeIntendanceVerif and $sommeIntendanceVerif > 80) {
                        echo "<span style='color:orange'>".$sommeIntendanceReste."</span>";
                        $alert = $alert + 1;
                    } elseif (  $sommeIntendanceVerif > 100) {
                                 echo '<script> alert("attention, Le budget Intendance a été dépassé !");</script>';
                                 echo "<span style='color:white'>".$sommeIntendanceReste."</span>";
                    }else {
                        echo "<span style='color:red'>".$sommeIntendanceReste."</span>";
                        $alert = $alert + 2;
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td> Matérielle : </td>
            <td>
                <?php 
                    if (80 > $sommeMaterielleVerif) {
                        echo "<span style='color:green'>".$sommeMaterielleReste."</span>";
                    } elseif (90 > $sommeMaterielleVerif and $sommeMaterielleVerif > 80) {
                        $alert = $alert + 1;
                        echo "<span style='color:orange'>".$sommeMaterielleReste."</span>";
                    }elseif (  $sommeMaterielleVerif > 100) {
                                 echo '<script> alert("attention, Le budget Matérielle a été dépassé !");</script>';
                                 echo "<span style='color:white'>".$sommeMaterielleReste."</span>";
                    }else {
                        echo "<span style='color:red'>".$sommeMaterielleReste."</span>";
                        $alert = $alert + 2;
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td> Frais : </td>
            <td>
                <?php 
                    if (80 > $sommeFraisVerif) {
                        echo "<span style='color:green'>".$sommeFrais."</span>";
                    } elseif (90 > $sommeIntendanceVerif and $sommeFraisVerif > 80) {
                        $alert = $alert + 1;
                        echo "<span style='color:orange'>".$sommeFraisReste."</span>";
                    } elseif (  $sommeFraisVerif > 100) {
                                 echo '<script> alert("attention, Le budget Matérielle a été dépassé !");</script>';
                                 echo "<span style='color:white'>".$sommeFraisReste."</span>";
                    }else {
                        echo "<span style='color:red'>".$sommeFraisReste."</span>";
                        $alert = $alert + 2;
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td> Divers : </td>
            <td>
                <?php 
                    if (80 > $sommeDiversVerif) {
                        echo "<span style='color:green'>".$sommeDiversReste."</span>";
                    } elseif (90 > $sommeDiversVerif and $sommeDiversVerif > 80) {
                        echo "<span style='color:orange'>".$sommeDiversReste."</span>";
                        $alert = $alert + 1;
                    } elseif (  $sommeDiversVerif > 100) {
                                 echo '<script> alert("attention, Le budget Divers a été dépassé !");</script>';
                                 echo "<span style='color:white'>".$sommeDiversReste."</span>";
                    }else {
                        echo "<span style='color:red'>".$sommeDiversReste."</span>";
                        $alert = $alert + 2;
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td> Transport : </td>
            <td>
                <?php 
                    if (80 > $sommeTransportVerif) {
                        echo "<span style='color:green'>".$sommeTransportReste."</span>";
                    } elseif (90 > $sommeDiversVerif and $sommeTransportVerif > 80) {
                        echo "<span style='color:orange'>".$sommeTransportReste."</span>";
                        $alert = $alert + 1;
                    } elseif (  $sommeTransportVerif > 100) {
                                 echo '<script> alert("attention, Le budget Divers a été dépassé !");</script>';
                                 echo "<span style='color:white'>".$sommeTransportReste."</span>";
                    }else {
                        echo "<span style='color:red'>".$sommeTransportReste."</span>";
                        $alert = $alert + 2;
                    }
                ?>
            </td>
        </tr>
    </table>
    </center>
    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <form method="post"><input  type="submit" id="submit" class="inputs"  name="submit" value="Version PDF" style="color:blue;"></form>
    </div>
        <script>
        window.onload = function() {
        console.log("coucou");
        var chart = new CanvasJS.Chart("chartContainer", {
        	animationEnabled: true,
        	backgroundColor: "black",
        	fontColor :"#ffffff",

        	title: {
        		text: "Résumé des dépences :",
        		fontColor: "white"
        	},
        	data: [{
        		type: "pie",
        		startAngle: 240,
        		yValueFormatString: "##0.00\"%\"",
        		indexLabel: "{label} {y}",
        		 indexLabelFontColor: "white",
        		dataPoints: [
        			{y: <?= $sommeIntendanceP?>, label: "Intendance : <?= $sommeIntendance?> euros"},
        			{y: <?= $sommeFraisP?>, label: "Frais : <?= $sommeFrais?> euros"},
        			{y: <?= $sommeMaterielleP?>, label: "Matérielle : <?= $sommeMaterielle?> euros"},
        			{y: <?= $sommeDiversP?>, label: "Divers : <?= $sommeDivers?> euros"},
        			{y: <?= $sommeTransportP?>, label: "Transport : <?= $sommeTransport?> euros"}
        		] }] });
        chart.render();
        }
        </script>
    <?php
     if( $alert == 1) {
         echo '<script> alert("attention, Une ou plusieurs catégories sont proche  d\'avoir atteins le buddget max !");</script>';
     }
     if( $alert > 1) {
         echo '<script> alert("attention, Une ou plusieurs catégories sont proche  d\'avoir atteins le buddget max !");</script>';
     }
    ?>
    -->
    
  </body>
</html>