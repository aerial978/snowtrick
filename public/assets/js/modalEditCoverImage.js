import * as modalDisplayMessage from './modalDisplayMessage.js';

// Ecouteur d'événements attendant que le DOM soit entièrement chargé avant d'exécuter la fonction incluse.
document.addEventListener('DOMContentLoaded', function () {

    // Sélectionne tous les éléments avec la classe 'btn-modify' et stockez-les dans la variable 'modifyButtons', qui ressemble à un NodeList.
    let modifyButtons = document.querySelectorAll('.btn-modify');
    
    // Parcourt chaque élément dans la variable 'modifyButtons'.
    modifyButtons.forEach(function (button) {
        // Ajoute un écouteur d'événements au clic pour chaque bouton de modification.
        button.addEventListener('click', function () {
            // Obtient la valeur de l'attribut 'data-cover-image' du bouton cliqué.
            let coverImage = this.getAttribute('data-cover-image');
            // Obtient la valeur de l'attribut 'data-trick-id' du bouton cliqué.
            let trickId = this.getAttribute("data-trick-id");
            // Définit la valeur d'un élément avec l'ID 'coverImage' sur 'coverImage'.
            document.getElementById("coverImage").value = coverImage;
            // Définit la valeur d'un élément avec l'ID 'trickId' sur 'trickId'.
            document.getElementById("trickId").value = trickId;
        });
    });

    // Définit une fonction pour vérifier si le format de fichier de l'image de couverture est valide.
    function isImageFormatValid(coverFile) {
        // Liste des formats d'image autorisés.
        let allowedFormats = ['jpg', 'jpeg', 'png'];
        // Obtient l'extension de fichier du 'coverFile'.
        let fileExtension = coverFile.name.split('.').pop().toLowerCase();
        // Vérifie si l'extension de fichier est incluse dans le tableau 'allowedFormats'.
        return allowedFormats.includes(fileExtension);
    }

    // Sélectionne l'élément avec l'ID 'cover_button'.
    let coverButton = document.querySelector('#cover_button');
    // Vérifie si 'coverButton' existe.
    if (coverButton) {
        // Ajoute un écouteur d'événements au clic pour le bouton 'coverButton'.
        coverButton.addEventListener("click", function (event) {
            // Empêche le comportement de soumission par défaut du formulaire.
            event.preventDefault();
            // Sélectionne l'élément d'entrée de fichier dans le formulaire.
            let coverInput = document.querySelector('#editCoverForm input[type="file"]');
            // Sélectionne la valeur de l'élément 'trickId'.
            let trickId = document.querySelector("#trickId").value;
            // Sélectionne le fichier de couverture sélectionné.
            let coverFile = coverInput.files[0];
            // Sélectionne la valeur de l'attribut 'data-modify-pathCover' de 'coverButton'.
            let modifyPathCover = coverButton.getAttribute("data-modify-pathCover");

            // Vérifie si un fichier de couverture a été sélectionné.
            if (coverFile) {
                // Vérifie si le format du fichier de couverture sélectionné est valide.
                if (!isImageFormatValid(coverFile)) {
                    // Affiche un message d'erreur si le format est invalide.
                    modalDisplayMessage.displayErrorMessage('messagesEditCover', 'Invalid image format. Authorized formats: JPG, JPEG, PNG');
                    return;
                }

                // Crée un nouvel objet FormData pour contenir le fichier de couverture et les données associées.
                let formData = new FormData();
                formData.append('cover', coverFile);
                formData.append('coverImage', coverFile.name);
                formData.append('trickId', trickId);

                // Crée un nouvel objet XMLHttpRequest.
                let xhr = new XMLHttpRequest();
                // Configure la requête.
                xhr.open("POST", modifyPathCover, true);
                // Définisse la fonction à exécuter lorsque la requête est terminée.
                xhr.onload = function () {
                    // Affiche un message de succès.
                    modalDisplayMessage.displaySuccessMessage('messagesEditCover', 'The form has been submitted successfully !');
                    // Recharge la page après un délai.
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                };
                // Envoie FormData dans la requête.
                xhr.send(formData);
            } else {
                // Affiche un message d'erreur si aucun fichier de couverture n'a été sélectionné.
                modalDisplayMessage.displayErrorMessage('messagesEditCover', 'Please select an image !');
                return;
            }
        });
    }

    // Définit une fonction pour effacer les champs du formulaire.
    function clearFormFields() {
        // Efface la valeur de l'élément avec l'ID 'cover_image_coverImage'.
        document.getElementById('cover_image_coverImage').value = '';
    }

    // Définit une fonction pour gérer lorsque la modal est masquée.
    function handleModalHidden() {
        // Efface les messages d'erreur affichés dans la modal.
        modalDisplayMessage.clearErrorMessage('messagesEditCover');
        // Efface les champs du formulaire.
        clearFormFields();
    }

    // Sélectionne l'élément avec l'ID 'editPictureModal'.
    let editPictureModal = document.getElementById('editCoverImageModal');
    // Vérifie si 'editPictureModal' existe.
    if (editPictureModal) {
        // Ajoute un écouteur d'événements pour lorsque la modal Bootstrap est masquée.
        document.getElementById('editCoverImageModal').addEventListener('hidden.bs.modal', handleModalHidden);
    }
});
