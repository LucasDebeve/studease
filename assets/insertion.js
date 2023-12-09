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
    var insertionsList=extractInsertions(insertions);
    var intituleInsertion = document.querySelector("input.input.intitule_insertion");
    intituleInsertion.addEventListener("change", function () {
        var intitule = document.getElementById("intitule").value.toString().toUpperCase();
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
}