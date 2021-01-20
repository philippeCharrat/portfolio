# Mon Porte-Folio
Ce dépot est pour mon site web accessible à l'adresse : https://philippecharrat.000webhostapp.com/.
Il contient deux projets séparé : 
 1. Porte-Folio, page pour me présenter avec un formulaire de contact.  
 2. Gestion de ticket, développé dans le cadre d'animateur SGDF. Son but est de faciliter la gestion des factures avec un formulaire accessible via mon téléphone ou ordinateur. Une fois enregistré, je possède des indicateurs de suivi et reproduire les tickets en PDF. 
 
# Langague utilisés 
  - HTML/CSS/JS
  - PHP/SQL
  
# Architecture du site  
Porte-folio : 
  - Index : page contenant toutes les informations. 
  - IndexEN : page contenant toutes les informations en anglais.
  - css : dossier contenant tous les styles. 
  - image : dossier contenant toutes les images.
  - recaptchalib.php : page contenant les méthodes pour utiliser le Captcha de Google.
  
Ticket : 
  - ticket : page qui va afficher toutes les informations d'un ticket avec son identifiants. 
  - gestionticket : page qui va afficher deux tableaux avec tous les tickets de caisses et un qui fait les totales des sommes. Un graphique est disponible en Js.
  - uploadticket : page avec un formulaire pour uploader un ticket (+ photo).
  - fdpf : page contenant toutes les méthodes pour utiliser et générer des pdfs. 
  
# Note 
Ce site a été développé rapidement (trois jours) et des éléments sont apparus depuis. Je pense à :
  - L'utilisation de Bootstrap ( https://www.youtube.com/watch?v=77hwpuVHGps) pas nécessaire.  
  - Peu de sécurité sur la gestion de ticket. 
   
