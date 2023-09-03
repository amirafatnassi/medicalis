@extends('layouat.layoutPatientNoHeader')
@section('contenu')

<div class="row">
    <div class="col-2">
        <ul class="timeline">
            <a href="{{url('/patient/discussions/create')}}" class="list-group-item list-group-item-action active">
                <i data-feather="plus-circle" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Nouvelle discussion</span>
            </a>
            <a href="{{url('/patient/discussions/recu')}}" class="list-group-item list-group-item-action">
                <i data-feather="mail" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Discussions reçues</span>
            </a>
            <a href="{{url('/patient/discussions/envoye')}}" class="list-group-item list-group-item-action">
                <i data-feather="send" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Discussions envoyé</span>
            </a>
            <a href="{{url('/patient/discussions/cloture')}}" class="list-group-item list-group-item-action">
                <i data-feather="info" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Discussions Cloturés</span>
            </a>
            <a href="{{url('/patient/discussions/recucloture')}}" class="list-group-item list-group-item-action">
                <i data-feather="info" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Discussions reçues cloturés</span>
            </a>
            <a href="{{url('/patient/discussions/envoyecloture')}}" class="list-group-item list-group-item-action">
                <i data-feather="info" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Discussions envoyé Cloturés</span>
            </a>
        </ul>
    </div>
    <div class="col-10">
        <form class="compose-form" method="POST" action="{{url('/patient/discussions/store')}}" enctype="multipart/form-data"> @csrf
            <div class="card">
                <div class="card-header">Nouvelle discussion</div>
                <div class="card-body row">
                    <div class="col-md-6 col-12">
                        <label><b>Type de discussion:</b></label>
                        <select name="type_courrier" id="type_courrier" class="form-control" required>
                            <option selected>Avis médical</option>
                            <option>Information libre</option>
                            <option>Téléradiologie</option>
                            <option>Demande devis</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="dossier"><b>Dossier médical:</b></label>
                        <select name="dossier_id" id="dossier_id" class="form-control">
                            <option value="{{$dossier->id}}">{{$dossier->id}}: {{$dossier->patient}}</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="destination_id"><b>Médecin destintaire:</b></label>
                        <select name="destination_id" id="destination_id" class="form-control">
                            <option value="{{$med->id}}">{{$med->nom}} {{$med->prenom}}</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="title"><b>Sujet:</b></label>
                        <input type="text" name="title" class="form-control" id="sujet">
                    </div>
                    <div class="col-12">
                        <label for="content"><b>Message:</b></label>
                        <textarea class="CKEDITOR form-control" id="content" name="content" placeholder="observation"></textarea>
                    </div>
                    <div class="col-12">
                        <label for="file"><b>Pièce jointe:</b></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                                <label class="custom-file-label" id="filename">Choisir fichier</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="b_submit">
                        <i data-feather="send"></i> Envoyer
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $.each(this.files, function(key, value) {
        alert(key + ": " + value);
    });
    $("#fileup").change(function() {
        var chaine = "";
        $.each(this.files, function(key, value) {
            chaine = chaine + value.name + ',';
        });
        $("#filename").text(chaine);
    });
</script>

<script>
    var b_submit = document.getElementById("b_submit");
    var sujet = document.getElementById("sujet");
    b_submit.addEventListener('click', valider);

    function valider(e) {
        if (sujet.value == '') {
            e.preventDefault();
            sujet.style.backgroundColor = "rgba(218, 79, 79, 0.3)";
        }
    }
</script>
<script>
    CKEDITOR.replace('content');
</script>
@endsection