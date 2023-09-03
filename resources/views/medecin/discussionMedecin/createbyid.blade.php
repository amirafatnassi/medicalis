@extends('layouat.layaoutMedecin')
@section('contenu')

<div class="row">
    <div class="col-lg-2 col-3">
        <ul class="timeline">
            <div class="list-group list-group-messages">
                <a href="{{url('/medecin/forum/create')}}" class="list-group-item list-group-item-action active">
                    <i data-feather="plus-circle" class="font-medium-3 mr-50"></i>
                    <span class="align-middle">aaaNouvelle discussion</span>
                </a>
                <a href="{{url('/medecin/forum/recu')}}" class="list-group-item list-group-item-action">
                    <i data-feather="mail" class="font-medium-3 mr-50"></i>
                    <span class="align-middle">Discussions reçues</span>
                </a>
                <a href="{{url('/medecin/forum/envoye')}}" class="list-group-item list-group-item-action">
                    <i data-feather="send" class="font-medium-3 mr-50"></i>
                    <span class="align-middle">Envoyé</span>
                </a>

                <a href="{{url('/medecin/forum/cloture')}}" class="list-group-item list-group-item-action">
                    <i data-feather="info" class="font-medium-3 mr-50"></i>
                    <span class="align-middle">Messages Cloturés</span>
                </a>
                <a href="{{url('/medecin/forum/recucloture')}}" class="list-group-item list-group-item-action">
                    <i data-feather="info" class="font-medium-3 mr-50"></i>
                    <span class="align-middle">Discussions reçues cloturés</span>
                </a>
                <a href="{{url('/medecin/forum/envoyecloture')}}" class="list-group-item list-group-item-action">
                    <i data-feather="info" class="font-medium-3 mr-50"></i>
                    <span class="align-middle">Envoyé Cloturés</span>
                </a>
            </div>
        </ul>
    </div>
    <div class="col-lg-10 col-9">
        <form method="POST" action="{{url('/medecin/forum/storebyid')}}" enctype="multipart/form-data">
            @csrf
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
                <label for="dossier">Choisir dossier:</label>
                <select name="dossier_id" id="dossier_id" class="form-control">
                    <option selected>Non défini</option>
                    @foreach($dossiers as $dossier)
                    <option value="{{$dossier->id}}">{{$dossier->id}}: {{$dossier->prenom}} {{$dossier->nom}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label for="">Choisir médecin destinataire:</label>
                <select name="destination_id" id="destination_id" class="form-control">
                    <option value="{{$med->id}}">{{$med->prenom}} {{$med->nom}}</option>
                </select>
            </div>

            <div class="col-12">
                <label for="title">Sujet:</label>
                <input type="text" name="sujet" class="form-control" id="sujet">
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
            <div class="col-12">
                <br>
                <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                    <i data-feather="send"></i> Envoyer
                </button>
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
        } else {}
    }
</script>
@endsection