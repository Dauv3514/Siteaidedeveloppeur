/* // Affiche un message d'erreur si l'utilisateur n'a pas remplis le champ "mot de passe" (si un champ est vide)

let formulaireConnexion = document.getElementById('formconnexion');

formulaireConnexion.addEventListener("submit", (e)=> {

    let motDePasse = document.getElementById('ppassword');
    let motDePasseValue = motDePasse.value;
    let mail = document.getElementById('eemail');
    let mailValue = mail.value;
    
    if (motDePasseValue == '' && mailValue != '' ) {

        console.log('le mot de passe est vide');
        let errorPassword = document.getElementById('error_password');
        errorPassword.textContent = "Veuillez entrer un mot de passe";

        e.preventDefault();

    } 

});

// Affiche un message d'erreur si l'utilisateur n'a pas remplis le champ "email" (si un champ est vide)

formulaireConnexion.addEventListener("submit", (e)=> {

    let motDePasse = document.getElementById('ppassword');
    let motDePasseValue = motDePasse.value;
    let mail = document.getElementById('eemail');
    let mailValue = mail.value;
    
    if (mailValue == '' && motDePasseValue != '' ) {

        console.log('lemail est vide');
        let errorMail = document.getElementById('error_mail');
        errorMail.textContent = "Veuillez entrer un email";

        e.preventDefault();

    } 

});

// Affiche un message d'erreur si l'utilisateur n'a pas remplis le champ "mot de passe" et le champ "email" (si les 2 champs sont vides)

//je récupère l'id du bouton du formulaire

let formConnexion = document.getElementById('formconnexion');
let adresseMail = document.getElementById('eemail');
let adresseMailValue = adresseMail.value;
let b = document.body;


// au clique j'envoie un événement et un text

formConnexion.addEventListener("submit", (e)=> {

    console.log ("ca va toi ?");

    let mdp = document.getElementById('ppassword');
    let mailValue = adresseMail.value; 
    let mdpValue = mdp.value;
    

    if(mdpValue == '' && mailValue == '') {

    console.log ('je suis dans la condition');

    let messageErreur = document.createElement('p');

    messageErreur.textContent = "Vous navez pas entré votre email ni votre mot de passe";

    b.append (messageErreur);

    console.log (messageErreur);
        
    e.preventDefault();

    } else {

    }

}); */



// Afficher un message d'erreur disant que l'email ou le mot de passe entré est mauvais, et que l'utilisateur ne peut pas se connecter

// 1 - Récuperer la variable contenu dans le fichier php pour afficher dynamiquement le message d'erreur (passer par le html avec l'id)




/* Requete Ajax , message erreur connexion */

let formulaireConnexion = document.getElementById('formconnexion');
let motDePasse = document.getElementById('ppassword');
let adresseMail = document.getElementById('eemail');
let errorMail = document.getElementById('error_mail');
let errorMotDePasse = document.getElementById('error_password');
let errorBadPassword = document.getElementById('error_badpassword');

formulaireConnexion.addEventListener ("submit", (e) =>{

    let isemail =  true ;
    let ispassword = true ;

    // 1 - Tester si email 

    let mailValue = adresseMail.value;

    if(mailValue == '') {

        isemail = false;
        errorMail.textContent = 'Veuillez entrer un mail';

    }
    // 2 - Tester si mot de passe
    let motDePasseValue = motDePasse.value;

    if(motDePasseValue == '') {

        ispassword = false;
        errorMotDePasse.textContent = 'Veuillez entrer un mot de passe';

    }
    
    if (!isemail || !ispassword ) {
        e.preventDefault();
        return
    }
    // 3 - Tester si mot de passe et mail existe dans la bdd

    //Le principe de fonctionnement d'XMLHttpRequest est d'envoyer une requête HTTP vers le serveur, et une fois la requête envoyée, les données renvoyées par le serveur peuvent être récupérées.

    let xhr = new XMLHttpRequest();

    //Déclenche la fonction de traitement lors de la fin de l'appel AJAX.
    //Est équivalent à l'appel à onreadystatechange avec readyState qui vaut 4.
    //Une fois que l'appel AJAX est en statut onload, la propriété response est accessible.

    xhr.onload = (xhr) => {

        //Et c'est ici qu'interviennent les fonctions dites de callback. Une fonction callback est exécutée quand la requête aboutit à quelque chose (que son traitement est fini). Et c'est cette fonction de callback qui va se charger de récupérer les données renvoyées par la requête.

        //Utilisez la fonction JavaScript JSON.parse() pour convertir du texte en un objet JavaScript OU transforme la chaîne de caractères au format JSON pour en produire l'objet Javascript équivalent.
        //La méthode JSON.parse() analyse une chaîne de caractères JSON et construit la valeur JavaScript ou l'objet décrit par cette chaîne.

        //Récupérer les données. Rien de plus simple, il suffit d'utiliser une des deux propriétés disponibles :
        //responseText : pour récupérer les données sous forme de texte brut

        let reponse = JSON.parse(xhr.target.responseText);
        console.log(reponse);

        if(reponse.success) {
            console.log("Utilisateur inscrit");
            window.location="http://localhost:8000/profil.php?id=" + reponse.id;
        } else {
        }

        document.getElementById("error_badpassword").innerHTML = reponse.message;
    

    }                

    // xhr.onload = (xhr) => {
    //     let resultat = JSON.parse(xhr.responseText) ;
    //     console.log(resultat);
    // }

    xhr.open("POST", '/requeteajax.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(`email=${mailValue}&motdepasse=${motDePasseValue}`);
    //xhr.responseType = 'json';
    e.preventDefault();

        
    
})



