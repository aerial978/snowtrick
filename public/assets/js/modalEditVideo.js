import * as modalDisplayMessage from './modalDisplayMessage.js';

// Attend que le contenu de la page soit chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function(){
    // Sélectionne tous les boutons avec la classe "btn-modify"
    let modifyButtons = document.querySelectorAll(".btn-modify");
    // Pour chaque bouton, ajoute un écouteur d'événement au clic
    modifyButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            // Récupère l'identifiant et le nom de la vidéo à partir des attributs de données du bouton
            let videoId = this.getAttribute("data-video");
            let videoName = this.getAttribute("data-video-name");
            // Récupère l'URL de base des vidéos à partir des attributs de données du bouton
            const videoBaseUrl = this.getAttribute("data-video-url");
            // Remplit la valeur d'un champ caché avec l'identifiant de la vidéo
            document.getElementById("videoId").value = videoId;
            
            // Si le nom de la vidéo n'est pas vide
            if (videoName !== null) {
                // Crée un élément iframe pour afficher la vidéo
                let iframe = document.createElement("iframe");
                iframe.className = "w-auto";
                iframe.width = "325";
                iframe.height = "205";
                iframe.title = "Lecteur vidéo YouTube";
                iframe.iframeBorder = "0";
                iframe.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
                iframe.allowFullscreen = true;
                // Configure l'URL de la vidéo pour l'iframe
                iframe.src = videoBaseUrl + videoName;
                // Sélectionne le conteneur de prévisualisation de la vidéo
                let videoPreviewContainer = document.getElementById("videoPreviewContainer");
                // Efface le contenu précédent et ajoute l'iframe à la prévisualisation
                videoPreviewContainer.innerHTML = "";
                // Ajoute l'iframe à l'aperçu
                videoPreviewContainer.appendChild(iframe);
            }
        });
    });

    // Fonction pour valider un lien vidéo YouTube
    function validateVideoLink(videoLink) {
        // Expression régulière pour le format du lien vidéo YouTube
        let regex = /^https?:\/\/(?:www\.)?youtube\.com\/watch\?v=[\w\-]+(?:&t=\d+s?)?$/;
        // Vérifie si le lien correspond au format attendu
        return regex.test(videoLink);
    }

    // Sélectionne le bouton d'édition
    let buttonEdit = document.querySelector("#button_edit");
    // Si le bouton d'édition existe
    if(buttonEdit) {
        // Ajoute un écouteur d'événement au clic sur le bouton d'édition
        buttonEdit.addEventListener("click", function(event) {
            // Empêche le comportement par défaut du bouton (soumission du formulaire)
            event.preventDefault();
            // Récupère la valeur du champ de saisie du lien vidéo et la nettoie
            let videoUrlInput = document.querySelector("#video_url");
            let videoUrl = videoUrlInput.value.trim();
            // Récupère l'URL de modification de la vidéo depuis l'attribut de données du bouton
            let modifyUrl = buttonEdit.getAttribute("data-modify-url");
            
            // Si un lien vidéo est saisi
            if (videoUrl) {
                // Si le format du lien n'est pas valide
                if (!validateVideoLink(videoUrl)) {
                    // Affiche un message d'erreur dans un élément modal
                    modalDisplayMessage.displayErrorMessage('messagesEditVideo', 'The format of the YouTube link is incorrect !');
                    return;
                }

                // Crée un objet FormData pour envoyer le lien et l'identifiant de la vidéo
                let formData = new FormData();
                formData.append("video_url", videoUrl);
                let videoId = document.querySelector("#videoId").value;
                formData.append("videoId", videoId);
                
                // Crée une requête XMLHttpRequest
                let xhr = new XMLHttpRequest();
                // Configure la requête avec la méthode POST et l'URL de modification
                xhr.open("POST", modifyUrl, true);
                // Quand la requête aboutit
                xhr.onload = function() {
                    // Affiche un message de succès dans un élément modal
                    modalDisplayMessage.displaySuccessMessage('messagesEditVideo', 'The form has been submitted successfully !');
                    // Attend deux secondes, puis recharge la page
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                };
                // Envoie la requête avec les données du formulaire
                xhr.send(formData);
            } else {
                // Si aucun lien vidéo n'est saisi, affiche un message d'erreur
                modalDisplayMessage.displayErrorMessage('messagesEditVideo', 'Please enter a YouTube link !');
                return;
            }
        });
    }

    // Fonction pour vider les champs du formulaire
    function clearFormFields() {
        // Réinitialise la valeur du champ de saisie du lien vidéo
        document.getElementById('video_url').value = '';
    }

    // Fonction appelée lorsque la modale d'édition de vidéo est masquée
    function handleModalHidden() {
        // Efface les messages d'erreur dans un élément modal
        modalDisplayMessage.clearErrorMessage('messagesEditVideo');
        // Réinitialise les champs du formulaire
        clearFormFields(); 
    }

    // Sélectionne la modale d'édition de vidéo
    let editVideoModal = document.getElementById('editVideoModal');
    // Si la modale existe
    if(editVideoModal) {
        // Ajoute un écouteur d'événement pour détecter la fermeture de la modale
        document.getElementById('editVideoModal').addEventListener('hidden.bs.modal', handleModalHidden);
    }
});
