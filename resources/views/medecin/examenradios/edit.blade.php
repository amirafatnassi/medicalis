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
    <form method="POST" action="{{url('medecin/examenradio/update/'.$examenradio->id)}}" enctype="multipart/form-data"> @csrf
        <div class="card">
            <div class="card-header">
                <div class="card-title">Modifier examen radio</div>
            </div>
            <div class="card-body row">
                <div class="col-6">
                    <label for="date"><b>Date:</b></label>
                    <input class="form-control" name="date" id="date" type="date" value="{{old('date',$examenradio->date?? null)}}">
                </div>
                <div class="col-6">
                    <label for="medecin">Médecin:</label>
                    <select class="form-control" name="id_medecin" id="id_medecin">
                        <option value="{{$examenradio->medecin->id}}">{{$examenradio->medecin->prenom}} {{$examenradio->medecin->nom}}</option>
                    </select>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="typeradio"><b>Modalité:</b></label>
                        <select id="typeradio" name="typeradio" class="form-control">
                            <option value="{{$examenradio->typeradio->id}}" selected>{{$examenradio->typeradio->lib}}</option>
                            @foreach($RadioTypes as $radiotype)
                            <option value="{{$radiotype->id}}">{{$radiotype->lib}}</option>
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
                @if(!is_null($examenradio->url_radio))
                <div class="col-6">
                    <div class="form-group">
                        <label for="url_radio"><b>URL Pacs:</b></label>
                        <select class="form-control" name="option" id="option" onchange="myFunction()">
                            <option>Autres</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <label for="url_radio"><b>URL Pacs (à saisir manuellement):</b></label>
                    <input class="form-control" id="url_radio" name="url_radio" placeholder="url radio" value="{{old('nv_ex',$examenradio->url_radio ?? null)}}">
                </div>
                @else
                <div class="col-6">
                    <div class="form-group">
                        <label for="url_radio"><b>URL Pacs:</b></label>
                        <select class="form-control" name="option" id="option" onchange="myFunction()">
                            <option>{{Auth::user()->url_pacs}}</option>
                            <option>Autres</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <label for="url_radio"><b>URL Pacs (à saisir manuellement):</b></label>
                    <input class="form-control" id="url_radio" name="url_radio" placeholder="url radio" disabled>
                </div>
                @endif
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
            </div>
            <div class="card-footer">
                <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                    <i data-feather="save"></i>
                    Enregistrer examen radio
                </button>
            </div>
        </div>
    </form>
    @if(!$examenradio->files->isEmpty()) <br>
    <div class="card-body">
        <div class="card-title">Liste de téléchargements</div>
        @foreach($examenradio->files as $f)
        <div class="row">
            <a href="{{url('/uploads/exradio/'.$f->downloads)}}" class="btn btn-link"> <i data-feather="paperclip"></i> {{$f->downloads}}</a></td>
            <form action="{{ route('medecin.examenradio.deleteFile', $f->id) }}" method="POST" style="display:inline;"> {{ csrf_field() }} {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier de vos téléchargements {{ $f->downloads }} ?')"><i data-feather="trash"></i></button>
            </form>
        </div>
        @endforeach
    </div>
    @endif
</div>



<script>
    $(document).ready(function() {
        // Handle file upload changes
        $("#fileup").change(function() {
            var chaine = "";
            $.each(this.files, function(key, value) {
                chaine += value.name + ',';
            });
            $("#filename").text(chaine);
        });

        // Handle form submission
        $("#b_submit").click(function(e) {
            var type_radio = $("#typeradio");
            var radio = $("#state");

            if (type_radio.val() === '' && radio.val() === '') {
                e.preventDefault();
                type_radio.css("backgroundColor", "rgba(218, 79, 79, 0.3)");
                radio.css("backgroundColor", "rgba(218, 79, 79, 0.3)");
            } else if (type_radio.val() !== '' && radio.val() === '') {
                e.preventDefault();
                type_radio.css("backgroundColor", "rgba(255, 255, 255, 0.3)");
                radio.css("backgroundColor", "rgba(218, 79, 79, 0.3)");
            } else if (type_radio.val() === '') {
                e.preventDefault();
                type_radio.css("backgroundColor", "rgba(218, 79, 79, 0.3)");
                radio.css("backgroundColor", "rgba(255, 255, 255, 0.3)");
            } else if (radio.val() === '') {
                e.preventDefault();
                type_radio.css("backgroundColor", "rgba(255, 255, 255, 0.3)");
                radio.css("backgroundColor", "rgba(218, 79, 79, 0.3)");
            } else {
                return confirm('Voulez-vous vraiment enregistrer cet examen radio? Vous ne pourrez plus apporter des modifications');
            }
        });

        // Handle select change for URL radio
        $("#option").change(function() {
            var url_radio = $("#url_radio");
            if ($(this).val() === "Autres") {
                url_radio.css("display", "block");
                url_radio.prop("disabled", false);
            } else {
                url_radio.css("display", "none");
                url_radio.prop("disabled", true);
            }
        });

        // Handle select change for NV ex
        $("#state").change(function() {
            var nv_ex = $("#nv_ex");
            if (
                $(this).val() === "13" ||
                $(this).val() === "19" ||
                $(this).val() === "20" ||
                $(this).val() === "21"
            ) {
                nv_ex.css("display", "block");
                nv_ex.prop("disabled", false);
            } else {
                nv_ex.css("display", "none");
                nv_ex.prop("disabled", true);
            }
        });

        $(document).on('change', '#typeradio', function() {
        var typeradio = $(this).val();
        var stateSelect = $("#state");

        if (typeradio) {
            $.ajax({
                type: "GET",
                url: "{{ url('get-state-list') }}/" + typeradio, // Adjust the URL to include the typeradio value
                success: function(res) {
                    stateSelect.empty();
                    if (res) {
                        stateSelect.append('<option value="">Select</option>');
                        $.each(res, function(key, value) {
                            stateSelect.append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                }
            });
        } else {
            stateSelect.empty();
        }
    });

    });
</script>
@endsection