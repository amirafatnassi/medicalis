@extends('layouat.layoutAdmin')
@section('contenu')
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        @if($dossier->image!==null)
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="105" width="105" alt="avatar" />
                        @else
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/user.png')}}" height="105" width="105" alt="avatar" />
                        @endif
                        <div class="d-flex flex-column ml-1">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                                <span class="card-text">{{$dossier->email}}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="" class="btn btn-primary"><i data-feather="edit-3"></i></a>
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
                            <i data-feather="flag"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Pays: </span>
                        </div>
                        <p class="card-text mb-0">{{$dossier->pays}}</p>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="user-info-title">
                            <i data-feather="phone"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Tel: </span>
                        </div>
                        <p class="card-text mb-0">{{$dossier->tel}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="POST" action="{{url('administrateur/dossiers/examenradios/store')}}" enctype="multipart/form-data"> @csrf
    <div class="card">
        <div class="card-header">
            <div class="card-title">Nouveau examen radio</div>
        </div>
        <div class="card-body row">
            <div class="col-6">
                <label for="date">Date:</label>
                <input class="form-control" name="date" id="date" type="date" value="{{old('date',now()->toDateString() ?? null)}}">
            </div>
            <div class="col-6">
                <label for="médecin">Médecin:</label>
                <select class="form-control" name="id_medecin" id="id_medecin">
                    @foreach($Medecins as $medecin)
                    <option value="{{$medecin->id}}">{{$medecin->prenom}} {{$medecin->nom}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="type_radio">Modalité:</b></label>
                    <select id="type_radio" name="type_radio" class="form-control">
                        <option value="" selected disabled>Select</option>
                        @foreach($RadioTypes as $radiotype)
                        <option value="{{$radiotype->id}}">{{$radiotype->lib}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="radio">Examen:</label>
                    <select name="radio" id="radio" class="form-control" onchange="myFunction1()"></select>
                </div>
            </div>
            <div class="col-6"></div>
            <div class="col-6">
                <label for="nv_ex">Autres (à saisir manuellement):</label>
                <input class="form-control" id="nv_ex" name="nv_ex" placeholder="nv_ex" disabled>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="url_radio">URL Pacs:</label>
                    <select class="form-control" name="option" id="option" onchange="myFunction()"></select>
                </div>
            </div>
            <div class="col-6">
                <label for="url_radio">URL Pacs (à saisir manuellement):</label>
                <input class="form-control" id="url_radio" name="url_radio" placeholder="url radio" disabled>
            </div>
            <div class="col-6">
                <label for="target">Pièce jointe (compte rendu ou autres):</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                        <label class="custom-file-label" id="filename">Choisir fichier</label>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <label for="target">zip:</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="target[]" class="custom-file-input" multiple id="target">
                        <label class="custom-file-label" id="filename">Choisir fichier</label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <label for="lettre">Compte rendu ou observations:</label>
            </div>
            <div class="col-12">
                <textarea class="ckeditor form-control" id="lettre" name="lettre" placeholder="observation" cols="30" rows="30">{{old('lettre') }}</textarea>
                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" hidden>
                    Le rapport est obligatoire !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>

            <div class="col-12">
                <input type="hidden" value="{{$dossier->id}}" name="dossier">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                <i data-feather="save"></i>
                Enregistrer examen radio
            </button>
        </div>
    </div>
</form>


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
    $('#id_medecin').change(function() {
        var medecinID = $(this).val();
        if (medecinID) {
            $.ajax({
                type: "GET",
                url: "{{url('get-default-url-pacs')}}?id_medecin=" + medecinID,
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
// <script type="text/javascript">
//     jQuery(document).ready(function() {
//         jQuery('select[name="radiotype"]').on('change', function() {
//             var radioTypeID = jQuery(this).val();
//             if (radioTypeID) {
//                 jQuery.ajax({
//                     url: 'dropdownlist/getradios/' + radioTypeID,
//                     type: "GET",
//                     dataType: "json",
//                     success: function(data) {
//                         console.log(data);
//                         jQuery('select[name="radio"]').empty();
//                         jQuery.each(data, function(key, value) {
//                             $('select[name="radio"]').append('<option value="' + key + '">' + value + '</option>');
//                         });
//                     }
//                });
//            } else {
//                $('select[name="radio"]').empty();
//            }
//       });
//    });
//</script>

<script>
    var b_submit = document.getElementById("b_submit");
    var type_radio = document.getElementById("type_radio");
    var radio = document.getElementById("radio");
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
        var select_ex = document.getElementById("radio");
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
    $('#type_radio').change(function() {
        var countryID = $(this).val();
        if (countryID) {
            $.ajax({
                type: "GET",
                url: "{{url('get-state-list')}}?type_radio=" + countryID,
                success: function(res) {
                    if (res) {
                        $("#radio").empty();
                        $("#radio").append('<option value="">Select</option>');
                        $.each(res, function(key, value) {
                            $("#radio").append('<option value="' + key + '">' + value + '</option>');
                        });
                    } else {  
                        $("#radio").empty();$("#radio").append('<option value="">emmmpty</option>');
                    }
                }
            });
        } else { 
            $("#radio").empty(); $("#radio").append('<option value="">wwww</option>');
        }
    });
</script>
@endsection