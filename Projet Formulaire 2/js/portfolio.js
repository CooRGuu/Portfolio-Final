// Fonction pour activer l'onglet et afficher la section correspondante
function showTab(tabName) {
    // Cacher toutes les sections
    const sections = document.querySelectorAll('.tab-section');  // Sélectionne toutes les sections avec la classe 'tab-section'
    sections.forEach(section => {
        section.classList.remove('active');  // Supprime la classe 'active' de chaque section, en les cachant
    });

    // Retirer la classe active de tous les boutons d'onglet
    const buttons = document.querySelectorAll('.tab-button');  // Sélectionne tous les boutons des onglets avec la classe 'tab-button'
    buttons.forEach(button => {
        button.classList.remove('active');  // Supprime la classe 'active' de chaque bouton d'onglet, les désactivant
    });

    // Afficher la section correspondant à l'onglet sélectionné
    document.getElementById(tabName).classList.add('active');  // Ajoute la classe 'active' à la section correspondant à l'onglet sélectionné, pour l'afficher

    // Ajouter la classe active au bouton de l'onglet sélectionné
    const activeButton = document.querySelector(`[data-tab="${tabName}"]`);  // Sélectionne le bouton de l'onglet qui a l'attribut 'data-tab' correspondant au nom de l'onglet
    activeButton.classList.add('active');  // Ajoute la classe 'active' à ce bouton, pour le marquer comme sélectionné
}

// Écouter le clic sur les boutons des onglets pour afficher les bonnes sections
document.querySelectorAll('.tab-button').forEach(button => {  // Sélectionne tous les boutons des onglets
    button.addEventListener('click', function() {  // Ajoute un écouteur d'événements pour chaque bouton
        const tabName = this.getAttribute('data-tab');  // Récupère le nom de l'onglet à partir de l'attribut 'data-tab' du bouton
        showTab(tabName);  // Appelle la fonction 'showTab' avec le nom de l'onglet sélectionné pour afficher la bonne section
    });
});

// Afficher la section "À propos" par défaut au chargement de la page
document.addEventListener('DOMContentLoaded', function() {  // Attendre que le DOM soit entièrement chargé
    showTab('about');  // Appelle la fonction 'showTab' avec 'about' pour afficher la section "À propos" par défaut
});

// Ajouter un écouteur pour le formulaire de contact
document.getElementById('contact-form').addEventListener('submit', function(event) {  // Ajoute un écouteur d'événements pour la soumission du formulaire de contact
    event.preventDefault();  // Empêche l'envoi du formulaire pour gérer l'envoi par JavaScript

    let name = document.getElementById('name').value;  // Récupère la valeur du champ 'name' du formulaire
    let email = document.getElementById('email').value;  // Récupère la valeur du champ 'email' du formulaire
    let message = document.getElementById('message').value;  // Récupère la valeur du champ 'message' du formulaire

    // Vérifier si tous les champs sont remplis
    if (name && email && message) {  // Si le nom, l'email et le message ne sont pas vides
        document.getElementById('form-feedback').textContent = 'Merci pour votre message, ' + name + '! Je vous répondrai bientôt.';  // Affiche un message de remerciement
    } else {  // Si un ou plusieurs champs sont vides
        document.getElementById('form-feedback').textContent = 'Veuillez remplir tous les champs.';  // Affiche un message demandant de remplir tous les champs
        document.getElementById('form-feedback').style.color = 'red';  // Change la couleur du texte du message en rouge
    }
});

// document.addEventListener('DOMContentLoaded', function () {
//     const userButton = document.querySelector('.user-button');
//     const dropdownMenu = document.querySelector('.dropdown-menu');

//     // Ajouter un écouteur d'événement pour afficher/masquer le menu
//     userButton.addEventListener('click', function (e) {
//         e.stopPropagation(); // Empêche la propagation pour éviter de fermer immédiatement le menu
//         dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
//     });

//     // Fermer le menu si on clique ailleurs
//     document.addEventListener('click', function () {
//         dropdownMenu.style.display = 'none';
//     });
// });

async function fetchLatestBreaches() {
    try {
        // Afficher un message de chargement
        const breachesList = document.getElementById('breaches-list');
        breachesList.innerHTML = '<p>Chargement des violations...</p>';

        // Appel à l'API Have I Been Pwned pour récupérer les violations récentes
        const response = await fetch('https://haveibeenpwned.com/api/v3/latestbreach', {
            method: 'GET',
            headers: {
                'User-Agent': 'Mozilla/5.0', // Nécessaire pour éviter les restrictions CORS
            }
        });

        // Vérifier si la réponse est correcte
        if (!response.ok) {
            console.error('Erreur HTTP:', response.status);
            throw new Error('Erreur lors de la récupération des données');
        }

        // Convertir la réponse en JSON
        const breaches = await response.json();

        // Log des données reçues pour vérifier leur structure
        console.log('Données reçues:', breaches);

        // Vérifier si des violations ont été trouvées
        if (breaches) {
            breachesList.innerHTML = ''; // Vider le texte de chargement

            // Afficher les violations (uniquement une ici)
            const breach = breaches; // On suppose qu'il n'y a qu'une seule violation dans ce cas
            const breachElement = document.createElement('div');
            breachElement.classList.add('breach-item');
            breachElement.innerHTML = `
                <h3>${breach.Title}</h3>
                <p><strong>Site : </strong>${breach.Domain}</p>
                <p><strong>Date de la violation : </strong>${breach.BreachDate}</p>
                <p><strong>Description : </strong>${breach.Description}</p>
                <p><strong>Nombre de comptes affectés : </strong>${breach.PwnCount}</p>
                <img src="${breach.LogoPath}" alt="${breach.Name}" />
                <hr>
            `;
            breachesList.appendChild(breachElement);
        } else {
            breachesList.innerHTML = '<p>Aucune violation récente.</p>';
        }
    } catch (error) {
        console.error('Erreur:', error);  // Affiche l'erreur dans la console si elle se produit
        const breachesList = document.getElementById('breaches-list');
        breachesList.innerHTML = '<p>Une erreur est survenue lors de la récupération des données.</p>';
    }
}

// Ajouter l'événement de clic au bouton pour récupérer les données
document.getElementById('fetch-breaches-btn').addEventListener('click', fetchLatestBreaches);

