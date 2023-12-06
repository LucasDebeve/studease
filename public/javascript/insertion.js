

export function createHtmlInsertion(insertion) {
    const liElt = document.createElement("li");
    liElt.className = "insertion";
    liElt.innerHTML = `<a href="/insertions-professionnelles/${insertion.id}" class="">
                            <div class="insertion__id" hidden="hidden">${insertion.id}</div>
                            <h3 class="insertion__titre">${insertion.titre}</h3>
                            <div class="">Durée : 
                                <div class="insertion__duree">${insertion.duree}</div>, Début: 
                                <div class="insertion__dateDeb">${insertion.dateDeb}</div>
                            </div>
                        </a>`;
    return liElt;
}

export function setAddInserstionEltCallback(addInsertionElt, insertionsElt, infoElt) {
    addInsertionElt.addEventListener("click", () => {
        const InsertionElt = createHtmlInsertion(Math.floor(Math.random() * 20 + 12));
        insertionsElt.appendChild(insertionElt);
        // eslint-disable-next-line no-use-before-define
        setUserEltCallbacks(insertionElt, insertionsElt, infoElt);
        updateUserClassName(insertionElt)
        if (typeof infoElt !== "undefined") {
            // eslint-disable-next-line no-use-before-define
            updateAgeAverage(insertionsElt, infoElt);
        }
        return insertionsElt;
    });
}

export function extractInsertion(insertionElt) {
    return {
        id: insertionElt.querySelector(".insertion__id"),
        titre: insertionElt.querySelector(".insertion__name").value,
        duree: parseInt(insertionElt.querySelector(".insertion__age").value, 10),
        dateDeb: insertionElt.querySelector(".insertion__dateDeb"),
    };
}

export function extractInsertions(insertionsElt) {
    const insertions = Array.from(insertionsElt.querySelectorAll("li.insertion"));
    return insertions.map((user) => extractInsertion(insertions));
}

export function setAddFilterInsertionCallback(){

}