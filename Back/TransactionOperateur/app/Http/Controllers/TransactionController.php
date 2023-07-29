<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Client;
use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::all();
        return $client;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
            $request->validate([
                // 'Expediteur' => "required",
                'montant' => "required|numeric|gt:500",
                'typeTransfer' => "required",
                'operateur' => "required",
                'destinataire'=>"required",
            ], [
                'montant.gt' => 'Le montant doit être supérieur à 500.',
            ]);

            $Expediteur = $request->Expediteur;
            $montant = $request->montant;
            $destinataire = $request->destinataire ;
            $typeTransfer = $request->typeTransfer;
            $operateur = $request->operateur;
            $N_compte="" ;
            if($Expediteur !=null){
                $recupIdClient = Client::where('numero',$Expediteur)->first();
                $client_id = $recupIdClient->id;
            }


            if($operateur ==="Wave"){
                $N_compte = "Wv_".$destinataire;
            }
            if($operateur ==="Orange money"){
                $N_compte = "Om_".$destinataire;
            }
            if($operateur ==="Wari"){
                $N_compte = "Wr_".$destinataire;
            }
            if($operateur ==="CB"){
                $N_compte = "CB_".$destinataire;
            }
            $compte_id = Compte::where('numero_compte',$N_compte)->first();

                $updateSomme = Compte::find($compte_id->id);
                if ($typeTransfer === "depot") {
                    $updateSomme->solde = $updateSomme->solde + $montant;
                } elseif ($typeTransfer === "retrait") {
                    $client_id  = NULL;
                    if ($updateSomme->solde < $montant) {
                        return error_log("lkjnkjlhljo");
                    }
                    $updateSomme->solde = $updateSomme->solde - $montant;
                }

                $updateSomme->save();

                $transaction = Transaction::create([
                    'client_id' => $client_id ,
                    'montant' => $montant,
                    'typeTransfer' => $typeTransfer,
                    'operateur' => $operateur,
                    'compte_id' => $compte_id->id,
                ]);
            return $transaction;
    }


    public function transfer(Request $request){
        $request->validate([
            'expediteur' => "required",
            'montant' => "required|numeric|gt:500",
            'operateur' => "required"
        ], [
            'montant.gt' => 'Le montant doit être supérieur à 500.',
        ]);

            $compte_expediteur = $request->expediteur;
            $montant = $request->montant;
            $compte_destinataire = $request->destinataire;
            $operateur = $request->operateur;
            $code_genere = '';

            $expediteur =Compte::find($compte_expediteur);
            $destinataire = Compte::find($compte_destinataire);
            $expediteur =Compte::find($compte_expediteur);
            $opExpediteur = explode('_',$expediteur->numero_compte);

            if($compte_destinataire!==null){

                $destinataire = Compte::find($compte_destinataire);

                if($destinataire->numero_compte === $expediteur->numero_compte){
                    return error_log('gfhjkjhgfdghjkjhg');
                }

                $opDestinataire=explode('_',$destinataire->numero_compte);



                // if($opDestinataire[0]!==$opExpediteur[0]){
                //     return error_log('gfhjkjhgfdghjkjhg');
                // }

            }

            else{
                $compte_destinataire = null;
            }

            $recupClientId = Client::where('numero',$opExpediteur[1])->first();
            $transaction = Transaction::create([
                'client_id' => $recupClientId->id,
                'montant' => $montant,
                'typeTransfer' => 'transfer',
                'operateur' => $operateur,
                'compte_id' => $compte_destinataire,
            ]);

            return $transaction;

    }

}
