let Fournisseur: HTMLElement | null = document.getElementById('Fournisseur');
let Transaction:HTMLElement | null = document.getElementById('Transaction');


let fournisseur:string[] =['Orange Money',"wave","wari",'CB'];
let transaction:string[]=['avec code','sans code','immediate','permenant']



function chargerSelect(element: HTMLElement | null, tab: string[]) {
    if (!element) {
      console.error("Élément HTML introuvable.");
      return;
    }
  
    tab.forEach((e) => {
      let option = document.createElement('option');
      option.textContent = e;
      option.value = e
      element.appendChild(option);
    });
}
  

chargerSelect(Fournisseur,fournisseur)
chargerSelect(Transaction,transaction)