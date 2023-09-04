<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);
Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
Route::get('confirmation', [App\Http\Controllers\VerificationController::class, 'confirmEmail'])->name('confirmation');
Route::get('coordinateur.demandeAcces', [App\Http\Controllers\VerificationController::class, 'demandeAcces'])->name('coordinateur.demandeAcces');
Route::get('emails/access_grant/{dossier_id}', [App\Http\Controllers\VerificationController::class, 'accessGrantEmail'])->name('emails.access_grant');
// Route::get('emails/access_grant', function () {
//     return view('emails/access_grant');
// })->name('emails.access_grant');

Route::get('emails/verify', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('emails.verify');
Route::get('emails/email-verified', function () {
    return view('emails/email-verified');
})->name('email-verified');
Route::get('emails/email-verification-failed', function () {
    return view('email-failed-verification');
})->middleware('auth')->name('email-failed-verification');
Route::get('emails/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend')->middleware('auth');

//Connexion à l'application
Route::get('/login', function () {
    return view('login');
});
Route::get('/registre',  function () {
    return view('auth/registre');
});
Route::get('/logout', [App\Http\Controllers\connexionController::class, 'logout']);
Route::post('/enregistrer', [App\Http\Controllers\connexionController::class, 'enregistrer']);
Route::get('/forgotPasswordPatient', [App\Http\Controllers\connexionController::class, 'forgotPasswordPatient']);
Route::get('/deconnexion', [App\Http\Controllers\connexionController::class, 'deconnexion']);
Route::get('/deconnexionMedecin', [App\Http\Controllers\connexionController::class, 'deconnexionMedecin']);
Route::get('/deconnexionPatient', [App\Http\Controllers\connexionController::class, 'deconnexionPatient']);
Route::get('/motdepasseoubliemedecin', [App\Http\Controllers\connexionController::class, 'motdepasseoubliemedecin']);
Route::post('/motdepasseoubliemedecin', [App\Http\Controllers\connexionController::class, 'recuperemotdepasseoubliemedecin']);
Route::get('/formulaireemotdepasseoubliemedecin', [App\Http\Controllers\connexionController::class, 'formulaireemotdepasseoubliemedecin']);
Route::post('/formulaireemotdepasseoubliemedecin', [App\Http\Controllers\connexionController::class, 'reinisialisermotdepasseoubliemedecin']);
Route::get('/motdepasseoubliepatient', [App\Http\Controllers\connexionController::class, 'motdepasseoubliepatient']);
Route::post('/motdepasseoubliepatient', [App\Http\Controllers\connexionController::class, 'recuperemotdepasseoubliepatient']);
Route::get('/formulaireemotdepasseoubliepatient', [App\Http\Controllers\connexionController::class, 'formulaireemotdepasseoubliepatient']);
Route::post('/formulaireemotdepasseoubliepatient', [App\Http\Controllers\connexionController::class, 'reinisialisermotdepasseoubliepatient']);

//Espace Administrateur

Route::middleware(['auth', 'check.role:1'])->group(function () {
    Route::get('/administrateur', [App\Http\Controllers\administrateur\AdministrateurController::class, 'index']);
    Route::get('administrateur/demandeMedecins', [App\Http\Controllers\administrateur\AdministrateurController::class, 'demandeMedecins']);
    Route::get('administrateur/demandePatients', [App\Http\Controllers\administrateur\AdministrateurController::class, 'demandePatients']);
    route::get('administrateur/approuverMedecin/{id}', [App\Http\Controllers\administrateur\AdministrateurController::class, 'approuverMedecin']);
    route::get('administrateur/annulerMedecins/{id}', [App\Http\Controllers\administrateur\AdministrateurController::class, 'annulerMedecins']);
    route::get('administrateur/showMedecin/{id}', [App\Http\Controllers\administrateur\AdministrateurController::class, 'showMedecin']);
    route::get('administrateur/approuverPatients/{id}', [App\Http\Controllers\administrateur\AdministrateurController::class, 'approuverPatients']);
    route::get('administrateur/annulerPatients/{id}', [App\Http\Controllers\administrateur\AdministrateurController::class, 'annulerPatients']);
    route::get('administrateur/showPatient/{id}', [App\Http\Controllers\administrateur\AdministrateurController::class, 'showPatient']);
    Route::get('administrateur/myProfil', [App\Http\Controllers\administrateur\AdministrateurController::class, 'myProfil']);

    Route::get('/administrateur/dossiers/index', [App\Http\Controllers\administrateur\dossierController::class, 'index']);
    Route::post('administrateur/dossiers/update/{id}',  [App\Http\Controllers\administrateur\dossierController::class, 'update']);
    Route::post('administrateur/dossiers/update_personal/{id}',  [App\Http\Controllers\administrateur\dossierController::class, 'update_personal']);
    Route::post('administrateur/dossiers/update_general/{id}',  [App\Http\Controllers\administrateur\dossierController::class, 'update_general']);
    Route::post('administrateur/dossiers/update_files/{id}',  [App\Http\Controllers\administrateur\dossierController::class, 'update_files']);
    Route::post('administrateur/dossiers/update_medical/{id}',  [App\Http\Controllers\administrateur\dossierController::class, 'update_medical']);
    Route::post('administrateur/dossiers/update_adress/{id}',  [App\Http\Controllers\administrateur\dossierController::class, 'update_adress']);
    Route::get('administrateur/dossiers/edit/{id}',  [App\Http\Controllers\administrateur\dossierController::class, 'edit']);
    Route::post('administrateur/dossiers/store',  [App\Http\Controllers\administrateur\dossierController::class, 'store']);
    Route::get('administrateur/dossiers/create',  [App\Http\Controllers\administrateur\dossierController::class, 'create']);
    Route::delete('administrateur/{id}/deleteDossier', [App\Http\Controllers\administrateur\dossierController::class, 'deleteDossier'])->name('representant.deleteDossier');
    Route::get('administrateur/dossiers/show/{id}', [App\Http\Controllers\administrateur\dossierController::class, 'show']);
    Route::delete('administrateur/{id}/deleteFile', [App\Http\Controllers\administrateur\dossierController::class, 'deleteFile'])->name('administrateur.dossier.deleteFile');
    Route::get('administrateur/dossiers/{id}/historiques',  [App\Http\Controllers\administrateur\dossierController::class, 'historiques']);
    Route::get('administrateur/dossiers/{id}/monHistorique',  [App\Http\Controllers\administrateur\dossierController::class, 'monHistorique']);
    Route::get('administrateur/dossiers/{id}/effetsmarquants',  [App\Http\Controllers\administrateur\dossierController::class, 'effetsmarquants']);
    Route::delete('administrateur/dossiers/{id}/deleteHistorique', [App\Http\Controllers\administrateur\dossierController::class, 'deleteHistorique'])->name('administrateur.dossiers.deleteHistorique');
    Route::get('administrateur/dossiers/{id}/listeSupprimer',  [App\Http\Controllers\administrateur\dossierController::class, 'listeSupprimer']);
    Route::get('administrateur/dossiers/rechercher',  [App\Http\Controllers\administrateur\dossierController::class, 'rechercher']);
    Route::post('administrateur/dossiers/rechercher',  [App\Http\Controllers\administrateur\dossierController::class, 'getrechercher']);
    Route::get('administrateur/dossiers/{id}/ajouterdossier',  [App\Http\Controllers\administrateur\dossierController::class, 'ajouterdossier']);

    Route::GET('administrateur/dossiers/{id}/consultations/index',  [App\Http\Controllers\administrateur\consultationController::class, 'index']);
    Route::GET('administrateur/dossiers/{id}/consultations/create',  [App\Http\Controllers\administrateur\consultationController::class, 'create']);
    Route::GET('administrateur/dossiers/consultations/show/{id}',  [App\Http\Controllers\administrateur\consultationController::class, 'show']);
    Route::POST('administrateur/dossiers/consultations/store',  [App\Http\Controllers\administrateur\consultationController::class, 'store']);
    Route::GET('administrateur/dossiers/consultations/edit/{id}',  [App\Http\Controllers\administrateur\consultationController::class, 'edit']);
    Route::POST('administrateur/dossiers/consultations/update/{id}',  [App\Http\Controllers\administrateur\consultationController::class, 'update']);
    Route::GET('administrateur/dossiers/consultations/showExamenfiles/{id}',  [App\Http\Controllers\administrateur\consultationController::class, 'showExamenfiles']);
    Route::delete('administrateur/dossiers/consultations/deleteFile/{id}', [App\Http\Controllers\administrateur\consultationController::class, 'deleteFile'])->name('administrateur.dossiers.consultations.deleteFile');

    Route::GET('administrateur/dossiers/{id}/examenbios/index',  [App\Http\Controllers\administrateur\examenbioController::class, 'index']);
    Route::GET('administrateur/dossiers/{id}/examenbios/create',  [App\Http\Controllers\administrateur\examenbioController::class, 'create']);
    Route::GET('administrateur/dossiers/examenbios/show/{id}',  [App\Http\Controllers\administrateur\examenbioController::class, 'show']);
    Route::POST('administrateur/dossiers/examenbios/store',  [App\Http\Controllers\administrateur\examenbioController::class, 'store']);
    Route::GET('administrateur/dossiers/examenbios/edit/{id}',  [App\Http\Controllers\administrateur\examenbioController::class, 'edit']);
    Route::POST('administrateur/dossiers/examenbios/update/{id}',  [App\Http\Controllers\administrateur\examenbioController::class, 'update']);
    Route::GET('administrateur/dossiers/examenbios/showExamenfiles/{id}',  [App\Http\Controllers\administrateur\examenbioController::class, 'showExamenfiles']);
    Route::delete('administrateur/dossiers/examenbios/deleteFile/{id}', [App\Http\Controllers\administrateur\examenbioController::class, 'deleteFile'])->name('administrateur.dossiers.examenbios.deleteFile');
    Route::GET('administrateur/dossiers/{id}/examenradios/index',  [App\Http\Controllers\administrateur\examenradioController::class, 'index']);
    Route::GET('administrateur/dossiers/{id}/examenradios/create',  [App\Http\Controllers\administrateur\examenradioController::class, 'create']);
    Route::GET('administrateur/dossiers/examenradios/show/{id}',  [App\Http\Controllers\administrateur\examenradioController::class, 'show']);
    Route::POST('administrateur/dossiers/examenradios/store',  [App\Http\Controllers\administrateur\examenradioController::class, 'store']);
    Route::GET('administrateur/dossiers/examenradios/edit/{id}',  [App\Http\Controllers\administrateur\examenradioController::class, 'edit']);
    Route::POST('administrateur/dossiers/examenradios/update/{id}',  [App\Http\Controllers\administrateur\examenradioController::class, 'update']);
    Route::GET('administrateur/dossiers/examenradios/showExamenfiles/{id}',  [App\Http\Controllers\administrateur\examenradioController::class, 'showExamenfiles']);
    Route::delete('administrateur/dossiers/examenradios/deleteFile/{id}', [App\Http\Controllers\administrateur\examenradioController::class, 'deleteFile'])->name('administrateur.dossiers.examenradios.deleteFile');

    Route::get('administrateur/medecins', [App\Http\Controllers\administrateur\medecinController::class, 'index']);
    Route::get('administrateur/medecins/show/{id}', [App\Http\Controllers\administrateur\medecinController::class, 'show']);
    Route::get('administrateur/medecins/edit/{id}', [App\Http\Controllers\administrateur\medecinController::class, 'edit']);
    Route::get('administrateur/medecins/create', [App\Http\Controllers\administrateur\medecinController::class, 'create']);
    Route::post('administrateur/medecins/store', [App\Http\Controllers\administrateur\medecinController::class, 'store']);
    Route::delete('administrateur/medecins/{id}/supprimer', [App\Http\Controllers\administrateur\medecinController::class, 'supprimermedecin']);
    Route::post('administrateur/medecins/update/{id}', [App\Http\Controllers\administrateur\medecinController::class, 'update']);
    Route::delete('administrateur/{id}/deleteMedecin', [App\Http\Controllers\administrateur\medecinController::class, 'deleteMedecin'])->name('admin.medecins.delete');

    Route::get('/administrateur/motifs', [App\Http\Controllers\administrateur\motifController::class, 'index']);
    Route::get('/administrateur/motifs/index', [App\Http\Controllers\administrateur\motifController::class, 'index']);
    Route::post('/administrateur/motifs/update/{id}', [App\Http\Controllers\administrateur\motifController::class, 'update']);
    Route::get('/administrateur/motifs/edit/{id}', [App\Http\Controllers\administrateur\motifController::class, 'edit']);
    Route::get('/administrateur/motifs/create', [App\Http\Controllers\administrateur\motifController::class, 'create']);
    Route::post('/administrateur/motifs/store', [App\Http\Controllers\administrateur\motifController::class, 'store']);
    Route::delete('/administrateur/{id}/deleteMotif', [App\Http\Controllers\administrateur\motifController::class, 'deleteMotif'])->name('motif.deleteMotif');

    Route::get('/administrateur/specialites', [App\Http\Controllers\administrateur\specialiteController::class, 'index']);
    Route::get('/administrateur/specialites/index',  [App\Http\Controllers\administrateur\specialiteController::class, 'index']);
    Route::post('/administrateur/specialites/update/{id}',  [App\Http\Controllers\administrateur\specialiteController::class, 'update']);
    Route::get('/administrateur/specialites/edit/{id}', [App\Http\Controllers\administrateur\specialiteController::class, 'edit']);
    Route::get('/administrateur/specialites/create', [App\Http\Controllers\administrateur\specialiteController::class, 'create']);
    Route::post('/administrateur/specialites/store', [App\Http\Controllers\administrateur\specialiteController::class, 'store']);
    Route::delete('/administrateur/{id}/deletespecialite', [App\Http\Controllers\administrateur\specialiteController::class, 'deletespecialite'])->name('specialite.deletespecialite');

    Route::get('/administrateur/pays', [App\Http\Controllers\administrateur\paysController::class, 'index']);
    Route::get('/administrateur/pays/index',  [App\Http\Controllers\administrateur\paysController::class, 'index']);
    Route::get('/administrateur/pays/show/{id}',  [App\Http\Controllers\administrateur\paysController::class, 'show']);
    Route::post('/administrateur/pays/update/{id}',  [App\Http\Controllers\administrateur\paysController::class, 'update']);
    Route::get('/administrateur/pays/edit/{id}',  [App\Http\Controllers\administrateur\paysController::class, 'edit']);
    Route::get('/administrateur/pays/create',  [App\Http\Controllers\administrateur\paysController::class, 'create']);
    Route::post('/administrateur/pays/store',  [App\Http\Controllers\administrateur\paysController::class, 'store']);
    Route::delete('/administrateur/pays/{id}/deletepays',  [App\Http\Controllers\administrateur\paysController::class, 'deletepays'])->name('pays.deletepays');
    Route::post('/administrateur/pays/ville/update/{id}',  [App\Http\Controllers\administrateur\paysController::class, 'updateville']);
    Route::get('/administrateur/pays/ville/edit/{id}',  [App\Http\Controllers\administrateur\paysController::class, 'editville'])->name('administrateur.pays.ville.edit');
    Route::get('/administrateur/pays/ville/create/{id}',  [App\Http\Controllers\administrateur\paysController::class, 'createville']);
    Route::post('/administrateur/pays/ville/store',  [App\Http\Controllers\administrateur\paysController::class, 'storeville']);
    Route::delete('/administrateur/{id}/deleteville',  [App\Http\Controllers\administrateur\paysController::class, 'deleteville'])->name('ville.deleteville');

    Route::get('/administrateur/groupesanguins', [App\Http\Controllers\administrateur\groupesanguinController::class, 'index']);
    Route::get('/administrateur/groupesanguins/index', [App\Http\Controllers\administrateur\groupesanguinController::class, 'index']);
    Route::post('/administrateur/groupesanguins/update/{id}',  [App\Http\Controllers\administrateur\groupesanguinController::class, 'update']);
    Route::get('/administrateur/groupesanguins/edit/{id}',  [App\Http\Controllers\administrateur\groupesanguinController::class, 'edit']);
    Route::get('/administrateur/groupesanguins/create',  [App\Http\Controllers\administrateur\groupesanguinController::class, 'create']);
    Route::post('/administrateur/groupesanguins/store',  [App\Http\Controllers\administrateur\groupesanguinController::class, 'store']);
    Route::delete('/administrateur/{id}/deletegroupesanguin',  [App\Http\Controllers\administrateur\groupesanguinController::class, 'deletegroupesanguin'])->name('groupesanguin.deletegroupesanguin');

    Route::get('/administrateur/organismes', [App\Http\Controllers\administrateur\organismeController::class, 'index']);
    Route::get('/administrateur/organismes/index', [App\Http\Controllers\administrateur\organismeController::class, 'index']);
    Route::post('/administrateur/organismes/update/{id}', [App\Http\Controllers\administrateur\organismeController::class, 'update']);
    Route::get('/administrateur/organismes/edit/{id}', [App\Http\Controllers\administrateur\organismeController::class, 'edit']);
    Route::get('/administrateur/organismes/create', [App\Http\Controllers\administrateur\organismeController::class, 'create']);
    Route::post('/administrateur/organismes/store', [App\Http\Controllers\administrateur\organismeController::class, 'store']);
    Route::delete('administrateur/organismes/{id}/supprimer', [App\Http\Controllers\administrateur\organismeController::class, 'supprimermedecin']);
    Route::delete('/administrateur/{id}/deleteorganisme', [App\Http\Controllers\administrateur\organismeController::class, 'deleteorganisme'])->name('organisme.deleteorganisme');

    ///////////
    Route::get('administrateur/coordinateurs/index',  [App\Http\Controllers\adminCoordinateurController::class, 'index']);
    Route::get('administrateur/coordinateurs/affecter/{id}',  [App\Http\Controllers\adminCoordinateurController::class, 'affecter']);
    Route::post('administrateur/coordinateurs/affecter/{id}',  [App\Http\Controllers\adminCoordinateurController::class, 'affectercoordinateur']);

    Route::get('administrateur/radiotypes/index',  [App\Http\Controllers\adminRadiotypesController::class, 'index']);
    Route::get('administrateur/radiotypes/create',  [App\Http\Controllers\adminRadiotypesController::class, 'create']);
    Route::post('administrateur/radiotypes/store',  [App\Http\Controllers\adminRadiotypesController::class, 'store']);
    Route::delete('administrateur/radiotypes/delete/{id}',  [App\Http\Controllers\adminRadiotypesController::class, 'delete'])->name('radiotypes.deleteradiotypes');
    Route::get('administrateur/radiotypes/edit/{id}',  [App\Http\Controllers\adminRadiotypesController::class, 'edit']);
    Route::post('administrateur/radiotypes/update/{id}',  [App\Http\Controllers\adminRadiotypesController::class, 'update']);
    Route::get('administrateur/radio/{id}/index',  [App\Http\Controllers\adminRadioController::class, 'index']);
    Route::get('administrateur/radio/{id}/create',  [App\Http\Controllers\adminRadioController::class, 'create']);
    Route::post('administrateur/radio/{id}/store',  [App\Http\Controllers\adminRadioController::class, 'store']);
    Route::delete('administrateur/radio/delete/{id}',  [App\Http\Controllers\adminRadioController::class, 'delete'])->name('radio.deleteradio');
    Route::get('administrateur/radio/edit/{id}',  [App\Http\Controllers\adminRadioController::class, 'edit']);
    Route::post('administrateur/radio/update/{id}',  [App\Http\Controllers\adminRadioController::class, 'update']);
    Route::get('administrateur/medecins/index',  [App\Http\Controllers\adminMedecinsController::class, 'index']);
    Route::get('administrateur/medecins/create',  [App\Http\Controllers\adminMedecinsController::class, 'create']);
    Route::post('administrateur/medecins/store',  [App\Http\Controllers\adminMedecinsController::class, 'store']);
    Route::delete('administrateur/medecins/delete/{id}',  [App\Http\Controllers\adminMedecinsController::class, 'delete'])->name('medecin.deletermedecin');
    Route::get('administrateur/medecins/edit/{id}',  [App\Http\Controllers\adminMedecinsController::class, 'edit']);
    Route::post('administrateur/medecins/update/{id}',  [App\Http\Controllers\adminMedecinsController::class, 'update']);
    Route::get('administrateur/profession/index',  [App\Http\Controllers\adminProfessionController::class, 'index']);
    Route::get('administrateur/profession/create',  [App\Http\Controllers\adminProfessionController::class, 'create']);
    Route::post('administrateur/profession/store',  [App\Http\Controllers\adminProfessionController::class, 'store']);
    Route::delete('administrateur/profession/delete/{id}',  [App\Http\Controllers\adminProfessionController::class, 'delete'])->name('profession.deleteprofession');
    Route::get('administrateur/profession/edit/{id}',  [App\Http\Controllers\adminProfessionController::class, 'edit']);
    Route::post('administrateur/profession/update/{id}',  [App\Http\Controllers\adminProfessionController::class, 'update']);
    Route::get('administrateur/convention/index',  [App\Http\Controllers\adminConventionController::class, 'index']);
    Route::get('administrateur/convention/create',  [App\Http\Controllers\adminConventionController::class, 'create']);
    Route::post('administrateur/convention/store',  [App\Http\Controllers\adminConventionController::class, 'store']);
    Route::delete('administrateur/convention/delete/{id}',  [App\Http\Controllers\adminConventionController::class, 'delete'])->name('convention.deleteconvention');
    Route::get('administrateur/convention/edit/{id}',  [App\Http\Controllers\adminConventionController::class, 'edit']);
    Route::post('administrateur/convention/update/{id}',  [App\Http\Controllers\adminConventionController::class, 'update']);
});

//Espace Medecin
Route::middleware(['auth', 'check.role:3'])->group(function () {
    Route::get('medecin', [App\Http\Controllers\medecin\medecinController::class, 'index']);
    Route::get('medecin/show/{id}', [App\Http\Controllers\medecin\medecinController::class, 'show']);
    Route::get('medecin/edit/{id}', [App\Http\Controllers\medecin\medecinController::class, 'edit']);
    Route::post('medecin/update/{id}', [App\Http\Controllers\medecin\medecinController::class, 'update']);
    Route::get('medecin/editmdp/{id}', [App\Http\Controllers\medecin\medecinController::class, 'editmdp']);
    Route::post('medecin/editmdp/{id}', [App\Http\Controllers\medecin\medecinController::class, 'storeeditmdp']);

    Route::post('medecin/dossiers/update_personal/{id}',  [App\Http\Controllers\medecin\medecinController::class, 'update_personal']);
    Route::post('medecin/dossiers/update_general/{id}',  [App\Http\Controllers\medecin\medecinController::class, 'update_general']);
    Route::put('medecin/dossiers/update_files/{id}',  [App\Http\Controllers\medecin\medecinController::class, 'update_files']);
    Route::post('medecin/dossiers/update_medical/{id}',  [App\Http\Controllers\medecin\medecinController::class, 'update_medical']);
    Route::post('medecin/dossiers/update_adress/{id}',  [App\Http\Controllers\medecin\medecinController::class, 'update_adress']);
    Route::delete('medecin/{id}/deleteDossier', [App\Http\Controllers\medecin\medecinController::class, 'deleteDossier'])->name('medecin.deleteDossier');

    Route::get('medecin/profile', [App\Http\Controllers\medecin\medecinController::class, 'profile']);
    Route::get('medecin/editMonProfil', [App\Http\Controllers\medecin\medecinController::class, 'editMonProfil']);
    Route::post('medecin/updateMonProfil', [App\Http\Controllers\medecin\medecinController::class, 'updateMonProfil']);
    Route::get('medecin/lesmedecins', [App\Http\Controllers\medecin\medecinController::class, 'tousmedecins']);
    Route::delete('medecin/{id}/destroymedecin', [App\Http\Controllers\medecin\medecinController::class, 'destroymedecin'])->name('medecin.destroymedecin');
    Route::delete('medecin/{id}/deleteFile', [App\Http\Controllers\medecin\medecinController::class, 'deleteFile'])->name('medecin.dossier.deleteFile');
    route::get('/medecin/imprimerDossier/{id}', [App\Http\Controllers\medecin\medecinController::class, 'imprimerDossier']);
    Route::get('medecin/{id}/historiques', [App\Http\Controllers\medecin\medecinController::class, 'historiques']);
    Route::get('medecin/{id}/historiques_medecin', [App\Http\Controllers\medecin\medecinController::class, 'historiques_medecin']);
    Route::get('medecin/{id}/effetsmarquants', [App\Http\Controllers\medecin\medecinController::class, 'effetsmarquants']);
    Route::delete('medecin/{id}/effetsmarquants/delete', [App\Http\Controllers\medecin\medecinController::class, 'destroyEffetMarquant']);
    Route::get('medecin/{id}/listeSupprimer', [App\Http\Controllers\medecin\medecinController::class, 'effetsmarquantsSupprimer']);

    Route::get('medecin/{id}/consultation',  [App\Http\Controllers\medecin\consultationController::class, 'index']);
    Route::get('medecin/consultation/{idC}/show', [App\Http\Controllers\medecin\consultationController::class, 'show']);
    Route::get('medecin/consultation/create/{id}', [App\Http\Controllers\medecin\consultationController::class, 'create']);
    Route::get('medecin/consultation/showExamenfiles/{idC}', [App\Http\Controllers\medecin\consultationController::class, 'showExamenfiles']);
    Route::post('medecin/consultation/store', [App\Http\Controllers\medecin\consultationController::class, 'store']);
    Route::get('medecin/{id}/consultation/{idC}/imprimer', [App\Http\Controllers\medecin\consultationController::class, 'imprimer']);
    Route::get('medecin/consultation/edit/{idC}', [App\Http\Controllers\medecin\consultationController::class, 'edit']);
    Route::post('medecin/consultation/update/{id}', [App\Http\Controllers\medecin\consultationController::class, 'update']);
    Route::delete('medecin/consultation/{id}/deleteFile', [App\Http\Controllers\medecin\consultationController::class, 'deleteFile'])->name('medecin.consultation.deleteFile');

    Route::get('medecin/{id}/examenbio', [App\Http\Controllers\medecin\examenbioController::class, 'index']);
    Route::get('medecin/examenbio/{idC}/show', [App\Http\Controllers\medecin\examenbioController::class, 'show']);
    Route::get('medecin/examenbio/create/{id}', [App\Http\Controllers\medecin\examenbioController::class, 'create']);
    Route::get('medecin/examenbio/showExamenfiles/{idC}', [App\Http\Controllers\medecin\examenbioController::class, 'showExamenfiles']);
    Route::post('medecin/examenbio/store', [App\Http\Controllers\medecin\examenbioController::class, 'store']);
    Route::get('medecin/{id}/examenbio/{idC}/imprimer', [App\Http\Controllers\medecin\examenbioController::class, 'imprimer']);
    Route::get('medecin/examenbio/urlBio/{id}', [App\Http\Controllers\medecin\examenbioController::class, 'urlBio']);
    Route::get('medecin/examenbio/edit/{idC}', [App\Http\Controllers\medecin\examenbioController::class, 'edit']);
    Route::post('medecin/examenbio/update/{id}', [App\Http\Controllers\medecin\examenbioController::class, 'update']);
    Route::delete('medecin/examenbio/{id}/deleteFile', [App\Http\Controllers\medecin\examenbioController::class, 'deleteFile'])->name('medecin.examenbio.deleteFile');

    Route::get('medecin/{id}/examenradio', [App\Http\Controllers\medecin\examenradioController::class, 'index']);
    Route::get('medecin/examenradio/{idC}/show', [App\Http\Controllers\medecin\examenradioController::class, 'show']);
    Route::get('medecin/examenradio/create/{id}', [App\Http\Controllers\medecin\examenradioController::class, 'create']);
    Route::post('medecin/examenradio/store', [App\Http\Controllers\medecin\examenradioController::class, 'store']);
    Route::get('medecin/{id}/examenradio/{idC}/imprimer', [App\Http\Controllers\medecin\examenradioController::class, 'imprimer']);
    Route::get('medecin/examenradio/urlRadio/{id}', [App\Http\Controllers\medecin\examenradioController::class, 'urlRadio']);
    Route::get('medecin/examenradio/edit/{idC}', [App\Http\Controllers\medecin\examenradioController::class, 'edit']);
    Route::post('medecin/examenradio/update/{idC}', [App\Http\Controllers\medecin\examenradioController::class, 'update']);
    Route::delete('medecin/examenradio/{id}/deleteFile', [App\Http\Controllers\medecin\examenradioController::class, 'deleteFile'])->name('medecin.examenradio.deleteFile');
    Route::get('medecin/examenradio/showExamenfiles/{idC}', [App\Http\Controllers\medecin\examenradioController::class, 'showExamenfiles']);

    //Discusion Medecin Medecin
    Route::get('/medecin/forum',  [App\Http\Controllers\medecin\medecinDiscussionsController::class, 'index']);
    Route::get('/medecin/forum/recu', [App\Http\Controllers\medecin\medecinDiscussionsController::class, 'recuMedecin']);
    Route::get('/medecin/forum/envoye', [App\Http\Controllers\medecin\medecinDiscussionsController::class, 'envoyeMedecin']);
    Route::get('/medecin/forum/create', [App\Http\Controllers\medecin\medecinDiscussionsController::class, 'create']);
    Route::post('/medecin/forum/store', [App\Http\Controllers\medecin\medecinDiscussionsController::class, 'store']);
    Route::get('/medecin/forum/createbyid/{id}', [App\Http\Controllers\medecin\medecinDiscussionsController::class, 'createbyid']);
    Route::post('/medecin/forum/storebyid', [App\Http\Controllers\medecin\medecinDiscussionsController::class, 'storebyid']);
    Route::get('/medecin/forum/cloture', [App\Http\Controllers\medecin\medecinDiscussionsController::class, 'cloture']);
    Route::get('/medecin/forum/recucloture', [App\Http\Controllers\medecin\medecinDiscussionsController::class, 'cloturerecu']);
    Route::get('/medecin/forum/envoyecloture', [App\Http\Controllers\medecin\medecinDiscussionsController::class, 'clotureenvoye']);
    Route::get('/medecin/forum/show/{slug}', [App\Http\Controllers\medecin\medecinDiscussionsController::class, 'show']);
    Route::post('/medecin/forum/reply/{id}', [App\Http\Controllers\medecin\medecinDiscussionsController::class, 'reply']);
    Route::get('/medecin/forum/cloturer/{id}', [App\Http\Controllers\medecin\medecinDiscussionsController::class, 'cloturer']);
    Route::get('medecin/forum/getDownloadReply/{id}', [App\Http\Controllers\medecin\medecinDiscussionsController::class, 'getDownload']);

    //Discusion Medecin Patient
    Route::get('/medecin/forumMedPatient',  [App\Http\Controllers\medecin\medecinPatientDiscussionsController::class, 'discussionMedPatient']);
    Route::get('/medecin/forumMedPatient/create', [App\Http\Controllers\medecin\medecinPatientDiscussionsController::class, 'create']);
    Route::get('/medecin/forumMedPatient/createbydossier/{id}', [App\Http\Controllers\medecin\medecinPatientDiscussionsController::class, 'createbydossier']);
    Route::post('/medecin/forumMedPatient/store', [App\Http\Controllers\medecin\medecinPatientDiscussionsController::class, 'store']);
    Route::get('/medecin/forumMedPatient/envoye', [App\Http\Controllers\medecin\medecinPatientDiscussionsController::class, 'discussionMedPatientEnvoye']);
    Route::get('/medecin/forumMedPatient/recu', [App\Http\Controllers\medecin\medecinPatientDiscussionsController::class, 'discussionMedPatientRecu']);
    Route::get('/medecin/forumMedPatient/cloture', [App\Http\Controllers\medecin\medecinPatientDiscussionsController::class, 'cloture']);
    Route::get('/medecin/forumMedPatient/recucloture', [App\Http\Controllers\medecin\medecinPatientDiscussionsController::class, 'cloturerecu']);
    Route::get('/medecin/forumMedPatient/envoyecloture', [App\Http\Controllers\medecin\medecinPatientDiscussionsController::class, 'clotureenvoye']);
    Route::get('/medecin/forumMedPatient/cloturer/{id}', [App\Http\Controllers\medecin\medecinPatientDiscussionsController::class, 'cloturer']);
    Route::get('/medecin/forumMedPatient/createbyid/{id}', [App\Http\Controllers\medecin\medecinPatientDiscussionsController::class, 'createbyid']);
    Route::get('/medecin/forumMedPatient/envoyeCloturer', [App\Http\Controllers\medecin\medecinPatientDiscussionsController::class, 'indexE_Cloturer']);
    Route::get('/medecin/forumMedPatient/recuCloturer', [App\Http\Controllers\medecin\medecinPatientDiscussionsController::class, 'indexR_Cloturer']);
    Route::get('/medecin/forumMedPatient/show/{slug}', [App\Http\Controllers\medecin\medecinPatientDiscussionsController::class, 'show']);
    Route::post('/medecin/forumMedPatient/reply/{id}', [App\Http\Controllers\medecin\medecinPatientDiscussionsController::class, 'reply']);

    ///////////
    Route::get('medecin/dashboard', [App\Http\Controllers\medecin\notificationController::class, 'dashboard']);
    Route::post('medecin/mark-as-read/{id}',  [App\Http\Controllers\medecin\notificationController::class, 'read']);
    Route::get('medecin/medecins/index',  [App\Http\Controllers\medecin\medecinController::class, 'index']);
    Route::get('medecin/medecins/show/{id}',  [App\Http\Controllers\medecin\medecinController::class, 'show']);
    Route::get('medecin/medecins/create',  [App\Http\Controllers\medecin\medecinController::class, 'create']);
    Route::post('medecin/medecins/store',  [App\Http\Controllers\medecin\medecinController::class, 'store']);

    Route::get('medecin/demandeDevis/index',  [App\Http\Controllers\medecin\demandeDevisController::class, 'index']);
    Route::get('medecin/demandeDevis/show/{id}',  [App\Http\Controllers\medecin\demandeDevisController::class, 'show']);
    Route::get('medecin/devis/{id}/create',  [App\Http\Controllers\medecin\devisController::class, 'create']);
    Route::get('medecin/demandeDevis/consulter/{id}/{notif}', [App\Http\Controllers\medecin\demandeDevisController::class, 'consulter']);
    Route::get('medecin/devis/show-invoice/{id}',  [App\Http\Controllers\medecin\devisController::class, 'showInvoice']);
    Route::get('medecin/devis/{id}/create_details_devis',  [App\Http\Controllers\medecin\devisController::class, 'create_details_devis']);
    Route::post('medecin/devis/storeInvoiceLine',  [App\Http\Controllers\medecin\devisController::class, 'storeInvoiceLine']);
    Route::post('medecin/devis/{id}/sendInvoice',  [App\Http\Controllers\medecin\devisController::class, 'sendInvoice']);
    Route::post('medecin/devis/store',  [App\Http\Controllers\medecin\devisController::class, 'store']);
    Route::get('medecin/devis/{id}/print-invoice', [App\Http\Controllers\medecin\devisController::class, 'printInvoice']);
});

//Espace Patient
Route::middleware(['auth', 'check.role:2'])->group(function () {
    Route::get('patient/dashboard', [App\Http\Controllers\patient\notificationController::class, 'dashboard']);
    
    Route::get('patient/profile', [App\Http\Controllers\patient\patientController::class, 'profile']);
    Route::get('patient/editMonProfil', [App\Http\Controllers\patient\patientController::class, 'editMonProfil']);
    Route::post('patient/updateProfil', [App\Http\Controllers\patient\patientController::class, 'updateProfil']);
    Route::get('patient/editmdp/{id}', [App\Http\Controllers\patient\patientController::class, 'editmdp']);
    Route::post('patient/editmdp/{id}', [App\Http\Controllers\patient\patientController::class, 'storeeditmdp']);
    
    Route::get('patient', [App\Http\Controllers\patient\dossierController::class, 'mondossier']);
    Route::get('patient/mondossier', [App\Http\Controllers\patient\dossierController::class, 'mondossier']);
    Route::get('patient/editmondossier', [App\Http\Controllers\patient\dossierController::class, 'editmondossier']);
    Route::post('patient/updatemondossier', [App\Http\Controllers\patient\dossierController::class, 'updatemondossier']);
   
    Route::get('patient/mesmedecins', [App\Http\Controllers\patient\medecinController::class, 'mesmedecins']);
    Route::get('patient/medecin/{id}', [App\Http\Controllers\patient\medecinController::class, 'medecin']);
    Route::get('patient/tousmedecins', [App\Http\Controllers\patient\medecinController::class, 'tousmedecins']);
    Route::post('patient/{id}/specialties',  [App\Http\Controllers\patient\medecinController::class, 'storeSpecialties'])->name('patient.medecins.storeSpecialties');
    Route::get('patient/medControle/{id}', [App\Http\Controllers\patient\medecinController::class, 'medControle']);
    Route::delete('patient/{id}/deleteMedecin', [App\Http\Controllers\patient\medecinController::class, 'deleteMedecin'])->name('patient.deleteMedecin');
    Route::get('patient/tousmedecinstous', [App\Http\Controllers\patient\medecinController::class, 'tousmedecinstous']);
    Route::get('patient/tousmedecins/{id}', [App\Http\Controllers\patient\medecinController::class, 'AjouterMedecin']);

    Route::get('patient/consultations/index', [App\Http\Controllers\patient\consultationController::class, 'index']);
    Route::get('patient/consultations/{id}/show', [App\Http\Controllers\patient\consultationController::class, 'show']);
    Route::get('patient/consultations/getDownloadConsultationFiles/{id}', [App\Http\Controllers\patient\consultationController::class, 'getDownloadConsultationFiles']);
    Route::get('patient/consultations/showConsultationFiles/{id}', [App\Http\Controllers\patient\consultationController::class, 'showConsultationFiles']);
    Route::get('patient/consultations/create/{id}', [App\Http\Controllers\patient\consultationController::class, 'create']);
    Route::post('patient/consultations/store', [App\Http\Controllers\patient\consultationController::class, 'store']);
    Route::get('patient/consultations/edit/{idC}', [App\Http\Controllers\patient\consultationController::class, 'edit']);
    Route::post('patient/consultations/update/{idC}', [App\Http\Controllers\patient\consultationController::class, 'update']);
    Route::delete('patient/consultation/{id}/deleteFile', [App\Http\Controllers\patient\consultationController::class, 'deleteFile'])->name('patient.consultation.deleteFile');

    Route::get('patient/examenbios/index', [App\Http\Controllers\patient\examenbioController::class, 'index']);
    Route::get('patient/examenbios/{id}/show', [App\Http\Controllers\patient\examenbioController::class, 'show']);
    Route::get('patient/examenbios/showExamenbioFiles/{id}', [App\Http\Controllers\patient\examenbioController::class, 'showExamenbioFiles']);
    Route::get('patient/examenbios/create', [App\Http\Controllers\patient\examenbioController::class, 'create']);
    Route::post('patient/examenbios/store', [App\Http\Controllers\patient\examenbioController::class, 'store']);
    Route::get('patient/examenbios/urlBio/{id}', [App\Http\Controllers\patient\examenbioController::class, 'urlBio']);
    Route::get('patient/examenbios/edit/{idC}', [App\Http\Controllers\patient\examenbioController::class, 'edit']);
    Route::post('patient/examenbios/update/{idC}', [App\Http\Controllers\patient\examenbioController::class, 'update']);
    Route::delete('patient/examenbio/{id}/deleteFile', [App\Http\Controllers\patient\examenbioController::class, 'deleteFile'])->name('patient.examenbio.deleteFile');

    Route::get('patient/examenradios/index', [App\Http\Controllers\patient\examenradioController::class, 'index']);
    Route::get('patient/examenradios/{id}/show', [App\Http\Controllers\patient\examenradioController::class, 'show']);
    Route::get('patient/examenradios/getDownloadexradioFiles/{id}', [App\Http\Controllers\patient\examenradioController::class, 'getDownload']);
    Route::get('patient/examenradios/showExamenradioFiles/{id}', [App\Http\Controllers\patient\examenradioController::class, 'showExamenradioFiles']);
    Route::get('patient/examenradios/create', [App\Http\Controllers\patient\examenradioController::class, 'create']);
    Route::post('patient/examenradios/store', [App\Http\Controllers\patient\examenradioController::class, 'store']);
    Route::get('patient/examenradios/urlRadio/{id}', [App\Http\Controllers\patient\examenradioController::class, 'urlRadio']);
    Route::get('patient/examenradios/edit/{idC}', [App\Http\Controllers\patient\examenradioController::class, 'edit']);
    Route::post('patient/examenradios/update/{idC}', [App\Http\Controllers\patient\examenradioController::class, 'update']);
    Route::delete('patient/examenradio/{id}/deleteFile', [App\Http\Controllers\patient\examenradioController::class, 'deleteFile'])->name('patient.examenradio.deleteFile');

    //Discussion Patient
    Route::get('patient/discussions/forum', [App\Http\Controllers\patient\discussionsController::class, 'forum']);
    Route::get('patient/discussions/cloture',  [App\Http\Controllers\patient\discussionsController::class, 'forum_cloture']);
    Route::get('patient/discussions/create',  [App\Http\Controllers\patient\discussionsController::class, 'create']);
    Route::get('patient/discussions/createMed/{id}',  [App\Http\Controllers\patient\discussionsController::class, 'createMed']);
    Route::get('patient/discussions/createById/{id}',  [App\Http\Controllers\patient\discussionsController::class, 'createById']);
    Route::get('patient/discussions/createMedControle/{id}',  [App\Http\Controllers\patient\discussionsController::class, 'createMedControle']);
    Route::post('patient/discussions/store',  [App\Http\Controllers\patient\discussionsController::class, 'store']);
    Route::post('patient/discussions/storeMed',  [App\Http\Controllers\patient\discussionsController::class, 'storeMed']);
    Route::get('patient/discussions/recu',  [App\Http\Controllers\patient\discussionsController::class, 'recu']);
    Route::get('patient/discussions/recucloture',  [App\Http\Controllers\patient\discussionsController::class, 'recu_cloture']);
    Route::get('patient/discussions/envoye',  [App\Http\Controllers\patient\discussionsController::class, 'envoye']);
    Route::get('patient/discussions/envoyecloture',  [App\Http\Controllers\patient\discussionsController::class, 'envoye_cloture']);
    Route::get('patient/discussions/show/{slug}',  [App\Http\Controllers\patient\discussionsController::class, 'show']);
    Route::post('patient/discussions/reply/{id}',  [App\Http\Controllers\patient\discussionsController::class, 'reply']);
    Route::get('/patient/discussions/cloturer/{id}',  [App\Http\Controllers\patient\discussionsController::class, 'cloturer']);

    ///////////

    Route::get('patient/coordinateurs/index',  [App\Http\Controllers\patient\coordinateurController::class, 'index']);
    Route::get('patient/coordinateurs/show/{id}',  [App\Http\Controllers\patient\coordinateurController::class, 'show']);
    Route::post('patient/coordinateurs/activate-coordinateur/{userId}',  [App\Http\Controllers\patient\coordinateurController::class, 'activateCoordinateur'])->name('patient.activate.coordinateur');
    Route::post('patient/coordinateurs/deactivate-coordinateur/{userId}',  [App\Http\Controllers\patient\coordinateurController::class, 'deactivateCoordinateur'])->name('patient.deactivate.coordinateur');

    Route::GET('patient/demandeCons/{id}/create',  [App\Http\Controllers\patient\demandeConsController::class, 'create']);
    Route::post('patient/demandeCons/store',  [App\Http\Controllers\patient\demandeConsController::class, 'store']);
    Route::GET('patient/demandeCons/show',  [App\Http\Controllers\patient\demandeConsController::class, 'show']);
    Route::GET('patient/demandeCons/demande/{id}',  [App\Http\Controllers\patient\demandeConsController::class, 'demande']);
    Route::post('patient/demandeCons/{id}/affecter',  [App\Http\Controllers\patient\demandeConsController::class, 'affecter']);
    Route::post('patient/demandeCons/{id}/désactiver',  [App\Http\Controllers\patient\demandeConsController::class, 'désactiver']);
    Route::post('patient/demandeCons/{id}/cloturer',  [App\Http\Controllers\patient\demandeConsController::class, 'cloturer']);
    Route::get('patient/demandeCons/{id}/enAttenteInfos',  [App\Http\Controllers\patient\demandeConsController::class, 'attenteInfos']);
    Route::post('patient/demandeCons/{id}/enAttenteInfos',  [App\Http\Controllers\patient\demandeConsController::class, 'enAttenteInfos']);
    Route::get('patient/demandeCons/show-devis/{id}',  [App\Http\Controllers\patient\demandeConsController::class, 'showDevis']);
    Route::get('patient/demandeInfos/repondre/{id}',  [App\Http\Controllers\patient\demandeInfosController::class, 'repDemandeInfos']);
    Route::post('patient/demandeInfos/storeRep',  [App\Http\Controllers\patient\demandeInfosController::class, 'storeRep']);
    Route::get('/markAsRead', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('mark');
});

Route::get('patient/devis/{id}/consulter/{notif}',  [App\Http\Controllers\patient\notificationController::class, 'readInvoice']);
Route::get('patient/devis/{id}/show',  [App\Http\Controllers\patient\devisController::class, 'show']);


//representant
Route::middleware(['auth', 'check.role:5'])->group(function () {
    Route::get('representant/dashboard', [App\Http\Controllers\representant\representantController::class, 'dashboard']);
    Route::get('representant/myProfil', [App\Http\Controllers\representant\representantController::class, 'myProfil']);
    Route::post('representant/update_information', [App\Http\Controllers\representant\representantController::class, 'update_information']);
    Route::post('representant/update_general', [App\Http\Controllers\representant\representantController::class, 'update_general']);
    Route::post('representant/updatemdp', [App\Http\Controllers\representant\representantController::class, 'updatemdp']);

    Route::post('representant/prendre-en-charge/{notif}/{id}',  [App\Http\Controllers\representant\demandeConsController::class, 'prendreEnCharge']);
    Route::post('representant/prendre-en-charge/{id}',  [App\Http\Controllers\representant\demandeConsController::class, 'prendreEnCharge1']);
    Route::post('representant/consulter/{id}',  [App\Http\Controllers\representant\demandeConsController::class, 'consulter']);

    Route::get('/representant/dossiers/index', [App\Http\Controllers\representant\dossierController::class, 'index']);
    Route::post('representant/dossiers/update/{id}',  [App\Http\Controllers\representant\dossierController::class, 'update']);
    Route::post('representant/dossiers/update_personal/{id}',  [App\Http\Controllers\representant\dossierController::class, 'update_personal']);
    Route::post('representant/dossiers/update_general/{id}',  [App\Http\Controllers\representant\dossierController::class, 'update_general']);
    Route::post('representant/dossiers/update_files/{id}',  [App\Http\Controllers\representant\dossierController::class, 'update_files']);
    Route::post('representant/dossiers/update_medical/{id}',  [App\Http\Controllers\representant\dossierController::class, 'update_medical']);
    Route::post('representant/dossiers/update_adress/{id}',  [App\Http\Controllers\representant\dossierController::class, 'update_adress']);
    Route::get('representant/dossiers/edit/{id}',  [App\Http\Controllers\representant\dossierController::class, 'edit']);
    Route::post('representant/dossiers/store',  [App\Http\Controllers\representant\dossierController::class, 'store']);
    Route::get('representant/dossiers/create',  [App\Http\Controllers\representant\dossierController::class, 'create']);
    Route::delete('representant/{id}/deleteDossier', [App\Http\Controllers\representant\dossierController::class, 'deleteDossier'])->name('representant.deleteDossier');
    Route::get('representant/dossiers/show/{id}', [App\Http\Controllers\representant\dossierController::class, 'show']);
    Route::delete('representant/{id}/deleteFile', [App\Http\Controllers\representant\dossierController::class, 'deleteFile'])->name('representant.dossier.deleteFile');
    Route::get('representant/dossiers/{id}/historiques',  [App\Http\Controllers\representant\dossierController::class, 'historiques']);
    Route::get('representant/dossiers/{id}/monHistorique',  [App\Http\Controllers\representant\dossierController::class, 'monHistorique']);
    Route::get('representant/dossiers/{id}/effetsmarquants',  [App\Http\Controllers\representant\dossierController::class, 'effetsmarquants']);
    Route::delete('representant/dossiers/{id}/deleteHistorique', [App\Http\Controllers\representant\dossierController::class, 'deleteHistorique'])->name('representant.dossiers.deleteHistorique');
    Route::get('representant/dossiers/{id}/listeSupprimer',  [App\Http\Controllers\representant\dossierController::class, 'listeSupprimer']);
    Route::get('representant/dossiers/rechercher',  [App\Http\Controllers\representant\dossierController::class, 'rechercher']);
    Route::post('representant/dossiers/rechercher',  [App\Http\Controllers\representant\dossierController::class, 'getrechercher']);
    Route::get('representant/dossiers/{id}/ajouterdossier',  [App\Http\Controllers\representant\dossierController::class, 'ajouterdossier']);
    Route::GET('representant/dossiers/{id}/consultations/index',  [App\Http\Controllers\representant\consultationController::class, 'index']);
    Route::GET('representant/dossiers/{id}/consultations/create',  [App\Http\Controllers\representant\consultationController::class, 'create']);
    Route::GET('representant/dossiers/consultations/show/{id}',  [App\Http\Controllers\representant\consultationController::class, 'show']);
    Route::POST('representant/dossiers/consultations/store',  [App\Http\Controllers\representant\consultationController::class, 'store']);
    Route::GET('representant/dossiers/consultations/edit/{id}',  [App\Http\Controllers\representant\consultationController::class, 'edit']);
    Route::POST('representant/dossiers/consultations/update/{id}',  [App\Http\Controllers\representant\consultationController::class, 'update']);
    Route::GET('representant/dossiers/consultations/showExamenfiles/{id}',  [App\Http\Controllers\representant\consultationController::class, 'showExamenfiles']);
    Route::delete('representant/dossiers/consultations/deleteFile/{id}', [App\Http\Controllers\representant\consultationController::class, 'deleteFile'])->name('representant.dossiers.consultations.deleteFile');

    Route::GET('representant/dossiers/{id}/examenbios/index',  [App\Http\Controllers\representant\examenbioController::class, 'index']);
    Route::GET('representant/dossiers/{id}/examenbios/create',  [App\Http\Controllers\representant\examenbioController::class, 'create']);
    Route::GET('representant/dossiers/examenbios/show/{id}',  [App\Http\Controllers\representant\examenbioController::class, 'show']);
    Route::POST('representant/dossiers/examenbios/store',  [App\Http\Controllers\representant\examenbioController::class, 'store']);
    Route::GET('representant/dossiers/examenbios/edit/{id}',  [App\Http\Controllers\representant\examenbioController::class, 'edit']);
    Route::POST('representant/dossiers/examenbios/update/{id}',  [App\Http\Controllers\representant\examenbioController::class, 'update']);
    Route::GET('representant/dossiers/examenbios/showExamenfiles/{id}',  [App\Http\Controllers\representant\examenbioController::class, 'showExamenfiles']);
    Route::delete('representant/dossiers/examenbios/deleteFile/{id}', [App\Http\Controllers\representant\examenbioController::class, 'deleteFile'])->name('representant.dossiers.examenbios.deleteFile');

    Route::GET('representant/dossiers/{id}/examenradios/index',  [App\Http\Controllers\representant\examenradioController::class, 'index']);
    Route::GET('representant/dossiers/{id}/examenradios/create',  [App\Http\Controllers\representant\examenradioController::class, 'create']);
    Route::GET('representant/dossiers/examenradios/test',  [App\Http\Controllers\representant\examenradioController::class, 'test']);
    Route::GET('representant/dossiers/examenradios/show/{id}',  [App\Http\Controllers\representant\examenradioController::class, 'show']);
    Route::POST('representant/dossiers/examenradios/store',  [App\Http\Controllers\representant\examenradioController::class, 'store']);
    Route::GET('representant/dossiers/examenradios/edit/{id}',  [App\Http\Controllers\representant\examenradioController::class, 'edit']);
    Route::POST('representant/dossiers/examenradios/update/{id}',  [App\Http\Controllers\representant\examenradioController::class, 'update']);
    Route::GET('representant/dossiers/examenradios/showExamenfiles/{id}',  [App\Http\Controllers\representant\examenradioController::class, 'showExamenfiles']);
    Route::delete('representant/dossiers/examenradios/deleteFile/{id}', [App\Http\Controllers\representant\examenradioController::class, 'deleteFile'])->name('representant.dossiers.examenradios.deleteFile');

    Route::get('representant/medecins/index',  [App\Http\Controllers\representant\medecinController::class, 'index']);
    Route::get('representant/medecins/show/{id}',  [App\Http\Controllers\representant\medecinController::class, 'show']);
    Route::get('representant/medecins/create',  [App\Http\Controllers\representant\medecinController::class, 'create']);
    Route::post('representant/medecins/store',  [App\Http\Controllers\representant\medecinController::class, 'store']);

    Route::get('representant/coordinateurs/index',  [App\Http\Controllers\representant\coordinateurController::class, 'index']);
    Route::get('representant/coordinateurs/show/{id}',  [App\Http\Controllers\representant\coordinateurController::class, 'show']);
    Route::post('representant/coordinateurs/ajouter/{id}',  [App\Http\Controllers\representant\coordinateurController::class, 'ajouter']);
    Route::post('representant/coordinateurs/activer/{id}',  [App\Http\Controllers\representant\coordinateurController::class, 'activer']);
    Route::delete('representant/coordinateurs/supprimer/{id}',  [App\Http\Controllers\representant\coordinateurController::class, 'supprimer'])->name('representant.coordinateurs.supprimer');
    Route::post('representant/coordinateurs/store',  [App\Http\Controllers\representant\coordinateurController::class, 'store']);

    Route::GET('representant/demandeCons/index',  [App\Http\Controllers\representant\demandeConsController::class, 'index']);
    Route::GET('representant/demandeCons/{id}/create',  [App\Http\Controllers\representant\demandeConsController::class, 'create']);
    Route::post('representant/demandeCons/store',  [App\Http\Controllers\representant\demandeConsController::class, 'store']);
    Route::GET('representant/demandeCons/{id}/show',  [App\Http\Controllers\representant\demandeConsController::class, 'show']);
    Route::GET('representant/demandeCons/demande/{id}',  [App\Http\Controllers\representant\demandeConsController::class, 'demande']);
    Route::post('representant/demandeCons/{id}/affecter',  [App\Http\Controllers\representant\demandeConsController::class, 'affecter']);
    Route::post('representant/demandeCons/{id}/désactiver',  [App\Http\Controllers\representant\demandeConsController::class, 'désactiver']);
    Route::post('representant/demandeCons/{id}/cloturer',  [App\Http\Controllers\representant\demandeConsController::class, 'cloturer']);
    Route::get('representant/demandeCons/{id}/enAttenteInfos',  [App\Http\Controllers\representant\demandeConsController::class, 'attenteInfos']);
    Route::post('representant/demandeCons/{id}/enAttenteInfos',  [App\Http\Controllers\representant\demandeConsController::class, 'enAttenteInfos']);
    Route::get('representant/demandeInfos/repondre/{id}',  [App\Http\Controllers\representant\demandeInfosController::class, 'repDemandeInfos']);
    Route::post('representant/demandeInfos/storeRep',  [App\Http\Controllers\representant\demandeInfosController::class, 'storeRep']);
    Route::get('/markAsRead', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('mark');
});

//coordinateur
Route::middleware(['auth', 'check.role:4'])->group(function () {

    Route::get('coordinateur/dashboard', [App\Http\Controllers\coordinateur\notificationController::class, 'dashboard']);
    Route::post('coordinateur/mark-as-read/{id}',  [App\Http\Controllers\coordinateur\notificationController::class, 'read']);

    Route::get('coordinateur/myProfil', [App\Http\Controllers\coordinateur\coordinateurController::class, 'myProfil']);
    Route::post('coordinateur/update_information', [App\Http\Controllers\coordinateur\coordinateurController::class, 'update_information']);
    Route::post('coordinateur/update_general', [App\Http\Controllers\coordinateur\coordinateurController::class, 'update_general']);
    Route::post('coordinateur/updatemdp', [App\Http\Controllers\coordinateur\coordinateurController::class, 'updatemdp']);

    Route::get('/coordinateur/dossiers/index', [App\Http\Controllers\coordinateur\dossierController::class, 'index']);
    Route::post('coordinateur/dossiers/update/{id}',  [App\Http\Controllers\coordinateur\dossierController::class, 'update']);
    Route::post('coordinateur/dossiers/update_personal/{id}',  [App\Http\Controllers\coordinateur\dossierController::class, 'update_personal']);
    Route::post('coordinateur/dossiers/update_general/{id}',  [App\Http\Controllers\coordinateur\dossierController::class, 'update_general']);
    Route::post('coordinateur/dossiers/update_files/{id}',  [App\Http\Controllers\coordinateur\dossierController::class, 'update_files']);
    Route::post('coordinateur/dossiers/update_adress/{id}',  [App\Http\Controllers\coordinateur\dossierController::class, 'update_adress']);
    Route::get('coordinateur/dossiers/edit/{id}',  [App\Http\Controllers\coordinateur\dossierController::class, 'edit']);
    Route::post('coordinateur/dossiers/store',  [App\Http\Controllers\coordinateur\dossierController::class, 'store']);
    Route::get('coordinateur/dossiers/create',  [App\Http\Controllers\coordinateur\dossierController::class, 'create']);
    Route::get('coordinateur/dossiers/search',  [App\Http\Controllers\coordinateur\dossierController::class, 'search']);
    Route::delete('coordinateur/{id}/deleteDossier', [App\Http\Controllers\coordinateur\dossierController::class, 'deleteDossier'])->name('coordinateur.deleteDossier');
    Route::get('coordinateur/dossiers/show/{id}', [App\Http\Controllers\coordinateur\dossierController::class, 'show']);
    Route::delete('coordinateur/{id}/deleteFile', [App\Http\Controllers\coordinateur\dossierController::class, 'deleteFile'])->name('coordinateur.dossier.deleteFile');
    Route::get('coordinateur/dossiers/{id}/historiques',  [App\Http\Controllers\coordinateur\dossierController::class, 'historiques']);
    Route::get('coordinateur/dossiers/{id}/monHistorique',  [App\Http\Controllers\coordinateur\dossierController::class, 'monHistorique']);
    Route::get('coordinateur/dossiers/{id}/effetsmarquants',  [App\Http\Controllers\coordinateur\dossierController::class, 'effetsmarquants']);
    Route::delete('coordinateur/dossiers/{id}/deleteHistorique', [App\Http\Controllers\coordinateur\dossierController::class, 'deleteHistorique'])->name('coordinateur.dossiers.deleteHistorique');
    Route::get('coordinateur/dossiers/{id}/listeSupprimer',  [App\Http\Controllers\coordinateur\dossierController::class, 'listeSupprimer']);
    Route::get('coordinateur/dossier/request-access/{id}', [App\Http\Controllers\coordinateur\dossierController::class, 'requestAccess'])->name('coordinateur.dossier.request-access');


    Route::GET('coordinateur/{id}/consultation',  [App\Http\Controllers\coordinateur\consultationController::class, 'index']);
    Route::GET('coordinateur/dossiers/consultations/show/{id}',  [App\Http\Controllers\coordinateur\consultationController::class, 'show']);
    Route::GET('coordinateur/dossiers/consultations/showExamenfiles/{id}',  [App\Http\Controllers\coordinateur\consultationController::class, 'showExamenfiles']);

    Route::GET('coordinateur/dossiers/{id}/examenbios/index',  [App\Http\Controllers\coordinateur\examenbioController::class, 'index']);
    Route::GET('coordinateur/dossiers/{id}/examenbios/create',  [App\Http\Controllers\coordinateur\examenbioController::class, 'create']);
    Route::GET('coordinateur/dossiers/examenbios/show/{id}',  [App\Http\Controllers\coordinateur\examenbioController::class, 'show']);
    Route::POST('coordinateur/dossiers/examenbios/store',  [App\Http\Controllers\coordinateur\examenbioController::class, 'store']);
    Route::GET('coordinateur/dossiers/examenbios/edit/{id}',  [App\Http\Controllers\coordinateur\examenbioController::class, 'edit']);
    Route::POST('coordinateur/dossiers/examenbios/update/{id}',  [App\Http\Controllers\coordinateur\examenbioController::class, 'update']);
    Route::GET('coordinateur/dossiers/examenbios/showExamenfiles/{id}',  [App\Http\Controllers\coordinateur\examenbioController::class, 'showExamenfiles']);
    Route::delete('coordinateur/dossiers/examenbios/deleteFile/{id}', [App\Http\Controllers\coordinateur\examenbioController::class, 'deleteFile'])->name('coordinateur.dossiers.examenbios.deleteFile');

    Route::GET('coordinateur/dossiers/{id}/examenradios/index',  [App\Http\Controllers\coordinateur\examenradioController::class, 'index']);
    Route::GET('coordinateur/dossiers/{id}/examenradios/create',  [App\Http\Controllers\coordinateur\examenradioController::class, 'create']);
    Route::GET('coordinateur/dossiers/examenradios/test',  [App\Http\Controllers\coordinateur\examenradioController::class, 'test']);
    Route::GET('coordinateur/dossiers/examenradios/show/{id}',  [App\Http\Controllers\coordinateur\examenradioController::class, 'show']);
    Route::POST('coordinateur/dossiers/examenradios/store',  [App\Http\Controllers\coordinateur\examenradioController::class, 'store']);
    Route::GET('coordinateur/dossiers/examenradios/edit/{id}',  [App\Http\Controllers\coordinateur\examenradioController::class, 'edit']);
    Route::POST('coordinateur/dossiers/examenradios/update/{id}',  [App\Http\Controllers\coordinateur\examenradioController::class, 'update']);
    Route::GET('coordinateur/dossiers/examenradios/showExamenfiles/{id}',  [App\Http\Controllers\coordinateur\examenradioController::class, 'showExamenfiles']);
    Route::delete('coordinateur/dossiers/examenradios/deleteFile/{id}', [App\Http\Controllers\coordinateur\examenradioController::class, 'deleteFile'])->name('coordinateur.dossiers.examenradios.deleteFile');

    Route::get('coordinateur/medecins/index',  [App\Http\Controllers\coordinateur\medecinController::class, 'index']);
    Route::get('coordinateur/medecins/show/{id}',  [App\Http\Controllers\coordinateur\medecinController::class, 'show']);

    Route::get('coordinateur/coordinateurChef/show',  [App\Http\Controllers\coordinateur\coordinateurChefController::class, 'show']);

    Route::get('coordinateur/representants/index',  [App\Http\Controllers\coordinateur\representantController::class, 'index']);
    Route::get('coordinateur/representants/show/{id}',  [App\Http\Controllers\coordinateur\representantController::class, 'show']);
    Route::post('coordinateur/representants/{id}/activate', [App\Http\Controllers\coordinateur\representantController::class, 'activate'])->name('coordinateur.activate.representant');
    Route::post('coordinateur/representants/{id}/deactivate', [App\Http\Controllers\coordinateur\representantController::class, 'deactivate'])->name('coordinateur.deactivate.representant');
    Route::post('coordinateur/representants/store',  [App\Http\Controllers\coordinateur\representantController::class, 'store']);

    Route::GET('coordinateur/demandeCons/index',  [App\Http\Controllers\coordinateur\demandeConsController::class, 'index']);
    Route::GET('coordinateur/demandeCons/{id}/create',  [App\Http\Controllers\coordinateur\demandeConsController::class, 'create']);
    Route::post('coordinateur/demandeCons/store',  [App\Http\Controllers\coordinateur\demandeConsController::class, 'store']);
    Route::GET('coordinateur/demandeCons/{id}/show',  [App\Http\Controllers\coordinateur\demandeConsController::class, 'show']);
    Route::GET('coordinateur/demandeCons/demande/{id}',  [App\Http\Controllers\coordinateur\demandeConsController::class, 'demande']);
    Route::get('coordinateur/demandeCons/{id}/affecter',  [App\Http\Controllers\coordinateur\demandeConsController::class, 'affecter']);
    Route::post('coordinateur/demandeCons/affecter',  [App\Http\Controllers\coordinateur\demandeConsController::class, 'save']);
    Route::post('coordinateur/demandeCons/{id}/désactiver',  [App\Http\Controllers\coordinateur\demandeConsController::class, 'désactiver']);
    Route::post('coordinateur/demandeCons/{id}/cloturer',  [App\Http\Controllers\coordinateur\demandeConsController::class, 'cloturer']);
    Route::get('coordinateur/demandeCons/{id}/enAttenteInfos',  [App\Http\Controllers\coordinateur\demandeConsController::class, 'enAttenteInfos']);
    Route::post('coordinateur/demandeCons/{id}/storeDemandeInfos',  [App\Http\Controllers\coordinateur\demandeConsController::class, 'storeDemandeInfos']);
    Route::post('coordinateur/demandeCons/{id}/edit',  [App\Http\Controllers\coordinateur\demandeConsController::class, 'edit']);
    Route::post('coordinateur/prendre-en-charge/{notif}/{id}',  [App\Http\Controllers\coordinateur\demandeConsController::class, 'prendreEnCharge']);
    Route::post('coordinateur/prendre-en-charge/{id}',  [App\Http\Controllers\coordinateur\demandeConsController::class, 'prendreEnCharge1']);

    Route::get('coordinateur/demandeCons/{id}/demande-devis',  [App\Http\Controllers\coordinateur\demandeDevisController::class, 'demandeDevis']);
    Route::post('coordinateur/demandeDevis/ajouter-destinataire/{id}/{demande}',  [App\Http\Controllers\coordinateur\demandeDevisController::class, 'ajouterDestinataire']);
    Route::post('coordinateur/demandeDevis/supprimer-destinataire/{id}',  [App\Http\Controllers\coordinateur\demandeDevisController::class, 'supprimerDestinataire']);
    Route::post('coordinateur/demandeDevis/{id}/storeDemandeDevis',  [App\Http\Controllers\coordinateur\demandeDevisController::class, 'storeDemandeDevis']);
    Route::post('coordinateur/demandeDevis/{id}/annulerDemandeDevis',  [App\Http\Controllers\coordinateur\demandeDevisController::class, 'annulerDemandeDevis']);
    Route::get('coordinateur/demandeDevis/{id}/show',  [App\Http\Controllers\coordinateur\demandeDevisController::class, 'show']);
    Route::get('coordinateur/demandeDevis/show-invoice/{id}',  [App\Http\Controllers\coordinateur\demandeDevisController::class, 'showInvoice']);

    Route::post('coordinateur/demandeDevis/store',  [App\Http\Controllers\coordinateur\demandeDevisController::class, 'store']);

    Route::get('coordinateur/devis/{id}/create',  [App\Http\Controllers\coordinateur\devisController::class, 'create']);
    Route::post('coordinateur/devis/store',  [App\Http\Controllers\coordinateur\devisController::class, 'store']);
    Route::get('coordinateur/devis/{id}/show',  [App\Http\Controllers\coordinateur\devisController::class, 'show']);
    Route::post('coordinateur/devis/storeInvoiceLine',  [App\Http\Controllers\coordinateur\devisController::class, 'storeInvoiceLine']);
    Route::post('coordinateur/devis/{id}/send',  [App\Http\Controllers\coordinateur\devisController::class, 'send']);
    Route::get('coordinateur/devis/{id}/print',  [App\Http\Controllers\coordinateur\devisController::class, 'print']);
    Route::get('coordinateur/devis/{id}/consulter/{notif}',  [App\Http\Controllers\coordinateur\notificationController::class, 'readInvoice']);

    //Discusion COORDINATEUR Patient
    Route::get('coordinateur/discussionsCoordPatient',  [App\Http\Controllers\coordinateur\coordinateurPatientDiscussionsController::class, 'discussions']);
    Route::get('coordinateur/discussionsCoordPatient/create', [App\Http\Controllers\coordinateur\coordinateurPatientDiscussionsController::class, 'create']);
    Route::get('coordinateur/discussionsCoordPatient/createbydossier/{id}', [App\Http\Controllers\coordinateur\coordinateurPatientDiscussionsController::class, 'createbydossier']);
    Route::post('coordinateur/discussionsCoordPatient/store', [App\Http\Controllers\coordinateur\coordinateurPatientDiscussionsController::class, 'store']);
    Route::get('coordinateur/discussionsCoordPatient/envoye', [App\Http\Controllers\coordinateur\coordinateurPatientDiscussionsController::class, 'envoye']);
    Route::get('coordinateur/discussionsCoordPatient/recu', [App\Http\Controllers\coordinateur\coordinateurPatientDiscussionsController::class, 'recu']);
    Route::get('coordinateur/discussionsCoordPatient/cloture', [App\Http\Controllers\coordinateur\coordinateurPatientDiscussionsController::class, 'cloture']);
    Route::get('coordinateur/discussionsCoordPatient/recucloture', [App\Http\Controllers\coordinateur\coordinateurPatientDiscussionsController::class, 'cloturerecu']);
    Route::get('coordinateur/discussionsCoordPatient/envoyecloture', [App\Http\Controllers\coordinateur\coordinateurPatientDiscussionsController::class, 'clotureenvoye']);
    Route::get('coordinateur/discussionsCoordPatient/cloturer/{id}', [App\Http\Controllers\coordinateur\coordinateurPatientDiscussionsController::class, 'cloturer']);
    Route::get('coordinateur/discussionsCoordPatient/createbyid/{id}', [App\Http\Controllers\coordinateur\coordinateurPatientDiscussionsController::class, 'createbyid']);
    Route::get('coordinateur/discussionsCoordPatient/envoyeCloturer', [App\Http\Controllers\coordinateur\coordinateurPatientDiscussionsController::class, 'indexE_Cloturer']);
    Route::get('coordinateur/discussionsCoordPatient/recuCloturer', [App\Http\Controllers\coordinateur\coordinateurPatientDiscussionsController::class, 'indexR_Cloturer']);
    Route::get('coordinateur/discussionsCoordPatient/show/{slug}', [App\Http\Controllers\coordinateur\coordinateurPatientDiscussionsController::class, 'show']);
    Route::post('coordinateur/discussionsCoordPatient/reply/{id}', [App\Http\Controllers\coordinateur\coordinateurPatientDiscussionsController::class, 'reply']);
});

//coordinateurChef
Route::middleware(['auth', 'check.role:6'])->group(function () {

    Route::get('coordinateurChef/dashboard', [App\Http\Controllers\coordinateurChef\coordinateurChefController::class, 'dashboard']);
    Route::get('coordinateurChef/myProfil', [App\Http\Controllers\coordinateurChef\coordinateurChefController::class, 'myProfil']);
    Route::post('coordinateurChef/update_information', [App\Http\Controllers\coordinateurChef\coordinateurChefController::class, 'update_information']);
    Route::post('coordinateurChef/update_general', [App\Http\Controllers\coordinateurChef\coordinateurChefController::class, 'update_general']);

    Route::get('coordinateurChef/dossiers/index', [App\Http\Controllers\coordinateurChef\dossierController::class, 'index']);
    Route::post('coordinateurChef/dossiers/update/{id}',  [App\Http\Controllers\coordinateurChef\dossierController::class, 'update']);
    Route::post('coordinateurChef/dossiers/update_personal/{id}',  [App\Http\Controllers\coordinateurChef\dossierController::class, 'update_personal']);
    Route::post('coordinateurChef/dossiers/update_general/{id}',  [App\Http\Controllers\coordinateurChef\dossierController::class, 'update_general']);
    Route::post('coordinateurChef/dossiers/update_files/{id}',  [App\Http\Controllers\coordinateurChef\dossierController::class, 'update_files']);
    Route::post('coordinateurChef/dossiers/update_medical/{id}',  [App\Http\Controllers\coordinateurChef\dossierController::class, 'update_medical']);
    Route::post('coordinateurChef/dossiers/update_adress/{id}',  [App\Http\Controllers\coordinateurChef\dossierController::class, 'update_adress']);
    Route::get('coordinateurChef/dossiers/edit/{id}',  [App\Http\Controllers\coordinateurChef\dossierController::class, 'edit']);
    Route::post('coordinateurChef/dossiers/store',  [App\Http\Controllers\coordinateurChef\dossierController::class, 'store']);
    Route::get('coordinateurChef/dossiers/create',  [App\Http\Controllers\coordinateurChef\dossierController::class, 'create']);
    Route::get('coordinateurChef/dossiers/create_convention',  [App\Http\Controllers\coordinateurChef\dossierController::class, 'create_convention']);
    Route::delete('coordinateurChef/{id}/deleteDossier', [App\Http\Controllers\coordinateurChef\dossierController::class, 'deleteDossier'])->name('coordinateurChef.deleteDossier');
    Route::get('coordinateurChef/dossiers/show/{id}', [App\Http\Controllers\coordinateurChef\dossierController::class, 'show']);
    Route::delete('coordinateurChef/{id}/deleteFile', [App\Http\Controllers\coordinateurChef\dossierController::class, 'deleteFile'])->name('coordinateurChef.dossier.deleteFile');
    Route::get('coordinateurChef/dossiers/{id}/historiques',  [App\Http\Controllers\coordinateurChef\dossierController::class, 'historiques']);
    Route::get('coordinateurChef/dossiers/{id}/monHistorique',  [App\Http\Controllers\coordinateurChef\dossierController::class, 'monHistorique']);
    Route::get('coordinateurChef/dossiers/{id}/effetsmarquants',  [App\Http\Controllers\coordinateurChef\dossierController::class, 'effetsmarquants']);
    Route::delete('coordinateurChef/dossiers/{id}/deleteHistorique', [App\Http\Controllers\coordinateurChef\dossierController::class, 'deleteHistorique'])->name('coordinateurChef.dossiers.deleteHistorique');
    Route::get('coordinateurChef/dossiers/{id}/listeSupprimer',  [App\Http\Controllers\coordinateurChef\dossierController::class, 'listeSupprimer']);

    Route::GET('coordinateurChef/dossiers/{id}/consultations/index',  [App\Http\Controllers\coordinateurChef\consultationController::class, 'index']);
    Route::GET('coordinateurChef/dossiers/{id}/consultations/create',  [App\Http\Controllers\coordinateurChef\consultationController::class, 'create']);
    Route::GET('coordinateurChef/dossiers/consultations/show/{id}',  [App\Http\Controllers\coordinateurChef\consultationController::class, 'show']);
    Route::POST('coordinateurChef/dossiers/consultations/store',  [App\Http\Controllers\coordinateurChef\consultationController::class, 'store']);
    Route::GET('coordinateurChef/dossiers/consultations/edit/{id}',  [App\Http\Controllers\coordinateurChef\consultationController::class, 'edit']);
    Route::POST('coordinateurChef/dossiers/consultations/update/{id}',  [App\Http\Controllers\coordinateurChef\consultationController::class, 'update']);
    Route::GET('coordinateurChef/dossiers/consultations/showExamenfiles/{id}',  [App\Http\Controllers\coordinateurChef\consultationController::class, 'showExamenfiles']);
    Route::delete('coordinateurChef/dossiers/consultations/deleteFile/{id}', [App\Http\Controllers\coordinateurChef\consultationController::class, 'deleteFile'])->name('coordinateurChef.dossiers.consultations.deleteFile');

    Route::GET('coordinateurChef/dossiers/{id}/examenbios/index',  [App\Http\Controllers\coordinateurChef\examenbioController::class, 'index']);
    Route::GET('coordinateurChef/dossiers/{id}/examenbios/create',  [App\Http\Controllers\coordinateurChef\examenbioController::class, 'create']);
    Route::GET('coordinateurChef/dossiers/examenbios/show/{id}',  [App\Http\Controllers\coordinateurChef\examenbioController::class, 'show']);
    Route::POST('coordinateurChef/dossiers/examenbios/store',  [App\Http\Controllers\coordinateurChef\examenbioController::class, 'store']);
    Route::GET('coordinateurChef/dossiers/examenbios/edit/{id}',  [App\Http\Controllers\coordinateurChef\examenbioController::class, 'edit']);
    Route::POST('coordinateurChef/dossiers/examenbios/update/{id}',  [App\Http\Controllers\coordinateurChef\examenbioController::class, 'update']);
    Route::GET('coordinateurChef/dossiers/examenbios/showExamenfiles/{id}',  [App\Http\Controllers\coordinateurChef\examenbioController::class, 'showExamenfiles']);
    Route::delete('coordinateurChef/dossiers/examenbios/deleteFile/{id}', [App\Http\Controllers\coordinateurChef\examenbioController::class, 'deleteFile'])->name('coordinateurChef.dossiers.examenbios.deleteFile');

    Route::GET('coordinateurChef/dossiers/{id}/examenradios/index',  [App\Http\Controllers\coordinateurChef\examenradioController::class, 'index']);
    Route::GET('coordinateurChef/dossiers/{id}/examenradios/create',  [App\Http\Controllers\coordinateurChef\examenradioController::class, 'create']);
    Route::GET('coordinateurChef/dossiers/examenradios/test',  [App\Http\Controllers\coordinateurChef\examenradioController::class, 'test']);
    Route::GET('coordinateurChef/dossiers/examenradios/show/{id}',  [App\Http\Controllers\coordinateurChef\examenradioController::class, 'show']);
    Route::POST('coordinateurChef/dossiers/examenradios/store',  [App\Http\Controllers\coordinateurChef\examenradioController::class, 'store']);
    Route::GET('coordinateurChef/dossiers/examenradios/edit/{id}',  [App\Http\Controllers\coordinateurChef\examenradioController::class, 'edit']);
    Route::POST('coordinateurChef/dossiers/examenradios/update/{id}',  [App\Http\Controllers\coordinateurChef\examenradioController::class, 'update']);
    Route::GET('coordinateurChef/dossiers/examenradios/showExamenfiles/{id}',  [App\Http\Controllers\coordinateurChef\examenradioController::class, 'showExamenfiles']);
    Route::delete('coordinateurChef/dossiers/examenradios/deleteFile/{id}', [App\Http\Controllers\coordinateurChef\examenradioController::class, 'deleteFile'])->name('coordinateurChef.dossiers.examenradios.deleteFile');


    Route::get('coordinateurChef/medecins/index',  [App\Http\Controllers\coordinateurChef\medecinController::class, 'index']);
    Route::get('coordinateurChef/medecins/show/{id}',  [App\Http\Controllers\coordinateurChef\medecinController::class, 'show']);
    Route::get('coordinateurChef/medecins/create',  [App\Http\Controllers\coordinateurChef\medecinController::class, 'create']);
    Route::post('coordinateurChef/medecins/store',  [App\Http\Controllers\coordinateurChef\medecinController::class, 'store']);

    Route::get('coordinateurChef/representants/index',  [App\Http\Controllers\coordinateurChef\representantController::class, 'index']);
    Route::get('coordinateurChef/representants/show/{id}',  [App\Http\Controllers\coordinateurChef\representantController::class, 'show']);
    Route::post('coordinateurChef/representants/ajouter/{id}',  [App\Http\Controllers\coordinateurChef\representantController::class, 'ajouter']);
    Route::post('coordinateurChef/representants/activer/{id}',  [App\Http\Controllers\coordinateurChef\representantController::class, 'activer']);
    Route::delete('coordinateurChef/representants/supprimer/{id}',  [App\Http\Controllers\coordinateurChef\representantController::class, 'supprimer'])->name('coordinateurChef.representants.supprimer');
    Route::post('coordinateurChef/representants/store',  [App\Http\Controllers\coordinateurChef\representantController::class, 'store']);

    Route::get('coordinateurChef/coordinateurs/index',  [App\Http\Controllers\coordinateurChef\coordinateurController::class, 'index']);
    Route::get('coordinateurChef/coordinateurs/show/{id}',  [App\Http\Controllers\coordinateurChef\coordinateurController::class, 'show']);
    Route::post('coordinateurChef/coordinateurs/ajouter/{id}',  [App\Http\Controllers\coordinateurChef\coordinateurController::class, 'ajouter']);
    Route::post('coordinateurChef/coordinateurs/activer/{id}',  [App\Http\Controllers\coordinateurChef\coordinateurController::class, 'activer']);
    Route::delete('coordinateurChef/coordinateurs/supprimer/{id}',  [App\Http\Controllers\coordinateurChef\coordinateurController::class, 'supprimer'])->name('coordinateurChef.coordinateurs.supprimer');
    Route::post('coordinateurChef/coordinateurs/store',  [App\Http\Controllers\coordinateurChef\coordinateurController::class, 'store']);

    Route::GET('coordinateurChef/demandeCons/index',  [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'index']);
    Route::GET('coordinateurChef/demandeCons/{id}/create',  [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'create']);
    Route::post('coordinateurChef/demandeCons/store',  [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'store']);
    Route::GET('coordinateurChef/demandeCons/{id}/show',  [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'show']);
    Route::GET('coordinateurChef/demandeCons/enAttente',  [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'enAttente']);
    Route::GET('coordinateurChef/demandeCons/monequipe',  [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'monequipe']);
    Route::get('coordinateurChef/demandeCons/coordinateur',  [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'update'])->name('coordinateurChef.coordinateur');
    Route::GET('coordinateurChef/demandeCons/demande/{id}',  [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'demande']);
    Route::post('coordinateurChef/demandeCons/{id}/désactiver',  [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'désactiver']);
    Route::post('coordinateurChef/demandeCons/{id}/cloturer',  [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'cloturer']);
    Route::get('coordinateurChef/demandeCons/{id}/enAttenteInfos',  [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'enattenteInfos']);
    Route::post('coordinateurChef/demandeCons/{id}/storeDemandeInfos',  [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'storeDemandeInfos']);
    Route::post('coordinateurChef/demandeCons/{id}/edit', [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'edit']);
    Route::post('coordinateurChef/prendre-en-charge/{notif}/{id}',  [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'prendreEnCharge']);
    Route::post('coordinateurChef/prendre-en-charge/{id}',  [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'prendreEnCharge1']);
    Route::get('coordinateurChef/demandeCons/{id}/liste_demandes_infos', [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'liste_demandes_infos']);
    Route::get('coordinateurChef/demandeCons/demande_infos/{id}', [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'demande_infos']);
    Route::get('coordinateurChef/demandeCons/consulter/{id}/{notif}', [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'consulter']);
    Route::get('coordinateurChef/demandeCons/{id}/affecter', [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'affecter']);
    Route::get('coordinateurChef/demandeCons/{id}/affecter_cchef', [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'affecter_chef']);
    Route::post('coordinateurChef/demandeCons/save', [App\Http\Controllers\coordinateurChef\demandeConsController::class, 'save']);

    Route::get('coordinateurChef/demandeCons/{id}/demande-devis',  [App\Http\Controllers\coordinateurChef\demandeDevisController::class, 'demandeDevis']);
    Route::post('coordinateurChef/demandeDevis/ajouter-destinataire/{id}/{demande}',  [App\Http\Controllers\coordinateurChef\demandeDevisController::class, 'ajouterDestinataire']);
    Route::post('coordinateurChef/demandeDevis/supprimer-destinataire/{id}',  [App\Http\Controllers\coordinateurChef\demandeDevisController::class, 'supprimerDestinataire']);
    Route::post('coordinateurChef/demandeDevis/store',  [App\Http\Controllers\coordinateurChef\demandeDevisController::class, 'store']);
    Route::post('coordinateurChef/demandeDevis/{id}/storeDemandeDevis',  [App\Http\Controllers\coordinateurChef\demandeDevisController::class, 'storeDemandeDevis']);
    Route::post('coordinateurChef/demandeDevis/{id}/annulerDemandeDevis',  [App\Http\Controllers\coordinateurChef\demandeDevisController::class, 'annulerDemandeDevis']);
    Route::get('coordinateurChef/demandeDevis/{id}/destinataires',  [App\Http\Controllers\coordinateurChef\demandeDevisController::class, 'destinataires']);
    Route::get('coordinateurChef/demandeDevis/{id}/resume',  [App\Http\Controllers\coordinateurChef\demandeDevisController::class, 'resume']);
    Route::get('coordinateurChef/demandeDevis/{id}/show',  [App\Http\Controllers\coordinateurChef\demandeDevisController::class, 'show']);
    Route::get('coordinateurChef/discussions', [App\Http\Controllers\coordinateurChef\discussionsController::class, 'index']);
});

//script choix medecin 
Route::get('get-state-list', [App\Http\Controllers\Controller::class, 'getStateList']);
Route::get('get-medecin-liste',  [App\Http\Controllers\DiscussionsController::class, 'getMedListe']);
Route::get('get-list-medecins',  [App\Http\Controllers\DossierController::class, 'ajouterMesMedecins']);
Route::get('get-meds', [App\Http\Controllers\DossierController::class, 'getListeMedecin']);
Route::get('get-med',  [App\Http\Controllers\DossierController::class, 'testListeMedecin']);

//get ville scripts
Route::get('get-medds',  [App\Http\Controllers\villeController::class, 'getListeMedecin']);
Route::get('get-ville-list', [App\Http\Controllers\villeController::class, 'getCities']);
Route::get('get-default-url', [App\Http\Controllers\medecinController::class, 'getDefaultUrl']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
