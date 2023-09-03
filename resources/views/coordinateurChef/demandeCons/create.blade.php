@extends('menus.layoutCoordinateurChef')
@section('contenu')
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="110" width="110" alt="User avatar" />
                        <div class="d-flex flex-column ml-1">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                                <span class="card-text">{{$dossier->email}}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="{{url('coordinateurChef/dossiers/edit/'.$dossier->id)}}" class="btn btn-primary"> <i data-feather="edit-2"></i></a>
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
<form method="POST" action="{{url('coordinateurChef/demandeCons/store')}}" enctype="multipart/form-data"> {{csrf_field()}}
    <div class="row">
        <div class="col-12">
            <h5>
                <center><u>Nouvelle demande de consultation:</center></u>
            </h5>
        </div>
        <div class="col-6">
            <label for="dossier_id"><b>Dossier:</b></label>
            <select class="form-control" name="dossier_id" id="dossier_id">
                <option value="{{$dossier->id}}">{{$dossier->id}}: {{$dossier->prenom}} {{$dossier->nom}}</option>
            </select>
        </div>
        <div class="col-6">
            <label for="type_demande_id"><b>Type demande de consultation:</b></label>
            <select class="form-control" name="type_demande_id" id="type_demande_id">
                @foreach ($types_demandes as $t)
                <option value="{{$t->id}}">{{$t->lib}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <label for="coordinateur_en_charge"><b>Coordinateur en charge:</b></label>
            <select class="form-control" name="coordinateur_en_charge" id="coordinateur_en_charge">
                @foreach ($coordinateurs as $coordinateur)
                <option value="{{$coordinateur->id}}">{{$coordinateur->prenom}} {{$coordinateur->nom}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <label for="objet"><b>Objet:</b></label>
            <input type="text" class="form-control" name="objet">
        </div>
        <div class="col-12">
            <label for="observation"><b>Rapport:</b></label>
            <textarea class="form-control" id="observation" name="observation" placeholder="observation" cols="30" rows="30">{{old('observation') }}</textarea>
            <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" hidden>
                Le rapport est obligatoire !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
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
        <div class="col-12">
            <br>
            <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                <i data-feather="save" class="mr-1"></i>
                Enregistrer demande de consultation
            </button>
        </div>
    </div>
</form>

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
    CKEDITOR.replace('observation');
</script>
</section>
</div>
</div>
</div>
@endsection