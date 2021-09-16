let ajoutVeilleYt = document.getElementById('formveilleyoutube');
let lienYoutube = document.getElementById('lienyoutube');
let imageYoutube = document.getElementById('imageyoutube');

ajoutVeilleYt.addEventListener ("submit", (e) =>{

    console.log('style');
    let lienValue = lienYoutube.value;
    let imageValue = imageYoutube.value;

    let xhr = new XMLHttpRequest();

    xhr.onload = (xhr) => { 

        let reponse = JSON.parse(xhr.target.responseText);
        console.log(reponse);
        if(reponse.success) {
            console.log("Veille youtube passee");
        } else {
        }

    }                

    xhr.open("POST", '/requeteajaxveilleyt.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(`lienyoutube=${lienValue}&imageyoutube=${imageValue}`);
    //xhr.responseType = 'json'; */
    e.preventDefault();

})
