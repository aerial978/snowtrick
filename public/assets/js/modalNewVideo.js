import * as modalDisplayMessage from './modalDisplayMessage.js';

// Attend que le contenu de la page soit chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function(){
    // Fonction pour valider un lien vidéo YouTube
    function validateVideoLink(videoLink) {
        // Expression régulière pour le format du lien vidéo YouTube
        let regex = /^https?:\/\/(?:www\.)?youtube\.com\/watch\?v=[\w\-]+(?:&t=\d+s?)?$/;
        // Vérifie si le lien correspond au format attendu
        return regex.test(videoLink);
    }
    
    // Fonction pour soumettre le formulaire
    function submitForm(event) {
        event.preventDefault();
        // Récupère le formulaire et le lien de la nouvelle vidéo
        let form = document.getElementById('videoForm');
        let videoLink = document.getElementById('video_newVideoLink').value;
        
        // Si le lien vidéo est vide
        if (!videoLink) {
            // Affiche un message d'erreur dans un élément modal
            modalDisplayMessage.displayErrorMessage('messagesNewVideo', 'Please enter a YouTube link !');
            return;
        }
        
        // Si le format du lien vidéo n'est pas valide
        if (!validateVideoLink(videoLink)) {
            // Affiche un message d'erreur dans un élément modal
            modalDisplayMessage.displayErrorMessage('messagesNewVideo', 'The format of the YouTube link is incorrect !');
            return;
        }

        // Crée un objet FormData avec les données du formulaire
        let formData = new FormData(form);
        // Crée une requête XMLHttpRequest
        let xhr = new XMLHttpRequest();
        // Configure la requête avec la méthode et l'action du formulaire
        xhr.open(form.method, form.action, true);
        // Quand la requête aboutit
        xhr.onload = function () {
            // Affiche un message de succès dans un élément modal
            modalDisplayMessage.displaySuccessMessage('messagesNewVideo','The form has been submitted successfully !');
            // Attend deux secondes, puis recharge la page
            setTimeout(function () {
                location.reload();
            }, 2000);  
        };
        // Envoie la requête avec les données du formulaire
        xhr.send(formData);
    }
    
    // Fonction pour vider les champs du formulaire
    function clearFormFields() {
        // Réinitialise la valeur du champ de saisie du lien de la nouvelle vidéo
        document.getElementById('video_newVideoLink').value = '';
    }
    
    // Fonction appelée lorsque la modale de nouvelle vidéo est masquée
    function handleModalHidden() {
        // Efface les messages d'erreur dans un élément modal
        modalDisplayMessage.clearErrorMessage('messagesNewVideo');
        // Réinitialise les champs du formulaire
        clearFormFields(); 
    }

    // Sélectionne la modale de nouvelle vidéo
    let newVideoModal = document.getElementById('newVideoModal');
    // Si la modale existe
    if (newVideoModal) {
        // Ajoute un écouteur d'événement pour détecter la fermeture de la modale
        document.getElementById('newVideoModal').addEventListener('hidden.bs.modal', handleModalHidden);
        // Ajoute un écouteur d'événement pour soumettre le formulaire
        document.getElementById('videoForm').addEventListener('submit', submitForm);
    }
});
