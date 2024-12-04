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
