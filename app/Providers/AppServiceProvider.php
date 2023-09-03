<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer([
            'auth.registre',
        ], 'App\Http\View\Composers\RoleComposer');

        View::composer([
            'registreMedecin',
            'registrePatient',
            'auth.registre',
            'medecin.dossiers.create',
            'medecin.editMonProfil',
            'medecin.edit',
            'medecin.profile',
            'medecin.medecins.create',
            'patient.medecins.create',
            'patient.editMonProfil',
            'administrateur.medecins.edit',
            'administrateur.dossiers.create',
            'administrateur.medecins.create',
            'administrateur.medecins.edit',
            'coordinateur.medecins.create',
            'coordinateur.profile'
        ], 'App\Http\View\Composers\SexeComposer');

        View::composer([
            'registreMedecin',
            'registrePatient',
            'auth.registre',
            'medecin.dossiers.create',
            'medecin.edit',
            'medecin.profile',
            'medecin.dossiers.rechercher',
            'medecin.medecins.create',
            'medecin.editMonProfil',
            'medecin.discussionMedecin.create',
            'patient.tousmedecins',
            'patient.editmondossier',
            'patient.editMonProfil',
            'patient.discussions.create',
            'administrateur.medecins.edit',
            'administrateur.pays.index',
            'administrateur.dossiers.create',
            'administrateur.dossiers.edit',
            'administrateur.dossiers.examenradios.create',
            'administrateur.dossiers.examenradios.edit',
            'administrateur.medecins.create',
            'administrateur.medecins.edit',
            'coordinateur.dossiers.edit',
            'coordinateur.medecins.create',
            'coordinateur.profile'
        ], 'App\Http\View\Composers\CountryComposer');

        View::composer([
            'registreMedecin',
            'registrePatient',
            'medecin.dossiers.create',
            'medecin.edit',
            'administrateur.groupesanguins.index',
            'administrateur.dossiers.create',
            'administrateur.dossiers.edit',
            'patient.editmondossier',
            'coordinateur.dossiers.edit',
        ], 'App\Http\View\Composers\BloodtypeComposer');

        View::composer([
            'registrePatient',
            'auth.registre',
            'medecin.dossiers.create',
            'medecin.edit',
            'administrateur.dossiers.create',
            'administrateur.dossiers.edit',
            'patient.editmondossier',
            'coordinateur.dossiers.edit',
        ], 'App\Http\View\Composers\ProfessionComposer');

        View::composer([
            'medecin.dossiers.examenbios.edit',
            'patient.consultations.create',
            'administrateur.dossiers.consultations.create',
            'administrateur.dossiers.consultations.edit',
            'administrateur.dossiers.examenbios.create',
            'administrateur.dossiers.examenbios.edit',
            'administrateur.dossiers.examenradios.create',
            'administrateur.dossiers.examenradios.edit'
        ], 'App\Http\View\Composers\MedecinComposer');

        View::composer([
            'administrateur.dossiers.examenradios.create',
            'administrateur.dossiers.examenradios.edit',
            'medecin.examenradios.create',
            'medecin.examenradios.edit',
            'patient.examenradios.create',
            'patient.examenradios.edit'
        ], 'App\Http\View\Composers\RadioTypeComposer');

        View::composer([
            'medecin.consultations.create',
            'medecin.consultations.edit',
            'patient.consultations.create',
            'patient.consultations.edit',
            'administrateur.motifs.index',
            'administrateur.dossiers.consultations.create',
            'administrateur.dossiers.consultations.edit',
        ], 'App\Http\View\Composers\MotifComposer');

        View::composer([
            'registreMedecin',
            'auth.registre',
            'medecin.profile',
            'medecin.medecins.create',
            'medecin.editMonProfil',
            'medecin.discussionMedecin.create',
            'patient.medControle',
            'patient.examenradios.create',
            'patient.discussions.create',
            'administrateur.medecins.edit',
            'administrateur.specialites.index',
            'administrateur.medecins.create',
            'administrateur.medecins.edit',
            'coordinateur.medecins.create',
        ], 'App\Http\View\Composers\SpecialiteComposer');

        View::composer([
            'registreMedecin',
            'auth.registre',
            'medecin.profile',
            'medecin.medecins.create',
            'administrateur.medecins.edit',
            'administrateur.organismes.index',
            'administrateur.medecins.create',
            'administrateur.medecins.edit',
            'coordinateur.medecins.create',
        ], 'App\Http\View\Composers\OrganismeComposer');


        View::composer([
            'coordinateur.dossiers.edit',
        ], 'App\Http\View\Composers\ConventionComposer');

        View::composer([
            'patient.demandeCons.create',
            'coordinateur.demandeCons.demande-devis',
            'coordinateurChef.demandeCons.demande-devis'
        ], 'App\Http\View\Composers\TypedemandeComposer');

        View::composer([
            'patient.demandeCons.create',
            'coordinateur.demandeCons.create',
            'coordinateurChef.demandeCons.create',
        ], 'App\Http\View\Composers\StatusdemandeComposer');
   
        View::composer([
            'medecin.devis.show-invoice',
            'coordinateur.devis.show',
        ], 'App\Http\View\Composers\ActeComposer');
   
    }
}
