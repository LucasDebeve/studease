const insertionsConst=document.querySelector("ul.insertions");
const save=sauvegarderEtat(insertionsConst);
setAddFilterInsertionCallback(insertionsConst);
function createHtmlInsertion(insertion) {
    var liElt = document.createElement("li");
    liElt.className = "insertion";
    liElt.innerHTML = "<a href=\"/insertions-professionnelles/".concat(insertion.id, "\" class=\"\">\n                            <div class=\"insertion__id\" hidden=\"hidden\">").concat(insertion.id, "</div>\n                            <h3 class=\"insertion__titre\">").concat(insertion.titre, "</h3>\n                            <div class=\"\">Dur\xE9e : \n                                <div class=\"insertion__duree\">").concat(insertion.duree, "</div>, D\xE9but: \n                                <div class=\"insertion__dateDeb\">").concat(insertion.dateDeb, "</div>\n                            </div>\n                        </a>");
    return liElt;
}
function extractInsertion(insertionElt) {
    return {
        id: insertionElt.firstElementChild.children[0].lastChild.nodeValue,
        titre: insertionElt.firstElementChild.children[1].lastChild.nodeValue,
        contrat: insertionElt.firstElementChild.children[3].lastChild.nodeValue,
        duree: parseInt(insertionElt.firstElementChild.children[2].children[0].lastChild.nodeValue, 10),
        dateDeb: insertionElt.firstElementChild.children[2].children[1].lastChild.nodeValue,
        query: insertionElt
    };
}
function extractInsertions(insertionsElt) {
    var insertions = Array.from(insertionsElt.children);
    return insertions.map((insertion) =>extractInsertion(insertion));
}
function sauvegarderEtat(element) {
    return {
        parent: element.parentNode,
        nextSibling: element.nextSibling,
        contenu: element.innerHTML,
        // Ajoutez d'autres propriétés à sauvegarder au besoin
    };
}
function setAddFilterInsertionCallback(insertions) {
    const insertionsList = extractInsertions(insertions);
    const intituleInsertion = document.querySelector("input.input.intitule_insertion");
    const typeContrat = document.querySelector("select.input.type_contrat_insertion");
    const dateDebPre = document.querySelector("input.input.date_debut_avant_insertion");
    const dateDebPost = document.querySelector("input.input.date_debut_apres_insertion");
    const duree = document.querySelector("input.input.duree_insertion");

    intituleInsertion.addEventListener("keyup", function () {
        const intitule = document.getElementById("intitule").value.toString().toUpperCase();
        insertionsList.forEach(function (insertion) {
            if (!insertion['titre'].toUpperCase().includes(intitule)) {
                if(insertions.contains(insertion['query'])) {
                    insertions.removeChild(insertion['query']);
                }
            } else {
                if (!insertions.contains(insertion['query'])) {
                    insertions.appendChild(insertion['query']);
                }
            }
        });
    });

    typeContrat.addEventListener("change", function () {
        const contrat = typeContrat.options[typeContrat.selectedIndex].value;
        insertionsList.forEach(function (insertion) {
            if (contrat === "") {
                if (!insertions.contains(insertion['query'])) {
                    insertions.appendChild(insertion['query']);
                }
            } else if(contrat === "stage") {
                if (!insertion['contrat'].toUpperCase().includes("1")) {
                    if(insertions.contains(insertion['query'])) {
                        insertions.removeChild(insertion['query']);
                    }
                } else {
                    if (!insertions.contains(insertion['query'])) {
                        insertions.appendChild(insertion['query']);
                    }
                }
            } else{
                if (!insertion['contrat'].toUpperCase().includes("2")) {
                    if(insertions.contains(insertion['query'])) {
                        insertions.removeChild(insertion['query']);
                    }
                } else {
                    if (!insertions.contains(insertion['query'])) {
                        insertions.appendChild(insertion['query']);
                    }
                }
            }
        });
    });

    // ne fonctionne pas pour le moment
    dateDebPre.addEventListener("change",()=>{
        const dateDebBef= new Date(document.getElementById("date_debut_avant").value);
        const dateDebAft = new Date(document.getElementById("date_debut_apres").value);
        dateDebAft.setHours(0,0,0,0);
        dateDebBef.setHours(0,0,0,0);
        insertionsList.forEach(function (insertion) {
            let dateDeb= new Date(insertion.dateDeb);
            dateDeb.setHours(0,0,0,0);
            if(dateDebBef <= dateDeb <= dateDebAft){
                if (!insertions.contains(insertion['query'])) {
                    insertions.appendChild(insertion['query']);
                }
            }
            else{
                if (insertions.contains(insertion['query'])) {
                    insertions.removeChild(insertion['query']);
                }
            }
        });
    });

    // ne fonctionne pas pour le moment
    dateDebPost.addEventListener("change",()=>{
        const dateDebBef= new Date(document.getElementById("date_debut_avant").value);
        const dateDebAft = new Date(document.getElementById("date_debut_apres").value);
        dateDebAft.setHours(0,0,0,0);
        dateDebBef.setHours(0,0,0,0);
        insertionsList.forEach(function (insertion) {
            let dateDeb= new Date(insertion.dateDeb);
            dateDeb.setHours(0,0,0,0);
            if(dateDebBef <= dateDeb <= dateDebAft){
                if (!insertions.contains(insertion['query'])) {
                    insertions.appendChild(insertion['query']);
                }
            }
            else{
                if (insertions.contains(insertion['query'])) {
                    insertions.removeChild(insertion['query']);
                }
            }
        });
    });

    duree.addEventListener("keyup", ()=>{
        const dureeInsertion = parseInt(document.getElementById("duree").value,10);
        insertionsList.forEach(function (insertion) {
            if(insertion.duree === dureeInsertion){
                if (!insertions.contains(insertion['query'])) {
                    insertions.appendChild(insertion['query']);
                }
            } else{
                if (insertions.contains(insertion['query'])) {
                    insertions.removeChild(insertion['query']);
                }
            }
            if(!dureeInsertion){
                if (!insertions.contains(insertion['query'])) {
                    insertions.appendChild(insertion['query']);
                }
            }
        });
    });

    duree.addEventListener("change", ()=>{
        const dureeInsertion = parseInt(document.getElementById("duree").value,10);
        insertionsList.forEach(function (insertion) {
            if(insertion.duree === dureeInsertion){
                if (!insertions.contains(insertion['query'])) {
                    insertions.appendChild(insertion['query']);
                }
            } else{
                if (insertions.contains(insertion['query'])) {
                    insertions.removeChild(insertion['query']);
                }
            }
            if(!dureeInsertion){
                if (!insertions.contains(insertion['query'])) {
                    insertions.appendChild(insertion['query']);
                }
            }
        });
    });
}