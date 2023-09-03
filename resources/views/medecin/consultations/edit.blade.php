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

<div class="card">
    <form method="POST" action="{{url('medecin/consultation/update/'.$consultation->id)}}" enctype="multipart/form-data"> {{csrf_field()}}
        <div class="card-header">
            <div class="card-title">Modifier consultation</div>
        </div>
        <div class="card-body row">
            <div class="col-6">
                <label for="date"><b>Date:</b></label>
                <input class="form-control" name="date" type="date" id="d" value="{{old('date',$consultation->date?? null)}}">
            </div>
            <div class="col-6">
                <label for="motif"><b>Motif:</b></label>
                <select class="form-control" name="motif" id="motif">
                    @if($consultation->motif_id)<option value="{{$consultation->Motif->id}}">{{$consultation->Motif->lib}}</option>@endif
                    @foreach ($Motifs as $motif)
                    <option value="{{$motif->id}}">{{$motif->lib}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <div class="form-group"><label for="taille"><b>Taille: </b></label>
                    <input class="form-control" name="taille" id="taille" type="text" value="{{old('taille', $consultation->taille?? null)}}">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="poids"><b>Poids:</b></label>
                    <input class="form-control" name="poids" id="poids" type="text" value="{{old('poids', $consultation->poids?? null)}}">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="ta"><b>TA:</b></label>
                    <input class="form-control" name="ta" id="ta" type="text" value="{{old('ta', $consultation->ta ?? null)}}">
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
                <label for="observation"><b>Rapport:</b></label>
                <textarea class="form-control" id="observation" name="observation" placeholder="observation" cols="30" rows="30"> {{old('observation', $consultation->observation ?? null)}}</textarea>
                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" hidden>
                    Le rapport est obligatoire !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
            <div class="col-12">
                <label for="observation_prive"><b>Observation privée <small><b class="red">( affiché pour vous uniquement )</b></small></b></label>
                <textarea class="ckeditor form-control" id="observation_prive" name="observation_prive" placeholder="Observation privé">{{old('observation_prive', $consultation->observation_prive ?? null)}}</textarea>
            </div>
            <div class="col-12">
                <label for="effet_marquant_txt">Cochez si vous voulez ajouter un antécédant:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" class="form-check-input" name="effet_marquant" id="option" value="{{old('option')}}" onclick="myFunction()">
                <small><b class="red">( tout ce qui est affiché en antécédent sera répertorié dans l'historique du patient ) </b></small>
                <textarea class="form-control" id="effet_marquant_txt" name="effet_marquant_txt" placeholder="Antécédant">
                {{old('effet_marquant_txt', $consultation->effet_marquant_txt ?? null)}}
                </textarea>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                <i data-feather="save"></i> Enregistrer modifications
            </button>
        </div>
    </form>
    @if($consultation->files->count()!=0)
    <div class="card-header">
        <div class="card-title">Liste de téléchargement</div>
    </div>
    <div class="card-body">
        @foreach($consultation->files as $f)
        <div class="row">
            <a href=" {{url('/uploads/consultation/'.$f->downloads)}}"> <i data-feather="paperclip"></i> {{$f->downloads}}</a>
            <form action="{{ route('medecin.consultation.deleteFile', $f->id) }}" method="POST" style="display:inline;"> {{ csrf_field() }} {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier {{ $f->downloads }} de vos téléchargements?')"><i data-feather="trash"></i></button>
            </form>
        </div>
        @endforeach
    </div>
    @endif
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
    function myFunction() {
        var checkbox = document.getElementById("option");
        var text = document.getElementById("effet_marquant_txt");
        var disabled = document.getElementById("effet_marquant_txt").disabled;
        if (checkbox.checked == true) {
            effet_marquant_txt.style.display = "block";
            document.getElementById("effet_marquant_txt").disabled = false;
        } else {
            effet_marquant_txt.style.display = "none";
            document.getElementById("effet_marquant_txt").disabled = true;
        }
    }
</script>
<script>
    CKEDITOR.replace('observation');
</script>
<script>
    var b_submit = document.getElementById("b_submit");
    var msg = document.getElementById("msg");
    b_submit.addEventListener('click', valider);

    function valider(e) {
        if ((CKEDITOR.instances.observation.getData() == '') || (CKEDITOR.instances.observation.getData() == null) || (CKEDITOR.instances.observation.getData() == undefined)) {
            e.preventDefault();
            msg.hidden = false;
        } else {
            msg.hidden = true;
            return confirm('Voulez-vous vraiment enregistrer cette consultation?  Vous ne pourrez plus apporter des modifications');
        }
    }
</script>
@endsection