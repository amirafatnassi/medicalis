@extends('layouat.layaoutMedecin')
@section('contenu')

<div class="card user-card">
    <div class="card-body row">
        <div class="col-6">
            <div class="user-avatar-section">
                <div class="d-flex justify-content-start">
                    <img class="img-fluid rounded" src="{{asset('uploads/users/'.($dossier->user->image??'user.png'))}}" height="104" width="104" alt="User avatar" />
                    <div class="d-flex flex-column ml-1">
                        <div class="user-info mb-1">
                            <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->user->prenom}} {{$dossier->user->nom}}</h4>
                            <span class="card-text">{{$dossier->user->email}}</span>
                        </div>
                        <div class="d-flex flex-wrap">
                            <a href="" class="btn btn-primary"><i data-feather="edit-3"></i></a>
                            <a class="btn btn-outline-primary ml-1" href=""><i data-feather="printer"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="user-info-wrapper">
                <div class="d-flex flex-wrap my-50">
                    <div class="user-info-title">
                        <i data-feather="flag" class="mr-1"></i>
                        <span class="card-text user-info-title font-weight-bold mb-0">Pays: </span>
                    </div>
                    <p class="card-text mb-0">{{$dossier->user->country->lib}}</p>
                </div>
                <div class="d-flex flex-wrap">
                    <div class="user-info-title">
                        <i data-feather="phone" class="mr-1"></i>
                        <span class="card-text user-info-title font-weight-bold mb-0">Tel: </span>
                    </div>
                    <p class="card-text mb-0">{{$dossier->user->tel}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<form method="POST" action="{{url('medecin/examenbio/store')}}" enctype="multipart/form-data"> @csrf
    <div class="card">
        <div class="card-header">
            <div class="card-title">Nouveau examen bio:</div>
        </div>
        <div class="card-body row">
            <div class="col-12">
                <label for="date"><b class="blueLabel">Date:</b></label>
                <input class="form-control" name="date" id="date" type="date" value="{{old('date',now()->toDateString() ?? null)}}">
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
                <select class="form-control" name="option" id="option" onchange="myFunction()">
                    <option>{{Auth::user()->url_bio}}</option>
                    <option>Autres</option>
                </select>
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
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                <i data-feather="save" class="mr-1"></i>Enregistrer examen bio
            </button>
        </div>
    </div>
</form>

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
<!-- Dashboard Ecommerce ends -->

</div>
</div>
</div>
<!-- END: Content-->
@endsection