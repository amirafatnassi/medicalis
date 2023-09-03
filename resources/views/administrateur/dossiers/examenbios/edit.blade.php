@extends('layouat.layaoutMedecin')
@section('contenu')

<div class="card user-card">
    <div class="card-body">
        <div class="row">
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
                                    <i data-feather="edit-3"></i>
                                </a>
                                <a class="btn btn-outline-primary ml-1" href="{{ url('medecin/imprimerDossier',['dossier'=>$dossier->idD])}}">
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
<form method="POST" action="{{url('administrateur/dossiers/'.$examenbio->dossier.'/examenbio/update/'.$examenbio->id)}}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <h5 class="blueLabel">
                <center><u>Modifier examen bio:</u></center>
            </h5>
        </div>
        <div class="col-12">
            <label for="date"><b class="blueLabel">Date:</b></label>
            <input class="form-control" name="date" id="date" type="date" value="{{old('date',$examenbio->date?? null)}}">
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
        <div class="col-12">
            <label for="url_bio">URL Bio (à saisir manuellement):</label>
            <input class="form-control" id="url_bio" name="url_bio" placeholder="url bio" value="{{old('url_bio',$examenbio->url_bio?? null)}}">
        </div>
        <div class="col-12">
            <label for="lettre"><b class="blueLabel">Rapport:</b></label>
            <textarea class="form-control" id="lettre" name="lettre" placeholder="lettre">{{old('lettre',$examenbio->lettre?? null)}}</textarea>
            <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" hidden>
                Le rapport est obligatoire !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                <i data-feather="save" class="mr-1"></i>
                Enregistrer modifications
            </button>
        </div>
    </div>
</form>
@if(!empty($files))
<br>
<h5>Liste de téléchargements:</h5>
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
            <td><a href="{{url('/uploads/exbio/'.$f->downloads)}}" class="btn btn-primary"><i data-feather="eye" class="mr-1"></i></a></td>
            <td><a href="javascript:;" data-toggle="modal" onclick="deleteData({{$f->id}})" data-target="#DeleteModal" class="btn btn-danger"><i data-feather="trash"></i></a></td>
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
    CKEDITOR.replace('lettre');
</script>
<script>
    $(document).ready(function() {
        $('#myTable').dataTable();
    });

    function deleteData(id) {
        var id = id;
        var url = '{{route("administrateur.dossiers.examenbios.deleteFile",":id")}}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit() {
        $("#deleteForm").submit();
    }
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

@endsection