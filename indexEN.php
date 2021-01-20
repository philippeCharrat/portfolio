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
    $header.='From:"support@PhilippeCHARRAT.com"<support@PhilippeCHARRAT.com.>'."\n";
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
        } else { $c_msg = "<center><span style='color:red'>Error, an input is empty.</span></center>"; }
    } else {$c_msg = "<center><span style='color:red'>Error,  you have not selected the CAPTCHA.</span></center>"; } 
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Web site of CHARRAT Philippe - web developer." />
        <meta name="author" content="Philippe CHARRAT" />
        <title>Philippe CHARRAT - Dev </title>
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
                    <a class="navbar-brand scroll" href="#index">Philippe CHARRAT - Developer </a>
    		    </div>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li class="hidden active"><a href="#page-top"></a></li>
                        <li><a class="scroll" href="index.php" id="test">FR</a></li>
                        <li><a class="scroll" href="#about" id="test">Who I am ?</a></li>
                        <li><a class="scroll" href="#parcour"id="test">My Career</a></li>
                        <li><a class="scroll" href="#competence" id="test">My Skills</a></li>
                        <li><a class="scroll" href="#portfolio"id="test">My Portfolio</a></li>
                        <li><a class="scroll" href="#contact" id="test">Contact me</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    	<header id="index">
    	    <img src="image/logo.png" style="width:20%;">
    		<h1> Philippe CHARRAT</h1>
    		<h2> Web Developer &  Multimedia Lover</h2>
    		<a href="#about">
    		    <p id="animation"><img src="image/logodescent.png" alt="logo descente" id="logodescente" ></p>
    		</a>
    	</header>
    	<section id="about">
    
    		<div class="row" >
    			<div class="col-lg-10 col-lg-offset-1">
    				<h2>Who I am ?</h2>
    			</div>
    
    			<div class="col-xs-12 col-sm-9 col-md-9 col-lg-7 col-lg-offset-1" >
    				<p id="textPresentation"> My name is Philippe CHARRAT, I am 21 years old and I am a student in Electronics & Computing at CPE Lyon. I am passionate about new technologies and multimedia creation and development (website, games, ...). My hobbies are animating children (14-17 years old) in the Scouts et Guides De France association and the second is computer security. I mainly practice on Root-Me, a french web-site (<a href="https://www.root-me.org/Philippe-Tankmouse"> my id</a> ) with specialization in server and customer challenges.</p>
    				<p id="CVPresentation"> <a href="CV_Charrat_Philippe_EN.pdf" class="button">My Curriculum</a></p>
    			</div>
    			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 col-lg-offset-1" >
    				<img src="image/philippeCHARRAT.png" alt="Portrait de Philippe CHARRAT" id="portrait">
    			</div>
    		</div>
    
    	</section>
    	<section id="parcour">
    		<div class="row" >
    			<div class="col-lg-10 col-lg-offset-1">
    				<h2>My Career </h2>
    			</div>
    		</div>
    			<!--TimeLine by Natalaia Davydova, git : https://github.com/nat-davydova/timeline-->
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
    				            <div class="timeline__event-date"> <span>2018 - In progress</span></div>
    				          </div>
    				          <!--timeline event title-->
    				          <h4 class="timeline__event-title">CPE LYON</h4>
    				          <!--timeline event descrtiption-->
    				          <div class="timeline__event-descr">
    				            <p >Department of Digital Science</p>
    				            <p >Program : </p>
    				            <ul>
    				            	<li>Electronic (Analog & Digital)</li>
    				            	<li>Python / JAVA</li>
    				            	<li>Web Programming Language</li>
    				            </ul>
    				          	<!--<img src="image/logoIN.png" style="width:25%; margin: 0 25%;"> -->
    				          </div>
    				          <!--timeline event actions links-->
    				          <div class="timeline__event-actions"><a class="timeline__event-action" href="https://www.cpe.fr/formation-numerique/ingenieur-sciences-du-numerique/" title="Learn More">Go to site</a></div>
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
    				            <div class="timeline__event-date"> <span>July 2019</span></div>
    				            <div class="timeline__event-time"><span></span></div>
    				          </div>
    				          <!--timeline event title-->
    				          <h4 class="timeline__event-title">Internship : IT - PAPREC</h4>
    				          <!--timeline event descrtiption-->
    				          <div class="timeline__event-descr">
    				          		<p >My Missions : </p>
    				            	<ul>
    				            		<li>Conditioning of connected devices</li>
    				            		<li>AD Server Management </li>
    				            		<li>Web Language</li>
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
    				          <h4 class="timeline__event-title">Diploma of Higher Education</h4>
    				          <!--timeline event descrtiption-->
    				          <div class="timeline__event-descr">
    				            	<p >Main : Network and Telecommunication</p>
    				            	<p >Program : </p>
    				            	<ul>
    				            		<li>Network Architecture </li>
    				            		<li>Programming Language (Python, Java, PHP )</li>
    				            		<li>Telecommunication</li>
    				            	</ul>
    				          </div>
    				          <!--timeline event actions links-->
    				          <div class="timeline__event-actions"><a class="timeline__event-action" href="https://iut1.univ-grenoble-alpes.fr/iut1/departement-reseaux-et-telecommunications-1703.kjsp" title="Learn More">Go to site </a></div>
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
    				            <div class="timeline__event-date"> <span>July 2018</span></div>
    				            <div class="timeline__event-time"><span></span></div>
    				          </div>
    				          <!--timeline event title-->
    				          <h4 class="timeline__event-title">Internship : IT - Ecole Paul Louis Merlin</h4>
    				          <!--timeline event descrtiption-->
    				          <div class="timeline__event-descr">
    				          		<p >My missions : </p>
    				            	<ul>
    				            		<li>Internal Website </li>
    				            		<li>API Creation</li>
    				            		<li>Computer Park Audit</li>
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
    				            <div class="timeline__event-date"> <span>July 2017</span></div>
    				            <div class="timeline__event-time"><span></span></div>
    				          </div>
    				          <!--timeline event title-->
    				          <h4 class="timeline__event-title">India Solidarity Travel</h4>
    				          <!--timeline event descrtiption-->
    				          <div class="timeline__event-descr">
    				          		<p > I made a one-month solidarity trip to India with the TOKSPO association and Scout association (SGDF). This trip was self-financed over 2 years with the realization of extra-jobs (packaging of Gifts, Sale of T-shirts, ...).</p>
    				        	</div>
    				          <!--timeline event actions links-->
    				          <div class="timeline__event-actions">
    				              <a class="timeline__event-action" href="https://compagnons.sgdf.fr/etre-compagnon/" title="Learn More">Learn  more about SGDF </a>
    				              <a class="timeline__event-action" href="https://www.tokspo.org/" title="Learn More">TOKSPO Website</a>
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
    				<h2>My Skills</h2>
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
    	                            <a href="https://montagesdesesmorts.wordpress.com/"><button class="btn btn-default">Go to web site</button></a>
    	                        </div>
    	                    </div>
    	                </div>
    	                <div class="portfolio-text">
    	                    <div class="title">MDSM </div>
    	                    <div class="description"> Missions : website conception (Wordpress), Logo and Graphical Charter creation.
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
    	                            <a href="http://www.praesto.fr/"><button class="btn btn-default">Go to website</button></a>
    	                        </div>
    	                    </div>
    	                </div>
    	                <div class="portfolio-text">
    	                    <div class="title">PRAESTO </div>
    	                    <div class="description"> Missions : Website Integration & development of an email sending feature.
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
    	                            <a href="https://sosscoutisme.000webhostapp.com/"><button class="btn btn-default">Go to website</button></a>
    	                        </div>
    	                    </div>
    	                </div>
    	                <div class="portfolio-text">
    	                    <div class="title">Site Sos Scoutisme</div>
    	                    <div class="description"> A solution developed for animators with stewardship, activities and spiritual time. </div>
    	                </div>
                	</div>            	
            	</div>
            </div>
    	</section>
    	<section id="reference">
    	    <div class="row" >
    			<div class="col-lg-10 col-lg-offset-1">
    				<h2>My References </h2>
    				<h3 id="messagereference"> Sorry references are only available on computer.</h3>
    			</div>
			</div>
	        <div align="center">
                <div class="contener_slideshow">
                    <div class="contener_slide">
                      <div class="slid_1">
                          <p id="referenceTexte">
                              I called on Philippe to manage the graphic side of the various means of communication of Montages De Ses Morts. </br>
                               It meets the requested objectives and is proactive, I recommend 100%.</p>
                          </br>
                          <div id="referenceidphoto">
                            <img src="image/logoMDSM.png" alt="Logo"  id="referencePhoto">
                            <p id="referenceNom"> Valentin TURBAN</p>
                            <p id="referenceTitre">MDSM Manager</p>
                          </div>
                      </div>
                      
                      <div class="slid_2">
                          <p id="referenceTexte">I called on Philippe to develop an automatic email sending function and the integration of my site. </br>
                           He is responsive and met my specifications.
                          </p>
                          </br>
                          <div id="referenceidphoto">
                            <img src="image/logoPRAESTO.png" alt="Logo"  id="referencePhoto">
                            <p id="referenceNom"> Axel BRUYERE</p>
                            <p id="referenceTitre">Dev Senior PRAESTO</p>
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
        				<h2>Contact </h2>
        			</div>
        			<div class="col-sm-12 col-xs-12">
        				<h3>
        				    An idea for a project, a mission or even a question, don't hesitate any longer and contact me by email. I will get back to you shortly!
        				</h3>
        			</div>	
        			<div class="col-sm-12 col-xs-12">
        	                <label for="name" id="label">Name :</label>
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
        	                <label for="objet" id="label">Object :</label>
        			</div>
        			<div class="col-sm-12 col-xs-12">
                			<input type="text" id="objet" class="inputs" name="user_objet" value="<?= $objet ?>">
                	</div>
                	<div class="col-sm-12 col-xs-12">
        	                <label for="msg" id="label">Text :</label>
        			</div>
        			<div class="col-sm-12 col-xs-12">
                			<textarea id="msg"  class="inputs" name="user_msg" style="height: 150px;"><?= $msg ?></textarea>
                	</div>
        			<div class="col-sm-12 col-xs-12">
            	        <div class="g-recaptcha"  data-sitekey="6LfpstUUAAAAAIh2oUMBgSwtJCkSAzHiPPpteYXS" id="capt"></div>
                	</div>
                	<div class="col-sm-12 col-xs-12">
                			<input type="submit" id="submit" class="inputs"  name="user_submit" value="Send">
                	</div>
                	<div class="col-sm-12 col-xs-12">
                			<?= $c_msg ?> 
                	</div>
            	</form>
            	<div class="col-sm-12 col-xs-12">
    				<h3>My social medias : </h3>
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