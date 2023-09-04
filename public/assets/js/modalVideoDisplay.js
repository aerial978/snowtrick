// Attend que le contenu de la page soit chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function() {
    // Sélectionne tous les éléments avec la classe "video-item"
    let videoElements = document.querySelectorAll('.video-item');
    // Pour chaque élément, ajoute un écouteur d'événement au clic
    videoElements.forEach(function(videoElement) {
        videoElement.addEventListener('click', function() {
            // Récupère le lien de données de l'élément cliqué
            let dataLink = this.getAttribute('data-link');
            
            // Si le lien de données n'est pas vide
            if (dataLink !== null) {
                // Crée un élément iframe pour afficher la vidéo
                let iframe = document.createElement("iframe");
                iframe.className = "w-auto";
                iframe.width = "325";
                iframe.height = "205";
                iframe.title = "Lecteur vidéo YouTube";
                iframe.iframeBorder = "0";
                iframe.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
                iframe.allowFullscreen = true;
                // Configure l'URL de la vidéo YouTube à partir du lien de données
                iframe.src = 'https://www.youtube.com/embed/' + dataLink;
                // Sélectionne le conteneur de prévisualisation de la vidéo
                let videoPreviewContainer = document.getElementById("displayVideoPreview");
                // Efface le contenu précédent et ajoute l'iframe à la prévisualisation
                videoPreviewContainer.innerHTML = "";
                // Ajoute l'iframe à l'aperçu
                videoPreviewContainer.appendChild(iframe);
            }
        });
    });
});
