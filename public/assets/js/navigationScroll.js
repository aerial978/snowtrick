// Sélectionne l'élément de navigation à partir de son sélecteur CSS
let nav = document.querySelector('nav');
// Ajout d'un écouteur d'événement pour la fenêtre qui se déclenchera lors du défilement
window.addEventListener('scroll', function () {
  // Vérifie si la position de défilement verticale est supérieure à 100 pixels
  if (window.scrollY > 100) {
    // Si la position de défilement est supérieure à 100 pixels, ajoute les classes CSS pour le style souhaité
    nav.classList.add('bg-dark', 'shadow');
  } else {
    // Si la position de défilement est inférieure ou égale à 100 pixels, supprime les classes CSS pour réinitialiser le style
    nav.classList.remove('bg-dark', 'shadow');
  }
});