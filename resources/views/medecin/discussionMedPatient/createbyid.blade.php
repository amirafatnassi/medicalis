@extends('layouat.layaoutMedecin')
@section('contenu')

<div class="row">
    <div class="col-lg-2 col-3">
        <ul class="timeline">
            <a href="{{url('/medecin/forumMedPatient/create')}}" class="list-group-item list-group-item-action active">
                <i data-feather="plus-circle" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Nouvelle discussion</span>
            </a>
            <a href="{{url('/medecin/forumMedPatient/recu')}}" class="list-group-item list-group-item-action">
                <i data-feather="mail" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Discussions reçues</span>
            </a>
            <a href="{{url('/medecin/forumMedPatient/envoye')}}" class="list-group-item list-group-item-action">
                <i data-feather="send" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Envoyé</span>
            </a>
            <a href="{{url('/medecin/forumMedPatient/cloture')}}" class="list-group-item list-group-item-action">
                <i data-feather="info" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Messages Cloturés</span>
            </a>
            <a href="{{url('/medecin/forumMedPatient/recucloture')}}" class="list-group-item list-group-item-action">
                <i data-feather="info" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Discussions reçues cloturés</span>
            </a>
            <a href="{{url('/medecin/forumMedPatient/envoyecloture')}}" class="list-group-item list-group-item-action">
                <i data-feather="info" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Envoyé Cloturés</span>
            </a>
        </ul>
        <h6 class="section-label mt-3 mb-1 px-2">Carnet d'adresse de mes patients</h6>
        <div class="list-group list-group-labels">
            @forelse($liste_patients as $m)
            <ul class="timeline">
                <a href="{{url('/medecin/forumMedPatient/createbyid/'.$m->id)}}" class="list-group-item list-group-item-action">
                    <span class="bullet bullet-sm bullet-success mr-1"></span>
                    {{$m->id}}: {{$m->id_patient}}
                </a>
            </ul>
            @empty<span class="badge badge-danger">Liste de patients vide !</span>
            @endforelse
        </div>
    </div>
    <div class="col-lg-10 col-9">
        <form method="POST" action="{{url('/medecin/forumMedPatient/store')}}" enctype="multipart/form-data"> @csrf
            <div class="card">
                <div class="card-header">Nouvelle discussion</div>
                <div class="card-body row">
                    <div class="col-12">
                        <label>Type de discussion:</label>
                        <select name="type_courrier" id="type_courrier" class="form-control" required>
                            <option selected>Avis médical</option>
                            <option>Information libre</option>
                            <option>Téléradiologie</option>
                            <option>Demande devis</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="dossier">Destinataire:</label>
                        <select name="dossier_id" id="dossier_id" class="form-control">
                            <option value="{{$dossier->id}}"> {{$dossier->id}}: {{$dossier->user->prenom}} {{$dossier->user->nom}}</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="title">Sujet:</label>
                        <input type="text" name="title" class="form-control" id="sujet">
                    </div>
                    <div class="col-12">
                        <label for="content">Message:</label>
                        <textarea name="content" id="content" cols="30" rows="10" class="ckeditor form-control"></textarea>
                    </div>
                    <div class="col-12">
                        <label for="file">Pièce jointe:</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                                <label class="custom-file-label" id="filename">Choisir fichier</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit" id="b_submit">
                        <i data-feather="send"></i> Envoyer
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection