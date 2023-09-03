@extends('layouat.layaoutMedecin')
@section('contenu')

<div class="row">
    <div class="col-lg-2 col-3">
        <ul class="timeline">
            <a href="{{url('/medecin/forum/create')}}" class="list-group-item list-group-item-action active">
                <i data-feather="plus-circle" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Nouvelle discussion</span>
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
        </ul>
    </div>
    <div class="col-lg-10 col-9">
        <form method="POST" action="{{url('/medecin/forum/store')}}" enctype="multipart/form-data"> @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Nouvelle discussion</div>
                </div>
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
                        <label for="dossier">Choisir dossier:</label>
                        <select name="dossier_id" id="dossier_id" class="form-control">
                            <option selected value="">Choisi un dossier</option>
                            @foreach($dossiers as $dossier)
                            <option value="{{$dossier->id}}">{{$dossier->id}}: {{$dossier->user->prenom}} {{$dossier->user->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for=""><b>Médecin destintaire:</b></label>
                    </div>
                    <div class="col-12">
                        <input type="text" id="filter_input" class="form-control">
                    </div>
                    <div class="col-12 mt-1">
                        <select name="destination_id" id="user_select" class="form-control">
                            @foreach($meds as $med)
                            <option value="{{$med->id}}"> {{$med->prenom}} {{$med->nom}} , {{$med->Specialite->lib}} , {{$med->Country->lib}} @if($med->ville_id){{$med->Ville->name}}@endif</option>
                            @endforeach
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
                </div>
                <div class="card-footer">
                    <button class="btn btn-block btn-primary" type="submit" id="b_submit">
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
    var select = document.getElementById("option");
    var text = document.getElementById("url_radio");
    var disabled = document.getElementById("url_radio").disabled;
    if (select.value == "Autres") {
        url_radio.style.display = "block";
        document.getElementById("url_radio").disabled = false;
    } else {
        url_radio.style.display = "none";
        document.getElementById("url_radio").disabled = true;
    }
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

<script>
    $(document).ready(function() {
        let allOptions = $('#user_select option').clone();

        $('#filter_input').keyup(filterUsers);

        function filterUsers() {
            let filterValue = $('#filter_input').val().toLowerCase();
            let keywords = filterValue.split(' ').filter(keyword => keyword !== '');

            $('#user_select').empty();

            allOptions.filter(function() {
                let userText = $(this).text().toLowerCase();
                return keywords.every(keyword => userText.includes(keyword));
            }).appendTo('#user_select');
        }
    });
</script>
@endsection