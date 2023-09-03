@extends('layouat.layoutAdmin')
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
                                <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->patient}}</h4>
                                <span class="card-text">{{$dossier->email}}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="{{url('medecin/edit/'.$dossier->idD)}}" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
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
<form method="POST" action="{{url('medecin/'.$examenradio->dossier.'/examenradio/update/'.$examenradio->id)}}" enctype="multipart/form-data"> @csrf
    <div class="row">
        <div class="col-12">
            <h5>
                <center><u>Modifier examen radio:</u></center>
            </h5>
        </div>
        <div class="col-6">
            <label for="date"><b>Date:</b></label>
            <input class="form-control" name="date" id="date" type="date" value="{{old('date',$examenradio->date?? null)}}">
        </div>
        <div class="col-6"></div>
        <div class="col-6">
            <div class="form-group">
                <label for="typeradio"><b>Modalité:</b></label>
                <select id="typeradio" name="typeradio" class="form-control">
                    <option value="{{$examenradio->typeradio->id}}" selected>{{$examenradio->typeradio->lib}}</option>
                    @foreach($RadioTypes as $key=>$country)
                    <option value="{{$key}}">{{$country}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="title"><b>Examen:</b></label>
                <select name="state" id="state" class="form-control" onchange="myFunction1()">
                    <option value="{{$examenradio->Radio->id}}" selected>{{$examenradio->Radio->lib}}</option>
                </select>
            </div>
        </div>
        <div class="col-6"></div>
        @if(!is_null($examenradio->radio2))
        <div class="col-6">
            <label for="nv_ex"><b>Autres (à saisir manuellement):</b></label>
            <input class="form-control" id="nv_ex" name="nv_ex" placeholder="nv_ex" value="{{old('nv_ex',$examenradio->radio2 ?? null)}}">
        </div>
        @else
        <div class="col-6">
            <label for="nv_ex"><b>Autres (à saisir manuellement):</b></label>
            <input class="form-control" id="nv_ex" name="nv_ex" placeholder="nv_ex" disabled value="{{old('nv_ex',$examenradio->radio2 ?? null)}}">
        </div>
        @endif
        <div class="col-6">
            <label for="url_radio"><b>URL Pacs (à saisir manuellement):</b></label>
            <input class="form-control" id="url_radio" name="url_radio" placeholder="url radio" value="{{old('nv_ex',$examenradio->url_radio ?? null)}}">
        </div>
        <div class="col-12">
            <label for="file"><b>Pièce jointe (compte rendu ou autres):</b></label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                    <label class="custom-file-label" id="filename">Choisir fichier</label>
                </div>
            </div>
        </div>
        <div class="col-12">
            <label for="lettre"><b>Compte rendu ou observations:</b></label>
        </div>
        <div class="col-12">
            <textarea class="ckeditor form-control" id="lettre" name="lettre" placeholder="observation" cols="30" rows="30">{{old('lettre',$examenradio->lettre??null) }}</textarea>
            <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" hidden>
                Le rapport est obligatoire !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                <i data-feather="save" class="mr-1"></i>
                Enregistrer examen radio
            </button>
        </div>
    </div>
</form>
@if(!empty($files)) <br>
<h5>Liste de téléchargements:</h5>
<table class="table" id="myTable">
    <thead class="thead-dark">
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
            <td><a href="{{url('/uploads/exradio/'.$f->downloads)}}" class="btn btn-primary"> <i data-feather="eye"></i></a></td>
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
    $(document).ready(function() {
        $('#myTable').dataTable();
    });

    function deleteData(id) {
        var id = id;
        var url = '{{route("administrateur.dossiers.examenradios.deleteFile",":id")}}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit() {
        $("#deleteForm").submit();
    }
</script>
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
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('select[name="radiotype"]').on('change', function() {
            var radioTypeID = jQuery(this).val();
            if (radioTypeID) {
                jQuery.ajax({
                    url: 'dropdownlist/getradios/' + radioTypeID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="radio"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="radio"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="radio"]').empty();
            }
        });
    });
</script>
<script>
    var b_submit = document.getElementById("b_submit");
    var type_radio = document.getElementById("typeradio");
    var radio = document.getElementById("state");
    var msg = document.getElementById("msg");
    b_submit.addEventListener('click', valider);

    function valider(e) {
        if ((type_radio.value == '') && (radio.value == '')) {
            e.preventDefault();
            type_radio.style.backgroundColor = "rgba(218, 79, 79, 0.3)";
            radio.style.backgroundColor = "rgba(218, 79, 79, 0.3)";
        } else if ((type_radio.value !== '') && (radio.value == '')) {
            e.preventDefault();
            type_radio.style.backgroundColor = "rgba(255, 255, 255, 0.3)";
            radio.style.backgroundColor = "rgba(218, 79, 79, 0.3)";
        } else if (type_radio.value == '') {
            e.preventDefault();
            type_radio.style.backgroundColor = "rgba(218, 79, 79, 0.3)";
            radio.style.backgroundColor = "rgba(255,255,255,0..3)";
        } else if (radio.value == '') {
            e.preventDefault();
            type_radio.style.backgroundColor = "rgba(255,255,255,0..3)";
            radio.style.backgroundColor = "rgba(218, 79, 79, 0.3)";
        } else {
            return confirm('Voulez-vous vraiment enregistrer cet examen radio?  Vous ne pourrez plus apporter des modifications');
        }
    }
</script>
<script>
    function myFunction() {
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
    }
</script>
<script>
    function myFunction1() {
        var select_ex = document.getElementById("state");
        var nv_ex = document.getElementById("nv_ex");
        var disabled1 = document.getElementById("nv_ex").disabled;
        if ((select_ex.value == 13) || (select_ex.value == 19) || (select_ex.value == 20) || (select_ex.value == 21)) {
            nv_ex.style.display = "block";
            document.getElementById("nv_ex").disabled = false;
        } else {
            nv_ex.style.display = "none";
            document.getElementById("nv_ex").disabled = true;
        }
    }
</script>

<script type="text/javascript">
    $('#typeradio').change(function() {
        var countryID = $(this).val();
        if (countryID) {
            $.ajax({
                type: "GET",
                url: "{{url('get-state-list')}}?typeradio=" + countryID,
                success: function(res) {
                    if (res) {
                        $("#state").empty();
                        $("#state").append('<option value="">Select</option>');
                        $.each(res, function(key, value) {
                            $("#state").append('<option value="' + key + '">' + value + '</option>');
                        });
                    } else {
                        $("#state").empty();
                    }
                }
            });
        } else {
            $("#state").empty();
        }
    });
</script>
@endsection