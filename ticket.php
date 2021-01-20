<?php
    if(isset($_GET['id'])) {    $id = htmlspecialchars($_GET['id']);}
    else { $id = 0;} 
    $sql_server = "localhost";
    $sql_database = "id12404446_ticketsgdf";
    $sql_login = "id12404446_userticketsgdf";
    $sql_password = "&|z\JXbm9rHqar3Y";
    $dbh = new PDO('mysql:host=' . $sql_server . ';dbname=' . $sql_database . ';charset=utf8', $sql_login,$sql_password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $query = "select * from `tickets` where `id`=".$id;  
    $sth = $dbh->query($query);
    $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        
    foreach($data as $row) {
        $nom = $row['nom']; 
        $description = $row['description'];
        $date = $row['date'];
        $categorie= $row['categorie'];
        $valeur = $row['valeur'];
        $fichier = $row['fichier'];
    }
    if(isset($_POST['submit'])) {
        require('fpdf.php');

        class PDF extends FPDF {
             protected $B = 0;
            protected $I = 0;
            protected $U = 0;
            protected $HREF = '';
            // En-tête
            function Header() {
                $this->SetFont('Arial','B',8);
                $this->Cell(40,10,'Ticket de caisse ',1,0,'C');
                $this->Ln(5);
            }

            // Pied de page
            function Footer(){
                $this->SetY(-15);
                $this->SetFont('Arial','I',8);
                $this->Cell(0,10,'COPIE TICKET - Page '.$this->PageNo().'/{nb}',0,0,'C');
            }

            // Fonction pour reconaitre les balises.
            function WriteHTML($html) {
                $html = str_replace("\n",' ',$html);
                $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
                foreach($a as $i=>$e) {
                    if($i%2==0) {
                        // Texte
                        if($this->HREF)
                            $this->PutLink($this->HREF,$e);
                        else
                            $this->Write(5,$e);
                    }
                    else  {
                        // Balise
                        if($e[0]=='/')
                            $this->CloseTag(strtoupper(substr($e,1)));
                        else {
                            // Extraction des attributs
                            $a2 = explode(' ',$e);
                            $tag = strtoupper(array_shift($a2));
                            $attr = array();
                            foreach($a2 as $v) {
                                if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                                    $attr[strtoupper($a3[1])] = $a3[2];
                            }
                            $this->OpenTag($tag,$attr);
                        }
                    }
                }
            }
            function OpenTag($tag, $attr)  {
                // Balise ouvrante
                if($tag=='B' || $tag=='I' || $tag=='U')
                    $this->SetStyle($tag,true);
                if($tag=='A')
                    $this->HREF = $attr['HREF'];
                if($tag=='BR')
                    $this->Ln(5);
            }

            function CloseTag($tag) {
                // Balise fermante
                if($tag=='B' || $tag=='I' || $tag=='U')
                    $this->SetStyle($tag,false);
                if($tag=='A')
                    $this->HREF = '';
            }

            function SetStyle($tag, $enable) {
                // Modifie le style et sélectionne la police correspondante
                $this->$tag += ($enable ? 1 : -1);
                $style = '';
                foreach(array('B', 'I', 'U') as $s)
                {
                    if($this->$s>0)
                        $style .= $s;
                }
                $this->SetFont('',$style);
            }

            function PutLink($URL, $txt) {
                // Place un hyperlien
                $this->SetTextColor(0,0,255);
                $this->SetStyle('U',true);
                $this->Write(5,$txt,$URL);
                $this->SetStyle('U',false);
                $this->SetTextColor(0);
            }
        }
            // Instanciation de la classe dérivée
            $pdf = new PDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont('Times','B',14);
            $pdf->Cell(190,10,utf8_decode(strtoupper($nom)),0,1,'C');
            $pdf->SetFont('Times','',12);
            $pdf->Ln(5);
            $pdf->Cell(190,10,utf8_decode('Catégorie de l\'achat : '),1,1,'L');
            $pdf->Ln(2);
            $pdf->WriteHTML(utf8_decode($categorie));
            $pdf->Ln(5);
            $pdf->Cell(190,10,utf8_decode('Date : '),1,1,'L');
            $pdf->Ln(2);
            $pdf->WriteHTML(utf8_decode($date));
            $pdf->Ln(5);
            $pdf->Cell(190,10, utf8_decode('Prix : '),1,1,'L');
            $pdf->Ln(2);
            $pdf->WriteHTML(utf8_decode($valeur));
            $pdf->Ln(5);
            $pdf->Cell(190,10,'Description : ',1,1,'L');
            $pdf->Ln(2);
            $pdf->WriteHTML(utf8_decode($description));
            $pdf->Ln(5);
            $pdf->Cell(190,10,'Photo : ',1,1,'L');
            $pdf->Ln(5);
            $pdf->Image('tickets/'.$fichier,70,117,-800);
            $pdf->Output();
        }
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Philippe CHARRAT" />
    <title><?=$nom ?></title>
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
        text-align:center;
        margin-left:10%;
    }
    th,td {
        border: 1px white solid;
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
        <h1><?= $nom ?></h1>
    </center>
    
    <h2> Retourner aux tableaux : <a href="gestionticket.php"> ici </a></h2>
    <table>
        <thead>
            <th>Date : </th>
            <th>Valeur (euros) : </th>
            <th>Catégorie : </th>
        </thead>
        <tr>
            <td><?= $date ?></td>
            <td><?= $valeur ?></td>
            <td><?= $categorie ?></td>
        </tr>
        <thead>
            <th colspan="3">Description : </th>
        </thead>
        <tr>
            <td colspan="3"><?= $description ?></td>
        </tr>
        <thead>
            <th colspan="3">Photo : </th>
        </thead>
        <tr>
            <td colspan="3"><img src="tickets/<?= $fichier ?>" style="width:50%;height:30%"></td>
        </tr>
    </table>
     <center><form method="post"><input  type="submit" id="submit" class="inputs"  name="submit" value="Version PDF" style="color:blue;whidth:100% !important;margin:0!important"></form></center>
              
  </body>
</html>