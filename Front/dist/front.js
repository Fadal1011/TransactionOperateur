"use strict";
let Fournisseur = document.getElementById('Fournisseur');
let Transaction = document.getElementById('Transaction');
let fournisseur = ['Orange Money', "wave", "wari", 'CB'];
let transaction = ['avec code', 'sans code', 'immediate', 'permenant'];
function chargerSelect(element, tab) {
    if (!element) {
        console.error("Élément HTML introuvable.");
        return;
    }
    tab.forEach((e) => {
        let option = document.createElement('option');
        option.textContent = e;
        option.value = e;
        element.appendChild(option);
    });
}
chargerSelect(Fournisseur, fournisseur);
chargerSelect(Transaction, transaction);
