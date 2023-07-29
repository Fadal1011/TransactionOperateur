const listeClientUrl:string = "http://127.0.0.1:8000/api/client";
const depot ='http://127.0.0.1:8000/api/transactions';



let Fournisseur: HTMLInputElement | null = document.getElementById('Fournisseur') as HTMLInputElement;
let Transaction:HTMLInputElement| null = document.getElementById('Transaction') as HTMLInputElement;

let telExpediteur: HTMLInputElement | null = document.getElementById('telExpediteur') as HTMLInputElement;
let nomCompletExpediteur: HTMLInputElement |null = document.getElementById('nomCompletExpediteur') as HTMLInputElement;
let teldestinataire:HTMLInputElement | null = document.getElementById('teldestinataire') as HTMLInputElement;
let nomCompletdestinataire:HTMLInputElement | null = document.getElementById('nomCompletdestinataire') as HTMLInputElement;
let Montant:HTMLInputElement | null = document.getElementById('Montant') as HTMLInputElement;
let valider:HTMLElement | null = document.getElementById('valider');
let ilChangeParRetrait:HTMLElement | null = document.querySelector('.ilChangeParRetrait');
let couleurEnfonctiondufourn:HTMLElement | null = document.querySelector('.couleurEnfonctiondufourn');


nomCompletdestinataire.disabled = true;
nomCompletExpediteur.disabled=true;

let fournisseur:string[] =['Orange money','Wave','Wari','CB'];
let transaction:string[]=['depot','retrait','transfer'];

  
chargerNomComplet(listeClientUrl,telExpediteur,nomCompletExpediteur);
chargerNomComplet(listeClientUrl,teldestinataire,nomCompletdestinataire);

chargerSelect(Fournisseur,fournisseur)
chargerSelect(Transaction,transaction)

valider.addEventListener("click",()=>{

    let requestData ={
        Expediteur:telExpediteur.value,
        montant:Montant.value,
        typeTransfer:Transaction.value,
        operateur:Fournisseur.value,
        destinataire:teldestinataire.value

    }

fetch(depot,{
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
          },
        body: JSON.stringify(requestData)
    })
    .then((response) => {
        if(response.ok){
            alert('La transaction a été effectuée avec succès !')
        }
        if(!response.ok){
            alert('Erreur lors du transaction!')
        }
        return response.json();
    })
    .then((data) => {
      console.log(data);
    });
})


Transaction.addEventListener('change',()=>{
    telExpediteur.value="";
    nomCompletExpediteur.value=""; 
    ilChangeParRetrait.textContent="Destinataire";
    telExpediteur.disabled=false;
    // nomCompletExpediteur.disabled=false;
    if(Transaction.value === "retrait"){
        telExpediteur.disabled=true;
        ilChangeParRetrait.textContent="numero de retrait";
    }
})

Fournisseur.addEventListener('change',()=>{
    couleurEnfonctiondufourn.style.color ="black";
    if(Fournisseur.value=="Wave"){
        couleurEnfonctiondufourn.style.color ="blue";
    }
    if(Fournisseur.value=="Orange money"){
        couleurEnfonctiondufourn.style.color ="orange";
    }
    if(Fournisseur.value=="Wari"){
        couleurEnfonctiondufourn.style.color ="green";
    }

    if(Fournisseur.value=="CB"){
        couleurEnfonctiondufourn.style.color ="crimson";
    }
})



















function chargerSelect(element: HTMLElement | null, tab: string[]) {
    if (!element) {
      console.error("Élément HTML introuvable.");
      return;
    }
    if(!fournisseur){

    }
  
    tab.forEach((e) => {
      let option = document.createElement('option');
      option.textContent = e;
      option.value = e
      element.appendChild(option);
    });
}
function chargerNomComplet(apiFetch:string,telElement:HTMLInputElement,telNom:HTMLInputElement){
    fetch(apiFetch)
.then((response) => response.json())
.then((data)=>{
  
    telElement.addEventListener('input',()=>{
        telNom.value=""
        let telValue = telElement.value;
        data.forEach((item)=>{
            const{prenom,nom,numero}=item
            if(telValue===numero){
                telNom.value = prenom + " " + nom;
            }
        })
    })
});
}