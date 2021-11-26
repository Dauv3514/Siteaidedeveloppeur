//let aFaire = document.getElementById('afaire');
//let texteAFaire = document.getElementById('texteafaire');

function cacher(){ 

    let lecontenu = document.getElementById('contenu');

    if(lecontenu.style.display == 'block'){
        lecontenu.style.display = 'none'

        console.log(lecontenu);
    }
    else {
        lecontenu.style.display = 'block'
    }

}

function deplacerafaire(){ 

    let taches = document.getElementById('lestaches');
    let afaire = document.getElementById('afaire');
    console.log(afaire);
    afaire.appendChild(taches); 

}

function deplacerencours(){ 

    let taches = document.getElementById('lestaches');
    let encours = document.getElementById('encours');
    console.log(encours);
    encours.appendChild(taches); 

}

function deplacertermine(){ 

    let taches = document.getElementById('lestaches');
    let termine = document.getElementById('termine');
    console.log(termine);
    termine.appendChild(taches); 

}

let taches = document.querySelector('.lestaches');
let tache = document.querySelector('.taches');
taches.addEventListener('dragstart', dragStart);
taches.addEventListener('dragend', dragEnd);

function dragStart() {
    console.log("start");
}
function dragEnd() {
    console.log("end");
}




// let contenu = document.getElementById('contenu').textContent;
// console.log(contenu);

// let affichage = document.createElement('p');

// affichage.textContent = contenu;

// texteAFaire.append (affichage);

// console.log(affichage);

// e.preventDefault();


// AUTRE IDEE

/* function init(){
    document.getElementById('contenu').style.marginLeft = '0px'
    
}

function cacher(contenu){ 
if(contenu.style.display == 'none'){
    contenu.style.display = 'block'
}
else{
    contenu.style.display = 'none'
}
}

function deplacer(contenu){
    contenu.style.marginLeft = (parseInt(contenu.style.marginLeft.split('px')[0]) + 100) + 'px'  
} */
