@extends('menus.layoutCoordinateur')
@section('contenu')
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="104" width="104" alt="User avatar" />
                        <div class="d-flex flex-column ml-1">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                                <span class="card-text">{{$dossier->email}}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="{{url('coordinateur/dossiers/edit/'.$dossier->id)}}" class="btn btn-primary"> <i data-feather="edit-2"></i></a>
                                <a class="btn btn-outline-primary ml-1" href="">
                                    <i data-feather="printer" class="mr-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                <div class="user-info-wrapper">
                    <div class="d-flex flex-wrap my-50">
                        <div class="user-info-title">
                            <i data-feather="flag" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Pays: </span>
                        </div>
                        <p class="card-text mb-0">{{$dossier->pays}}</p>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="user-info-title">
                            <i data-feather="phone" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Tel: </span>
                        </div>
                        <p class="card-text mb-0">{{$dossier->tel}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="POST" action="{{url('coordinateur/dossiers/examenbios/store')}}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <h5 class="blueLabel">
                <center><u>Nouveau examen bio:</u></center>
            </h5>
        </div>
        <div class="col-6">
            <label for="date"><b class="blueLabel">Date:</b></label>
            <input class="form-control" name="date" id="date" type="date" value="{{old('date',now()->toDateString() ?? null)}}">
        </div>
        <div class="col-6">
            <label for="motif"><b>Médecin:</b></label>
            <select class="form-control" name="id_medecin" id="id_medecin">
                <option value="">Undéterminé</option>
                @foreach ($Medecins as $med)
                <option value="{{$med->id}}">{{$med->prenom}} {{$med->nom}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <label for="file"><b class="blueLabel">Pièce jointe:</b></label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                    <label class="custom-file-label" id="filename">Choisir fichier</label>
                </div>
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
        <div class="col-6">
            <label for="url_bio"><b class="blueLabel">URL Bio:</b></label>
            <select class="form-control" name="option" id="option" onchange="myFunction()"></select>
        </div>
        <div class="col-6">
            <label for="url_bio">URL Bio (à saisir manuellement):</label>
            <input class="form-control" id="url_bio" name="url_bio" placeholder="url bio" disabled>
        </div>
        <div class="col-12">
            <label for="lettre"><b class="blueLabel">Rapport:</b></label>
            <textarea class="form-control" id="lettre" name="lettre" placeholder="lettre">{{old('lettre')}}</textarea>
            <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" hidden>
                Le rapport est obligatoire !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        </div>

        <div class="form-group{{ $errors->has('dossier') ? ' has-error' : '' }}">
            <input type="hidden" value="{{$dossier->id}}" id="lettre" name="dossier">
        </div>
        <div class="col-12">
            <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                <i data-feather="save" class="mr-1"></i>
                Enregistrer examen bio
            </button>
        </div>
    </div>
</form>

<script type="text/javascript">
    $('#id_medecin').change(function() {
        var medecinID = $(this).val();
        if (medecinID) {
            $.ajax({
                type: "GET",
                url: "{{url('get-default-url')}}?id_medecin=" + medecinID,
                success: function(res) {
                    if (res[0] !== null) {
                        $("#option").empty();
                        $("#option").append('<option value="">Select</option>');
                        $.each(res, function(key, value) {
                            $("#option").append('<option value="' + value + '">' + value + '</option>');
                        });
                        $("#option").append('<option>Autres</option>');
                    } else if (res[0] == null) {
                        $("#option").empty();
                        $("#option").append('<option value="">Select</option>');
                        $("#option").append('<option>Autres</option>');
                    }
                }
            });
        } else {
            $("#option").empty();
        }
    });
</script>
<script>
    CKEDITOR.replace('lettre');
</script>

<script>
    var b_submit = document.getElementById("b_submit");
    var lettre = document.getElementById("lettre");
    b_submit.addEventListener('click', valider);

    function valider(e) {
        if ((CKEDITOR.instances.lettre.getData() == '') || (CKEDITOR.instances.lettre.getData() == null) || (CKEDITOR.instances.lettre.getData() == undefined)) {
            e.preventDefault();
            msg.hidden = false;
        } else {
            msg.hidden = true;
            return confirm('Voulez-vous vraiment enregistrer cet examen?  Vous ne pourrez plus apporter des modifications');
        }
    }
</script>

<script>
    function myFunction() {
        var select = document.getElementById("option");
        var text = document.getElementById("url_bio");
        var disabled = document.getElementById("url_bio").disabled;
        if (select.value == "Autres") {
            url_bio.style.display = "block";
            document.getElementById("url_bio").disabled = false;
        } else {
            url_bio.style.display = "none";
            document.getElementById("url_bio").disabled = true;
        }
    }
</script>

</section>
</div>
</div>
</div>
@endsection