

function checkPassword() {
    var result = false;
    if (document.getElementById("mdp").value == document.getElementById("mdp2").value) {
        var result = true;
        document.getElementById("btn").disabled = false;
        document.getElementById("div_mdp").hidden = true;
    }
    else {
        document.getElementById("btn").disabled = true;
        document.getElementById("div_mdp").hidden = false;
        document.getElementById("text_mdp").innerHTML;
    }
}




function derouleDiv(idDiv) {
    if (document.getElementById(idDiv).hidden == true) {

        document.getElementById(idDiv).hidden = false;
        window.location.href = "ajouter_ecole.php#" + idDiv;
    }
    else {
        document.getElementById(idDiv).hidden = true;
    }

}


