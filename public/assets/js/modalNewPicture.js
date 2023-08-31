import * as modalDisplayMessage from './modalDisplayMessage.js';

// Attend que le contenu de la page soit chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function(){
    // Fonction pour vérifier si le format de l'image est valide
    function isImageFormatValid(link) {
        // Formats d'image autorisés
        let allowedFormats = ['jpg', 'jpeg', 'png'];
        // Récupère l'extension du fichier image et la met en minuscules
        let fileExtension = link.split('.').pop().toLowerCase();
        // Vérifie si l'extension est dans la liste des formats autorisés
        return allowedFormats.includes(fileExtension);
    }

    // Fonction pour soumettre le formulaire
    function submitForm(event) {
        event.preventDefault();
        // Récupère le formulaire et le lien de la nouvelle image
        let form = document.getElementById('pictureForm');
        let pictureLink = document.getElementById('picture_newPictureLink').value;

        // Si le lien d'image est vide
        if (!pictureLink) {
            // Affiche un message d'erreur dans un élément modal
            modalDisplayMessage.displayErrorMessage('messagesNewPicture', 'Veuillez entrer une image !');
            event.preventDefault();
            return;
        }

        // Si le format d'image n'est pas valide
        if (!isImageFormatValid(pictureLink)) {
            // Affiche un message d'erreur dans un élément modal
            modalDisplayMessage.displayErrorMessage('messagesNewPicture', 'Format d\'image non valide. Formats autorisés : JPG, JPEG, PNG');
            event.preventDefault();
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
            modalDisplayMessage.displaySuccessMessage('messagesNewPicture', 'Le formulaire a été soumis avec succès !');
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
        // Réinitialise la valeur du champ de saisie du lien d'image
        document.getElementById('picture_newPictureLink').value = '';
    }
   
    // Fonction appelée lorsque la modale de nouvelle image est masquée
    function handleModalHidden() {
        // Efface les messages d'erreur dans un élément modal
        modalDisplayMessage.clearErrorMessage('messagesNewPicture');
        // Réinitialise les champs du formulaire
        clearFormFields(); 
    }
    
    // Sélectionne la modale de nouvelle image
    let newPictureModal = document.getElementById('newPictureModal');
    // Si la modale existe
    if (newPictureModal) {
        // Ajoute un écouteur d'événement pour détecter la fermeture de la modale
        document.getElementById('newPictureModal').addEventListener('hidden.bs.modal', handleModalHidden);
        // Ajoute un écouteur d'événement pour soumettre le formulaire
        document.getElementById('pictureForm').addEventListener('submit', submitForm);
    }
});
