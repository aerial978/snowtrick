// Attend que le contenu de la page soit chargé
document.addEventListener("DOMContentLoaded", function() {
    // Sélectionne le bouton "Add more" par son identifiant
    let addMoreBtn = document.getElementById("addmorebtn");
    // Sélectionne la première ligne de vidéo
    let firstVideoRow = document.querySelector(".duplicate-row");
    if(firstVideoRow) {
        // Sélectionne le bouton "Remove" de la première ligne
        let firstRemoveBtn = firstVideoRow.querySelector(".btn-remove");
        // Cache le bouton "Remove" sur la première ligne initialement
        firstRemoveBtn.style.display = "none";

        // Ajoute un écouteur d'événement au clic sur le bouton "Add more"
        addMoreBtn.addEventListener("click", function() {
            // Sélectionne l'élément contenant les types de vidéo
            let inputVideoType = document.querySelector(".input-video-type");  
            // Sélectionne toutes les lignes dupliquées actuelles
            let duplicateRows = inputVideoType.querySelectorAll(".duplicate-row");
            // Sélectionne la première ligne dupliquée
            let firstDuplicateRow = duplicateRows[0];
            // Clone la première ligne dupliquée avec tous ses éléments enfants
            let newDuplicateRow = firstDuplicateRow.cloneNode(true);
            // Rend le bouton "Remove" visible sur la nouvelle ligne
            let newRemoveBtn = newDuplicateRow.querySelector(".btn-remove");
            // Rend le bouton "Remove" visible sur la nouvelle ligne
            newRemoveBtn.style.display = "block";
            // Ajoute la nouvelle ligne dupliquée à l'élément contenant les types de vidéo
            inputVideoType.appendChild(newDuplicateRow);
            // Efface le contenu du champ de saisie dans la nouvelle ligne dupliquée
            newDuplicateRow.querySelector("input").value = "";
            // Attache un écouteur de bouton "Remove" à la nouvelle ligne dupliquée
            attachRemoveButtonListener(newDuplicateRow);
        });
        // Fonction pour attacher un écouteur au bouton "Remove" d'une ligne
        function attachRemoveButtonListener(row) {
            // Sélectionne le bouton "Remove" dans la ligne donnée
            let removeBtn = row.querySelector(".btn-remove");
            // Ajoute un écouteur d'événement au clic sur le bouton "Remove"
            removeBtn.addEventListener("click", function() {
                // Trouve l'élément parent de la ligne dupliquée avec la classe "inputVideoType"
                let inputVideoType = row.closest(".input-video-type");
                // Vérifie s'il y a plus d'une ligne dupliquée présente
                if (inputVideoType.querySelectorAll(".duplicate-row").length > 1) {
                    // Supprime la ligne donnée de l'élément contenant les types de vidéo
                    inputVideoType.removeChild(row);
                }
            });
        }
    }
});