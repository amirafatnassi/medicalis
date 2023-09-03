@extends('menus.layoutCoordinateurChef')
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
<form method="POST" action="{{url('coordinateurChef/dossiers/examenradios/store')}}" enctype="multipart/form-data"> @csrf
    <div class="row">
        <div class="col-12">
            <h5 class="blueLabel">
                <center><u>Nouveau examen radio:</u></center>
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
                @foreach ($liste_meds as $med)
                <option value="{{$med->id}}">{{$med->prenom}} {{$med->nom}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="typeradio"><b class="blueLabel">Modalité:</b></label>
                <select id="typeradio" name="typeradio" class="form-control">
                    <option value="" selected disabled>Select</option>
                    @foreach($countries as $key=>$country)
                    <option value="{{$key}}">{{$country}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="title"><b class="blueLabel">Examen:</b></label>
                <select name="state" id="state" class="form-control" onchange="myFunction1()"></select>
            </div>
        </div>
        <div class="col-6"></div>
        <div class="col-6">
            <label for="nv_ex"><b class="blueLabel">Autres (à saisir manuellement):</b></label>
            <input class="form-control" id="nv_ex" name="nv_ex" placeholder="nv_ex" disabled>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="url_radio"><b class="blueLabel">URL Pacs:</b></label>
                <select class="form-control" name="option" id="option" onchange="myFunction()"></select>
            </div>
        </div>
        <div class="col-6">
            <label for="url_radio"><b class="blueLabel">URL Pacs (à saisir manuellement):</b></label>
            <input class="form-control" id="url_radio" name="url_radio" placeholder="url radio" disabled>
        </div>
        <div class="col-6">
            <label for="target"><b class="blueLabel">Pièce jointe (compte rendu ou autres):</b></label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                    <label class="custom-file-label" id="filename">Choisir fichier</label>
                </div>
            </div>
        </div>
        <div class="col-6">
            <label for="target"><b class="blueLabel">zip:</b></label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="target[]" class="custom-file-input" multiple id="target">
                    <label class="custom-file-label" id="filename">Choisir fichier</label>
                </div>
            </div>
        </div>
        <div class="col-12">
            <label for="lettre"><b class="blueLabel">Compte rendu ou observations:</b></label>
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
        <div class="col-12">
            <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                <i data-feather="save" class="mr-1"></i>
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

</section>
</div>
</div>
</div>
@endsection