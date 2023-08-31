import * as modalDisplayMessage from './modalDisplayMessage.js';

// Attend que le contenu de la page soit chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function() {
    // Sélectionne tous les boutons avec la classe "btn-modify"
    let modifyButtons = document.querySelectorAll(".btn-modify");
    // Pour chaque bouton, ajoute un écouteur d'événement au clic
    modifyButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            // Récupère l'identifiant d'image et le lien de données du bouton cliqué
            let pictureId = this.getAttribute("data-image");
            let dataLink = this.getAttribute('data-link');
            // Remplit la valeur d'un champ caché avec l'identifiant d'image
            document.getElementById("pictureId").value = pictureId;

            // Si le lien de données n'est pas vide
            if (dataLink !== null) {
                // Sélectionne l'élément d'aperçu de l'image modifiée
                const editPicturePreview = document.querySelector("#editPicturePreview");
                // Affiche l'élément d'aperçu
                editPicturePreview.style.display = "block";
                // Crée un élément d'image et configure son attribut source
                const imageElement = document.createElement("img");
                imageElement.src = dataLink;
                imageElement.classList.add("img-fluid");
                // Remplace le contenu de l'aperçu par l'image nouvellement créée
                editPicturePreview.innerHTML = "";
                // Ajoute l'image à l'aperçu
                editPicturePreview.appendChild(imageElement);
            }
        });
    });

    // Fonction pour vérifier si le format d'image est valide
    function isImageFormatValid(imageFile) {
        // Liste des formats d'image autorisés
        let allowedFormats = ['jpg', 'jpeg', 'png'];
        // Récupère l'extension du fichier image et la met en minuscules
        let fileExtension = imageFile.name.split('.').pop().toLowerCase();
        // Vérifie si l'extension est dans la liste des formats autorisés
        return allowedFormats.includes(fileExtension);
    }

    // Sélectionne le bouton d'édition
    let editButton = document.querySelector('#edit_button');
    // Si le bouton d'édition existe
    if (editButton) {
        // Ajoute un écouteur d'événement au clic sur le bouton d'édition
        editButton.addEventListener("click", function(event) {
            // Empêche le comportement par défaut du bouton (soumission du formulaire)
            event.preventDefault();
            // Récupère l'identifiant d'image et le fichier image sélectionné
            let pictureId = document.querySelector("#pictureId").value;
            let imageFileInput = document.querySelector('#editPictureForm input[type="file"]');
            let imageFile = imageFileInput.files[0];
            // Récupère l'URL de modification de l'image depuis l'attribut data
            let modifyPathPicture = editButton.getAttribute("data-modify-pathPicture");
            
            // Si un fichier image est sélectionné
            if (imageFile) {
                // Si le format d'image n'est pas valide
                if (!isImageFormatValid(imageFile)) {
                    // Affiche un message d'erreur dans un élément modal
                    modalDisplayMessage.displayErrorMessage('messagesEditPicture', 'Format d\'image non valide. Formats autorisés : JPG, JPEG, PNG');
                    return;
                }

                // Crée un objet FormData pour envoyer l'image et l'identifiant
                let formData = new FormData();
                formData.append("image", imageFile);
                formData.append("pictureId", pictureId);

                // Crée une requête XMLHttpRequest
                let xhr = new XMLHttpRequest();
                // Configure la requête avec la méthode POST et l'URL de modification
                xhr.open("POST", modifyPathPicture, true);
                // Quand la requête aboutit
                xhr.onload = function() {
                    // Affiche un message de succès dans un élément modal
                    modalDisplayMessage.displaySuccessMessage('messagesEditPicture', 'Le formulaire a été soumis avec succès !');
                    // Attend deux secondes, puis recharge la page
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                };
                // Envoie la requête avec les données du formulaire
                xhr.send(formData);
            } else {
                // Si aucun fichier image n'est sélectionné, affiche un message d'erreur
                modalDisplayMessage.displayErrorMessage('messagesEditPicture', 'Veuillez sélectionner une image !');
                return;
            }
        });
    } 

    // Fonction pour vider les champs du formulaire
    function clearFormFields() {
        // Réinitialise la valeur du champ d'édition d'image
        document.getElementById('edit_picture_editPicture').value = '';
    }
    
    // Fonction appelée lorsque la modale d'édition d'image est masquée
    function handleModalHidden() {
        // Efface les messages d'erreur dans un élément modal
        modalDisplayMessage.clearErrorMessage('messagesEditPicture');
        // Réinitialise les champs du formulaire
        clearFormFields(); 
    }

    // Sélectionne la modale d'édition d'image
    let editPictureModal = document.getElementById('editPictureModal');
    // Si la modale existe
    if (editPictureModal) {
        // Ajoute un écouteur d'événement pour détecter la fermeture de la modale
        document.getElementById('editPictureModal').addEventListener('hidden.bs.modal', handleModalHidden);
    }
});


