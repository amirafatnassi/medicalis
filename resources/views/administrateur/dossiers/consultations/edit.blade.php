@extends('layouat.layoutAdmin')
@section('contenu')

<div class="card user-card">
    <div class="card-body row">
        <div class="col-6">
            <div class="user-avatar-section">
                <div class="d-flex justify-content-start">
                    <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="104" width="104" alt="User avatar" />
                    <div class="d-flex flex-column ml-1">
                        <div class="user-info mb-1">
                            <h4 class="mb-0">Dossier médical n°: {{$dossier->idD}}: {{$dossier->patient}}</h4>
                            <span class="card-text">{{$dossier->email}}</span>
                        </div>
                        <div class="d-flex flex-wrap">
                            <a href="{{url('medecin/edit/'.$dossier->id)}}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                </svg></a>
                            <a class="btn btn-outline-primary ml-1" href="{{ url('medecin/imprimerDossier',['dossier'=>$dossier->idD])}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                                </svg>
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
<div class="card">
    <form method="POST" action="{{url('administrateur/dossiers/consultations/update/'.$consultation->id)}}" enctype="multipart/form-data"> {{csrf_field()}}
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
                    <option value="{{$consultation->id_motif}}">{{$consultation->Motif->lib}}</option>
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
            <div class="form-group{{$errors->has('id_dossier') ? ' has-error' : '' }}">
                <input type="hidden" value="{{$dossier->id}}" name="id_dossier">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                <i data-feather="save"></i>
                Enregistrer modifications
            </button>
        </div>
    </form>
</div>
@if(!empty($files))
<br>
<h5>Liste de téléchargement:</h5>
<table class="table" id="myTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fichier</th>
            <th>Visualiser</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        @foreach($files as $f)
        <tr>
            <td>{{$f->id}}</td>
            <td>{{$f->downloads}}</td>
            <td><a href="{{url('/uploads/consultation/'.$f->downloads)}}" class="btn btn-primary"> <i data-feather="eye"></i></a></td>
            <td><a href="javascript:;" data-toggle="modal" onclick="deleteData({{$f->id}})" data-target="#DeleteModal" class="btn btn-danger"><i class="fa fa-trash"></i>Supprimer</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
<div id="DeleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="" id="deleteForm" method="post">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Confirmation de suppression</h4>
                </div>
                <div class="modal-body">{{csrf_field()}} {{method_field('DELETE')}}
                    <p class="text-center">Vous avez demandez de supprimer un fichier parmi vos téléchargement,<br>voulez-vous confirmez ?</p>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Oui, supprimer!</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>
@endif
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
<script>
    $(document).ready(function() {
        $('#myTable').dataTable();
    });

    function deleteData(id) {
        var id = id;
        //alert (id);
        var url = '{{route("administrateur.dossiers.consultations.deleteFile",":id")}}';
        url = url.replace(':id', id);
        //alert (url);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit() {
        $("#deleteForm").submit();
    }
</script>
@endsection