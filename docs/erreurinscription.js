// On vérifie si les champs sont vides (si ils sont vides on indique à l'utilisateur qu'il n'a pas rempli tous les champs)
// Il faut récupérer les 5 id et ensuite au clique afficher un message d'erreur

let nom = document.getElementById('nom');
let prenom = document.getElementById('prenom');
let email = document.getElementById('email');
let avatar = document.getElementById('avatar');
let motdepasse = document.getElementById('password');
let inscription = document.getElementById('forminscription');

inscription.addEventListener("submit", (e) => {

    console.log('inscription va marcher');

    let valueNom = nom.value;
    let valuePrenom = prenom.value;
    let valueEmail = email.value;
    let valueAvatar = avatar.value;
    let valueMotDePasse = motdepasse.value;
    let b = document.body;

    if(valueNom == '' || valuePrenom == '' || valueEmail == '' || valueAvatar == '' || valueMotDePasse =='') {

    let ErreurInscription = document.createElement('p');

    ErreurInscription.textContent = "Veuillez saisir tous les champs pour créer votre compte";
    
    b.append (ErreurInscription);
    
    console.log (ErreurInscription);      
    
    e.preventDefault();

    }

});
