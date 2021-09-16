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

/* function deplacer(){

    var el1 = document.getElementById('contenu');
    var el2 = document.getElementById('texteafaire');
    $("#contenu").appendTo("#texteafaire");

} 

$("#appendTo").click(function() {
    $("#contenu").appendTo($("#texteafaire"));
}); */



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
