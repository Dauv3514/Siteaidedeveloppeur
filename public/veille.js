let button = document.getElementById('newveille');
let lienGoogle = document.getElementById('liengoogle');
let imageGoogle = document.getElementById('imagegoogle');

button.addEventListener("click",(e)=> {

    let lien = lienGoogle.value ;
    let image = imageGoogle.value;

    console.log(image);
    
        let affichage = document.getElementById('affichage');
        let a = document.createElement('a');  
        let liens = document.createTextNode("Lien vers ma veille");    
        a.href = lienGoogle;
        a.appendChild(liens); 
        affichage.appendChild(a); 


    if(lien == '' || image == '') {
    

    } else {

        let xhr = new XMLHttpRequest();

        xhr.onload = (xhr) => { 

        
            let reponse = JSON.parse(xhr.target.responseText);
            console.log(reponse);
                if(reponse.success) {
                    console.log("Veille passee");
                } else {
                }
    
        }                
    
        xhr.open("POST", '/requeteajaxveille.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(`liengoogle=${lien}&imagegoogle=${image}`); 
        e.preventDefault();



    }


});















/* 
let ajoutVeille = document.getElementById('formveillegoogle');
let lienGoogle = document.getElementById('liengoogle');
let imageGoogle = document.getElementById('imagegoogle');


ajoutVeille.addEventListener ("submit", (e) =>{

//    console.log('evenement', e);
//    e.preventDefault();
//    return

    let lienValue = lienGoogle.value;
    let imageValue = imageGoogle.value;

    let xhr = new XMLHttpRequest();

    xhr.onload = (xhr) => { 

        let reponse = JSON.parse(xhr.target.responseText);
        console.log(reponse);
        if(reponse.success) {
            console.log("Veille passee");
        } else {
        }

    }                

    xhr.open("POST", '/requeteajaxveille.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(`liengoogle=${lienValue}&imagegoogle=${imageValue}`);
    //xhr.responseType = 'json'; 
    e.preventDefault();

})
 */