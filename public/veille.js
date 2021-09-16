let ajoutVeille = document.getElementById('formveillegoogle');
let lienGoogle = document.getElementById('liengoogle');
let imageGoogle = document.getElementById('imagegoogle');


ajoutVeille.addEventListener ("submit", (e) =>{

    console.log('beaugosse');
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
    //xhr.responseType = 'json'; */
    e.preventDefault();

})
