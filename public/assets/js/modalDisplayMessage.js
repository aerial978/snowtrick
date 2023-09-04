export function displayErrorMessage(elementId, message) {
    let errorMessageHTML = '<div class="alert alert-danger">' + message + '</div>';
    document.getElementById(elementId).innerHTML = errorMessageHTML;
    document.getElementById(elementId).style.display = 'block';
}

export function displaySuccessMessage(elementId,message) {
    let successMessageHTML = '<div class="alert alert-success">' + message + '</div>';
    document.getElementById(elementId).innerHTML = successMessageHTML;
    document.getElementById(elementId).style.display = 'block';
}

export function clearErrorMessage(elementId) {
    document.getElementById(elementId).innerHTML = '';
}

