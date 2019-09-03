input = document.getElementById("couleur_complete_nomCouleurComplete");
couleur = document.getElementById('couleur_complete_couleur');
teinteDiv = document.getElementById('teinte');
teinteInput = document.getElementById('couleur_complete_teinte');
teinteDiv.style.display='none';

couleur.addEventListener("input", function(){
    input.style.color="red";
    let val = couleur.value;
    input.value = val;
    teinteDiv.style.display='block';
    teinteInput.innerHTML = '';
    ajaxGet('http://localhost:8888/data/'+val,function(reponse){
        let reps = JSON.parse(reponse);
        reps.forEach(function(rep){
            console.log(rep);
            console.log(typeof rep);
            let option = document.createElement('option');
            option.textContent = rep;
            teinteInput.appendChild(option);
        });
    });
});


function ajaxGet(url, callback) {
    var req = new XMLHttpRequest();
    req.open("GET", url);
    req.addEventListener("load", function () {
        if (req.status >= 200 && req.status < 400) {
            // Appelle la fonction callback en lui passant la réponse de la requête
            callback(req.responseText);
        } else {
            console.error(req.status + " " + req.statusText + " " + url);
            callback (false);
        }
    });
    req.addEventListener("error", function () {
        console.error("Erreur réseau avec l'URL " + url);
        callback (false);
    });
    req.send(null);
}