<?php 
$c_msg = "";
$nom = ""; 
$mail = ""; 
$objet = "";
$msg ="";

if (!empty($_POST['user_submit'])) {
    
    require_once "recaptchalib.php";
    // your secret key
    $secret = "6LfpstUUAAAAAFE0eiHDDH7sDdHnXJ2H3BSWI339";
    // empty response
    $response = null;
    // check secret key
    $reCaptcha = new ReCaptcha($secret);
    // if submitted check response
    if ($_POST["g-recaptcha-response"]) {
        $response = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
        );
    }
    if ($response != null && $response->success) {
    /* --- Récupération et test des différentes valeurs --- */
    $nom = htmlspecialchars($_POST['user_name']); 
	$mail = htmlspecialchars($_POST['user_mail']); 
	$objet = htmlspecialchars($_POST['user_objet']);
	$msg = htmlspecialchars($_POST['user_msg']);
	if (!empty($nom) && !empty($mail) &&!empty($objet) &&!empty($msg)) {

    /* --- Création du mail envoyé ---*/
	$c_msg = "<center><span style='color:green;'>Votre message à bien été transmis, Merci.</span></center>";
	$header="MIME-Version: 1.0\r\n";
    $header.='From:"support@PhilippeCHARRAT.com"<support@PhilippeCHARRAT.cousinade.>'."\n";
    $header.='Content-Type:text/html; charset="uft-8"'."\n";
    $header.='Content-Transfer-Encoding: 8bit';
    $message='
    <html>
    	<body>
    		<div> 
    			 Un nouveau messsage de : '.$nom.' adresse : '.$mail.'<br/> Le message : 
    	 '.$msg.'
		</div></body></html>';
        mail("charrat.p@gmail.com", $objet, $message, $header);
        } else { $c_msg = "<center><span style='color:red'>Attention, un des champs n'est pas remplie.</span></center>"; }
    } else {$c_msg = "<center><span style='color:red'>Erreur, vous n'avez pas remplie le CAPTCHA.</span></center>"; } 
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Cette page contient le site web de Philippe CHARRAT, développeur Freelance." />
        <meta name="author" content="Philippe CHARRAT" />
        <title>Philippe CHARRAT - Dev  Freelance </title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/portfolio.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="icon" type="image/x-icon" href="/favicon.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/styleTime.css">
        <link rel="stylesheet" href="css/styleSlider.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src='https://www.google.com/recaptcha/api.js'></script>
        
    </head>
    
    <body>
        
    	<nav class="navbar navbar-inverse navbar-fixed-top top-nav-collapse" id="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="#"><img src="image/logo.png" alt="Logo"  id="logoNavbar"></a>
                    <a class="navbar-brand scroll" href="#index">Philippe CHARRAT - Développeur </a>
    		    </div>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li class="hidden active"><a href="#page-top"></a></li>
                        <li><a class="scroll" href="indexEN.php" id="test">EN</a></li>
                        <li><a class="scroll" href="#about" id="test">Qui suis-je ?</a></li>
                        <li><a class="scroll" href="#parcour"id="test">Mon Parcours</a></li>
                        <li><a class="scroll" href="#competence" id="test">Mes Compétences</a></li>
                        <li><a class="scroll" href="#portfolio"id="test">Mon Portfolio</a></li>
                        <li><a class="scroll" href="#contact" id="test">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    	</br></br>
    	<header id="index">
    	    <img src="image/logo.png" style="width:20%;">
    		<h1> Philippe CHARRAT</h1>
    		<h2> Développeur web & passionné de multimédia</h2>
    		<a href="#about">
    		    <p id="animation"><img src="image/logodescent.png" alt="logo descente" id="logodescente" ></p>
    		</a>
    	</header>
    	<section id="about">
    
    		<div class="row" >
    			<div class="col-lg-10 col-lg-offset-1">
    				<h2>Qui suis-je</h2>
    			</div>
    
    			<div class="col-xs-12 col-sm-9 col-md-9 col-lg-7 col-lg-offset-1" >
    				<p id="textPresentation">Je m'appelle Philippe CHARRAT, j'ai 21 ans et je suis étudiant en Electronique & Informatique à CPE Lyon. Je suis passionné par les nouvelles technologies et la création multimédia et développement (site web, jeux, ...) . Mes passes temps sont l'encadrement  d'enfants (14-17 ans) dans le cadre des Scouts et Guides De France et la sécurité informatique. Je m'exerce principalement sur Root-Me (<a href="https://www.root-me.org/Philippe-Tankmouse"> mon profil</a> ) avec comme spécialité les challenges serveurs et clients.</p>
    				<p id="CVPresentation"> <a href="CV_Charrat.pdf" class="button">Mon CV</a></p>
    			</div>
    			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 col-lg-offset-1" >
    				<img src="image/philippeCHARRAT.png" alt="Portrait de Philippe CHARRAT" id="portrait">
    			</div>
    		</div>
    
    	</section>
    	<section id="parcour">
    		<div class="row" >
    			<div class="col-lg-10 col-lg-offset-1">
    				<h2>Mon Parcours </h2>
    			</div>
    		</div>
    			<!--TimeLine Inspiré du code de Natalaia Davydova, son git : https://github.com/nat-davydova/timeline-->
    			<div class="content">
    		  	<!--content title-->
    		  		<h2 class="content__title"></h2>
    		  		<!--content inner-->
    		  		<div class="content__inner">
    		    		<div class="timeline">
    		      		<!--timeline bar-->
    				      <div class="timeline__bar"></div>
    				      <!--timeline element-->
    				      <div class="timeline__elem timeline__elem--left">
    				        <!--timeline element date-->
    				        <div class="timeline__date"><span class="timeline__date-day">2020</span><span class="timeline__date-month">2018</span></div>
    				        <!--timeline event-->
    				        <div class="timeline__event">
    				          <!--timeline event full date and time-->
    				          <div class="timeline__event-date-time">
    				            <div class="timeline__event-date"> <span>2018 - en cours</span></div>
    				          </div>
    				          <!--timeline event title-->
    				          <h4 class="timeline__event-title">CPE LYON</h4>
    				          <!--timeline event descrtiption-->
    				          <div class="timeline__event-descr">
    				            <p >Cursus : Science du Numérique</p>
    				            <p >Au programme : </p>
    				            <ul>
    				            	<li>Electronique (Analogique & Numérique)</li>
    				            	<li>Python</li>
    				            	<li>Langage web</li>
    				            </ul>
    				          	<!--<img src="image/logoIN.png" style="width:25%; margin: 0 25%;"> -->
    				          </div>
    				          <!--timeline event actions links-->
    				          <div class="timeline__event-actions"><a class="timeline__event-action" href="https://www.cpe.fr/formation-numerique/ingenieur-sciences-du-numerique/" title="Learn More">Aller vers le site</a></div>
    				        </div>
    				      </div>
    				      <!--timeline element-->
    				      <div class="timeline__elem timeline__elem--right">
    				        <!--timeline element date-->
    				        <div class="timeline__date"><span class="timeline__date-day">Jul</span><span class="timeline__date-month">2019</span></div>
    				        <!--timeline event-->
    				        <div class="timeline__event">
    				          <!--timeline event full date and time-->
    				          <div class="timeline__event-date-time">
    				            <div class="timeline__event-date"> <span>Juillet 2019</span></div>
    				            <div class="timeline__event-time"><span></span></div>
    				          </div>
    				          <!--timeline event title-->
    				          <h4 class="timeline__event-title">Stage au service informatique de PAPREC</h4>
    				          <!--timeline event descrtiption-->
    				          <div class="timeline__event-descr">
    				          		<p >Mes missions : </p>
    				            	<ul>
    				            		<li>Conditionement d'appareils connectés</li>
    				            		<li>Gestion du serveur AD (mot de passe, création de compte)</li>
    				            		<li>Langage web</li>
    				            	</ul>
    				        	</div>
    				          <!--timeline event actions links-->
    				         </div>
    				      </div>
    				      <!--timeline element-->
    				      <div class="timeline__elem timeline__elem--left">
    				        <!--timeline element date-->
    				        <div class="timeline__date"><span class="timeline__date-day">2016</span><span class="timeline__date-month">2018</span></div>
    				        <!--timeline event-->
    				        <div class="timeline__event">
    				          <!--timeline event full date and time-->
    				          <div class="timeline__event-date-time">
    				            <div class="timeline__event-date"> <span>2016</span></div>
    				            <div class="timeline__event-date"> <span>-</span></div>
    				            <div class="timeline__event-time"><span>2018</span></div>
    				          </div>
    				          <!--timeline event title-->
    				          <h4 class="timeline__event-title">DUT R&T</h4>
    				          <!--timeline event descrtiption-->
    				          <div class="timeline__event-descr">
    				            	<p >Cursus : Réseaux & Télécommunications</p>
    				            	<p >Au programme : </p>
    				            	<ul>
    				            		<li>Mise en place d'une infrastructure réseau </li>
    				            		<li>Différents langages de programmation </li>
    				            		<li>Découverte des principes télécommunication</li>
    				            	</ul>
    				          </div>
    				          <!--timeline event actions links-->
    				          <div class="timeline__event-actions"><a class="timeline__event-action" href="https://iut1.univ-grenoble-alpes.fr/iut1/departement-reseaux-et-telecommunications-1703.kjsp" title="Learn More">Accéder au site </a></div>
    				        </div>
    				      </div>
    				      <!--timeline element-->
     				      <!--timeline element-->
    				      <div class="timeline__elem timeline__elem--right">
    				        <!--timeline element date-->
    				        <div class="timeline__date"><span class="timeline__date-day" style="color:black;">Jul</span><span class="timeline__date-month" style="color:black;">2018</span></div>
    				        <!--timeline event-->
    				        <div class="timeline__event">
    				          <!--timeline event full date and time-->
    				          <div class="timeline__event-date-time">
    				            <div class="timeline__event-date"> <span>Juillet 2018</span></div>
    				            <div class="timeline__event-time"><span></span></div>
    				          </div>
    				          <!--timeline event title-->
    				          <h4 class="timeline__event-title">Stage au service informatique de l'Ecole Paul Louis Merlin</h4>
    				          <!--timeline event descrtiption-->
    				          <div class="timeline__event-descr">
    				          		<p >Mes missions : </p>
    				            	<ul>
    				            		<li>Mise en place d'un site web interne</li>
    				            		<li>Création d'une API (requète XML)</li>
    				            		<li>Etude du parc Informatique</li>
    				            	</ul>
    				        	</div>
    				          <!--timeline event actions links-->
    				         </div>
    				      </div>
    				       <div class="timeline__elem timeline__elem--right">
    				        <!--timeline element date-->
    				        <div class="timeline__date"><span class="timeline__date-day" style="color:black;">Jul</span><span class="timeline__date-month" style="color:black;">2017</span></div>
    				        <!--timeline event-->
    				        <div class="timeline__event">
    				          <!--timeline event full date and time-->
    				          <div class="timeline__event-date-time">
    				            <div class="timeline__event-date"> <span>Juillet 2017</span></div>
    				            <div class="timeline__event-time"><span></span></div>
    				          </div>
    				          <!--timeline event title-->
    				          <h4 class="timeline__event-title">Voyage Solidaire en Inde</h4>
    				          <!--timeline event descrtiption-->
    				          <div class="timeline__event-descr">
    				          		<p > Dans le cadre des SGDF, j'ai réalisé un voyage solidaire d'un mois en Inde avec l'association TOKSPO. Ce voyage a été auto-financé sur 2 ans avec la réalisation d'extra-jobs (emballages de Cadeaux, Vente de T-shirts,...). </p>
    				        	</div>
    				          <!--timeline event actions links-->
    				          <div class="timeline__event-actions">
    				              <a class="timeline__event-action" href="https://compagnons.sgdf.fr/etre-compagnon/" title="Learn More">Site Compagnons SGDF </a>
    				              <a class="timeline__event-action" href="https://www.tokspo.org/" title="Learn More">Site de TOKSPO </a>
    				         </div>
    				         </div>
    				      </div>
    				</div>
    		    </div>
    		  </div>
    		</div>
    	</section>
        <section id="competence">
    
    		<div class="row" >
    			<div class="col-lg-10 col-lg-offset-1">
    				<h2>Mes compétences</h2>
    			</div>
    
    			<div class="col-lg-10 col-lg-offset-1">
    				<div class="col-sm-4 col-xs-12">
    	                <img src="image/logoHTML.png" alt="Logo HTML" id="logoLangague"> HTML / CSS
    	        	</div>
    	        	<div class="col-sm-4 col-xs-12">
    	                <img src="image/logoPHP.png" alt="Logo PHP" id="logoLangague"> PHP / SQL
    	            </div>
    				<div class="col-sm-4 col-xs-12">
    	                <img src="image/logoPYTHON.png" alt="Logo PYTHON" id="logoLangague"> PYTHON
    	            </div>
    	        </div>
    	        <div class="col-lg-10 col-lg-offset-1">
    	            <div class="col-sm-4 col-xs-12">
    	                <img src="image/logoPHOTOSHOP.png" alt="Logo PHOTSHOP" id="logoLangague"> PHOTOSHOP
    	        	</div>
    	        	<div class="col-sm-4 col-xs-12">
    	                <img src="image/logoPREMIERPRO.png" alt="Logo PREMIER PRO" id="logoLangague"> PREMIERE PRO
    	            </div>
    				<div class="col-sm-4 col-xs-12">
    	                <img src="image/logoWordpress.png" alt="Logo Wordsepres" id="logoLangague"> Wordpress
            		</div>
                </div>
            </div>
    	</section>
    	<section id="portfolio">
    
    		<div class="row" >
    			<div class="col-lg-10 col-lg-offset-1">
    				<h2>Mon Porte-Folio </h2>
    			</div>
    			<div class="col-lg-10 col-lg-offset-1">
    				<!-- Projet MDSM -->
    				<div class="col-sm-4 col-xs-12">
    	                <div class="portfolio-logo">
    	                    <img class="bloc1 img-responsive logo" src="image/logoMDSM.png" alt="Logo MDSM" id="logoMDSM">
    	                    <div class="bloc1 screen hidden-img">
    	                        <img class="img-responsive" src="image/logoSiteMDSM.PNG" alt="Site MDSM">
    	                        <div class="content-screen">
    	                            <a href="https://montagesdesesmorts.wordpress.com/"><button class="btn btn-default">Accéder au site</button></a>
    	                        </div>
    	                    </div>
    	                </div>
    	                <div class="portfolio-text">
    	                    <div class="title">MDSM - site d'humour</div>
    	                    <div class="description"> Missions : Conception du site (Wordpress), création du logo & de la charte graphique.
    	                	</div>
    	                </div>
                	</div>
    
                	<!-- Projet PRAESTO -->
    				<div class="col-sm-4 col-xs-12">
    	                <div class="portfolio-logo">
    	                    <img class="bloc1 img-responsive logo" src="image/logoPRAESTO.png" alt="Logo PRAESTO" id="logoPRAESTO">
    	                    <div class="bloc1 screen hidden-img">
    	                        <img class="img-responsive" src="image/logoSitePRAESTO.png" alt="Site PRAESTO">
    	                        <div class="content-screen">
    	                            <a href="http://www.praesto.fr/"><button class="btn btn-default">Accéder au site</button></a>
    	                        </div>
    	                    </div>
    	                </div>
    	                <div class="portfolio-text">
    	                    <div class="title">PRAESTO - site de vente</div>
    	                    <div class="description"> Missions : Intégration du site web & développement d'une feature d'envoi de mail. (Projet annulé)
    	                	</div>
    	                </div>
                	</div>
    
                	<!-- Projet Youtube -->
    				<div class="col-sm-4 col-xs-12">
    	                <div class="portfolio-logo">
    	                    <img class="bloc1 img-responsive logo" src="image/logo_sos.png" alt="Logo SOS SCOUTISME" id="logoYOUTUBE">
    	                    <div class="bloc1 screen hidden-img">
    	                        <img class="img-responsive" src="image/logoSiteSOS.png" alt="Site YOUTUBE">
    	                        <div class="content-screen">
    	                            <a href="https://sosscoutisme.000webhostapp.com/"><button class="btn btn-default">Voir le site</button></a>
    	                        </div>
    	                    </div>
    	                </div>
    	                <div class="portfolio-text">
    	                    <div class="title">Site Sos Scoutisme</div>
    	                    <div class="description"> Une solution développé pour les animateurs avec de l'intendance, des activités et temps spirituelle. </div>
    	                </div>
                	</div>            	
            	</div>
            </div>
    	</section>
    	<section id="reference">
    	    <div class="row" >
    			<div class="col-lg-10 col-lg-offset-1">
    				<h2>Mes Références </h2>
    				<h3 id="messagereference"> 
    				    désolé mais mes références ne sont disponibles que sur la versions pour ordinateurs
    				</h3>
    			</div>
			</div>
	        <div align="center">
                <div class="contener_slideshow">
                    <div class="contener_slide">
                      <div class="slid_1">
                          <p id="referenceTexte">
                              J’ai fais appel à Philippe pour gérer le côté graphique des différents moyens de communication de Montages De Ses Morts.</br> 
                              Il répond aux objectifs demandés et est proactifs, je recommande à 100%.
                          </p>
                          </br>
                          <div id="referenceidphoto">
                            <img src="image/logoMDSM.png" alt="Logo"  id="referencePhoto">
                            <p id="referenceNom"> Valentin TURBAN</p>
                            <p id="referenceTitre">Gérant de MDSM</p>
                          </div>
                      </div>
                      
                      <div class="slid_2">
                          <p id="referenceTexte">J’ai fais appel à Philippe pour développer une fonction d'envoie de mail automatique et l'intégration de mon site. </br>
                          Il est réactif et a répondu à mon cahier des charges.
                          </p>
                          </br>
                          <div id="referenceidphoto">
                            <img src="image/logoPRAESTO.png" alt="Logo"  id="referencePhoto">
                            <p id="referenceNom"> Axel BRUYERE</p>
                            <p id="referenceTitre">Dev Principale PRAESTO</p>
                          </div>
                      </div>
                      
                    </div>
                  </div>
            </div>
    	</section>
    	<section id="contact">
    		<form method="post" >
        		<div class="row" >
        			<div class="col-lg-10 col-lg-offset-1">
        				<h2>Me contacter </h2>
        			</div>
        			<div class="col-sm-12 col-xs-12">
        				<h3>Une idée de projet, une mission ou même une question, n'hésitez plus et contactez moi par mail. Je vous répondrai sous peu ! </h3>
        			</div>	
        			<div class="col-sm-12 col-xs-12">
        	                <label for="name" id="label">Nom :</label>
        			</div>
        			
        			<div class="col-sm-12 col-xs-12">
                			<input type="text" id="name" class="inputs" name="user_name" value="<?= $nom ?>">
                	</div>
                	<div class="col-sm-12 col-xs-12">
        	                <label for="mail" id="label">Mail :</label>
        			</div>
        			<div class="col-sm-12 col-xs-12">
                			<input type="email" id="mail" class="inputs" name="user_mail" value="<?= $mail ?>">
                	</div>
        			<div class="col-sm-12 col-xs-12">
        	                <label for="objet" id="label">Objet :</label>
        			</div>
        			<div class="col-sm-12 col-xs-12">
                			<input type="text" id="objet" class="inputs" name="user_objet" value="<?= $objet ?>">
                	</div>
                	<div class="col-sm-12 col-xs-12">
        	                <label for="msg" id="label">Texte :</label>
        			</div>
        			<div class="col-sm-12 col-xs-12">
                			<textarea id="msg"  class="inputs" name="user_msg" style="height: 150px;"><?= $msg ?></textarea>
                	</div>
        			<div class="col-sm-12 col-xs-12">
            	        <div class="g-recaptcha"  data-sitekey="6LfpstUUAAAAAIh2oUMBgSwtJCkSAzHiPPpteYXS" id="capt"></div>
                	</div>
                	<div class="col-sm-12 col-xs-12">
                			<input type="submit" id="submit" class="inputs"  name="user_submit" value="Envoyer !">
                	</div>
                	<div class="col-sm-12 col-xs-12">
                			<?= $c_msg ?> 
                	</div>
            	</form>
            	<div class="col-sm-12 col-xs-12">
    				<h3>Vous pouvez me retrouver sur les réseaux sociaux : </h3>
    			</div>
            	<div class="col-lg-10 col-lg-offset-1">
            		<i style="margin: 0 0 0 37%;;">
    	                <a href="https://www.linkedin.com/in/philippe-charrat-945410127/"><img src="image/logoIN.png" alt="Logo Linkedin" id="logoSocial"></a>
    	                <a href="https://www.facebook.com/pol.philipp"></a><img src="image/logoFACEBOOK.png" alt="Logo Facebook" id="logoSocial"></a>
    	        	</i>
    	        </div>
    	   </div>
    	</section>
    	<footer class="footer">
    	  <p id="footer">Philippe CHARRAT © | 2020 </p>
    	</footer> 
        
    </body>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/jquery.mobile.min.js"></script>
        <script src="js/javascript.js"></script>
        <script  src="./script.js"></script>
</html>