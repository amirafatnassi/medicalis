@extends('layouat.layoutCoordinateur')
@section('contenu')
<div class="card">
    <div class="card-body row">
        <div class="col-6">
            <div class="user-avatar-section">
                <div class="d-flex justify-content-start">
                    <img class="img-fluid rounded" src="{{asset('uploads/users/'.($dossier->user->image??'user.png'))}}" height="110" width="110" alt="avatar" />
                    <div class="d-flex flex-column ml-1">
                        <div class="user-info mb-1">
                            <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->user->prenom}} {{$dossier->user->nom}}</h4>
                            <span class="card-text">{{$dossier->user->email}}</span>
                        </div>
                        <div class="d-flex flex-wrap">
                            <a href="{{url('coordinateur/dossiers/edit/'.$dossier->id)}}" class="btn btn-primary"> <i data-feather="edit-2"></i></a>
                            <a class="btn btn-outline-primary ml-1" href="">
                                <i data-feather="printer"></i>
                            </a>
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
                    <p class="card-text mb-0">{{$dossier->user->Country->lib}}</p>
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
<div class="card">
    <form method="POST" action="{{url('coordinateur/demandeCons/'.$demande->id.'/storeDemandeInfos')}}" enctype="multipart/form-data"> {{csrf_field()}}
    <div class="card-header"><div class="card-title">Demande informations complémentaire</div></div>    
    <div class="card-body">
            <div class="col-12">
                <label for="observation"><b>Rapport:</b></label>
                <textarea class="form-control" id="observation" name="observation" placeholder="observation" cols="30" rows="10">{{old('observation') }}</textarea>
                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" hidden>
                    Le rapport est obligatoire !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
            <div class="col-12">
                <input type="text" name="demande_cons_id" value="{{$demande->id}}" hidden>
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
            <button class="btn btn-primary" type="submit">
                <i data-feather="send"></i> Envoyer
            </button>
        </div>

    </form>
</div>
</div>


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
@endsection