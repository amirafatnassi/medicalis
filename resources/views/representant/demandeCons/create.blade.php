@extends('menus.layoutRepresentant')
@section('contenu')
<div class="card user-card">
    <div class="row">
        <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
            <div class="user-avatar-section">
                <div class="d-flex justify-content-start">
                    @if($dossier->image!=null)
                    <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="105" width="105" alt="User avatar" />
                    @else
                    <img class="img-fluid rounded" src="{{asset('uploads/dossier/user.png')}}" height="105" width="105" alt="User avatar" />
                    @endif
                    <div class="d-flex flex-column ml-1">
                        <div class="user-info mb-1">
                            <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                            <span class="card-text">{{$dossier->email}}</span>
                        </div>
                        <div class="d-flex flex-wrap">
                            <a href="" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                </svg></a>
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
<form method="POST" action="{{url('representant/demandeCons/store')}}" enctype="multipart/form-data"> {{csrf_field()}}
    <h5 class="card-header">
        <center>Nouvelle demande de consultation:</center>
    </h5>
    <div class="card-body">
        <div class="col-6" hidden>
            <input type="text" value="{{$dossier->id}}" id="dossier_id" name="dossier_id" hidden />
        </div>
        <div class="col-6">
            <label for="type_demande_id"><b>Type de demande:</b></label>
            <select class="form-control" name="type_demande_id" id="type_demande_id">
                @foreach ($TypeDemandes as $typeDemande)
                <option value="{{$typeDemande->id}}">{{$typeDemande->lib}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <label for="file"><b>Objet:</b></label>
            <input type="text" name="objet" class="form-control" id="objet">
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
    </div>
    <div class="card-footer">
        <button class="btn btn-block btn-primary" type="submit" id="b_submit">
            <i data-feather="save" class="mr-1"></i>
            Enregistrer demande de consultation
        </button>
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