// Attend que le contenu de la page soit chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function () {
    // Sélectionne tous les éléments avec la classe "img-thumbnail"
    let thumbnailElements = document.querySelectorAll('.img-thumbnail');
    // Pour chaque élément, ajoute un écouteur d'événement au clic
    thumbnailElements.forEach(function (thumbnailElement) {
        thumbnailElement.addEventListener('click', function () {
            // Récupère le lien de données de l'élément cliqué
            let dataLink = this.getAttribute('data-link');
            console.log(dataLink);

            // Si le lien de données n'est pas vide
            if (dataLink !== null) {
                // Sélectionne l'élément d'aperçu d'image
                const picturePreview = document.querySelector("#picturePreview");
                // Affiche l'élément d'aperçu
                picturePreview.style.display = "block";
                // Crée un élément image et configure son attribut source
                const imageElement = document.createElement("img");
				// Charge l'image à partir du lien de données
                imageElement.src = dataLink;
                console.log(imageElement.src);
                imageElement.classList.add("img-fluid");
                // Remplace le contenu de l'aperçu par l'image nouvellement créée
                picturePreview.innerHTML = "";
				// Ajoute l'image à l'aperçu
                picturePreview.appendChild(imageElement);
            }
        });
    });
});
