document.addEventListener("DOMContentLoaded", function () {
    const btnMore = document.getElementById("btn-more");
    const btnScrollUp = document.getElementById("scroll-up");
    const cards = document.querySelectorAll(".card");
    const initialCardCount = 9; // Nombre initial de cartes à afficher
    const cardsPerLoad = 3; // Nombre de cartes à charger à chaque clic sur "More"
    let currentCardCount = initialCardCount;

    // Cache les cartes au-delà du nombre initial
    for (let i = initialCardCount; i < cards.length; i++) {
        cards[i].style.display = "none";
    }

    // Cache le bouton "More" si moins de 15 cartes
    if (cards.length <= initialCardCount) {
        if (btnMore) {
        btnMore.style.display = "none";
        }
    }

    if(btnMore) {
        // Gére le clic sur le bouton "More"
        btnMore.addEventListener("click", function () {
            for (let i = currentCardCount; i < currentCardCount + cardsPerLoad; i++) {
                if (cards[i]) {
                    cards[i].style.display = "block";
                }
            }

            currentCardCount += cardsPerLoad;

            // Affiche le bouton "scroll-up" lorsque plus de 15 cartes sont affichées
            if (currentCardCount > 15) {
                btnScrollUp.style.display = "block"; // Afficher le bouton "scroll-up"
            }

            // Cache le bouton "More" si toutes les cartes ont été affichées
            if (currentCardCount >= cards.length) {
                if (btnMore) {
                btnMore.style.display = "none";
                }
            }
        });
    }

    if(btnScrollUp) {
        // Gére le clic sur le bouton "scroll-up"
        btnScrollUp.addEventListener("click", function () {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    }
});




  
  