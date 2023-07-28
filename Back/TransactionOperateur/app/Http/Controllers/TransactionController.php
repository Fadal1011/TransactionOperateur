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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        try {
            $request->validate([
                'client_id' => "required",
                'montant' => "required|numeric|gt:500",
                'typeTransfer' => "required",
                'operateur' => "required"
            ], [
                'montant.gt' => 'Le montant doit être supérieur à 500.',
            ]);

            $client_id = $request->client_id;
            $montant = $request->montant;
            $compte_id = $request->compte_id;
            $typeTransfer = $request->typeTransfer;
            $operateur = $request->operateur;

            DB::transaction(function () use (&$transaction,$client_id, $montant, $compte_id, $typeTransfer,$operateur) {
                $updateSomme = Compte::find($compte_id);
                if ($typeTransfer === "depot") {
                    $updateSomme->solde = $updateSomme->solde + $montant;
                } elseif ($typeTransfer === "retrait") {
                    $client_id = NULL;
                    if ($updateSomme->solde < $montant) {
                        throw ValidationException::withMessages(['error' => 'Votre compte est insuffisant.']);
                    }
                    $updateSomme->solde = $updateSomme->solde - $montant;
                }

                $updateSomme->save();

                $transaction = Transaction::create([
                    'client_id' => $client_id,
                    'montant' => $montant,
                    'typeTransfer' => $typeTransfer,
                    'operateur' => $operateur,
                    'compte_id' => $compte_id,
                ]);

            });

            return $transaction;

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue lors du traitement de la requête.'], 500);
        }

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

            $expediteur =Compte::find($compte_expediteur);
            $destinataire = Compte::find($compte_destinataire);

            if($destinataire->numero_compte === $expediteur->numero_compte){
                return error_log('gfhjkjhgfdghjkjhg');
            }

            $opDestinataire=explode('_',$destinataire->numero_compte);
            $opExpediteur = explode('_',$expediteur->numero_compte);

            // if($opDestinataire[0]!==$opExpediteur[0]){
            //     return error_log('gfhjkjhgfdghjkjhg');
            // }

            $recupClientId = Client::where('numero',$opExpediteur[1])->first();


            // return $recupClientId;
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
