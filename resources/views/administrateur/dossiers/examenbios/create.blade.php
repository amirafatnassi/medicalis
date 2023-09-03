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
                            <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                            <span class="card-text">{{$dossier->email}}</span>
                        </div>
                        <div class="d-flex flex-wrap">
                            <a href="{{url('administrateur/dossiers/edit/'.$dossier->id)}}" class="btn btn-primary"> <i data-feather="edit-2"></i></a>
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
<form method="POST" action="{{url('administrateur/dossiers/examenbios/store')}}" enctype="multipart/form-data"> @csrf
    <div class="card">
        <div class="card-header">
            <div class="card-title">Nouveau examen bio</div>
        </div>
        <div class="card-body row">
            <div class="col-6">
                <label for="date"><b class="blueLabel">Date:</b></label>
                <input class="form-control" name="date" id="date" type="date" value="{{old('date',now()->toDateString() ?? null)}}">
            </div>
            <div class="col-6">
                <label for="motif"><b>Médecin:</b></label>
                <select class="form-control" name="id_medecin" id="id_medecin">
                    <option value="">Undéterminé</option>
                    @foreach ($Medecins as $med)
                    <option value="{{$med->id}}">{{$med->prenom}} {{$med->nom}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label for="file">Pièce jointe:</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                        <label class="custom-file-label" id="filename">Choisir fichier</label>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <label for="url_bio">URL Bio:</label>
                <select class="form-control" name="url" id="url"></select>
            </div>
            <div class="col-6">
                <label for="url_bio">URL Bio (à saisir manuellement):</label>
                <input class="form-control" id="url_bio" name="url_bio" placeholder="url bio" disabled>
            </div>
            <div class="col-12">
                <label for="lettre">Rapport:</label>
                <textarea class="form-control" id="lettre" name="lettre" placeholder="lettre" @error('lettre') is-invalid @enderror>{{old('lettre')}}</textarea>
                @error('lettre')
                <div class="invalid-feedback" style="display: block;">{{ $errors->first('lettre') }}</div>
                @enderror
            </div>
            <div class="form-group{{ $errors->has('dossier') ? ' has-error' : '' }}">
                <input type="hidden" value="{{$dossier->id}}" id="lettre" name="dossier">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                <i data-feather="save" class="mr-1"></i>
                Enregistrer examen bio
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
                url: "{{url('get-default-url')}}?id_medecin=" + medecinID,
                success: function(res) {
                    if (res[0] !== null) {
                        $("#url").empty();
                        $("#url").append('<option value="">-- Select --</option>');
                        $.each(res, function(key, value) {
                            $("#url").append('<option value="' + value + '">' + value + '</option>');
                        });
                        $("#url").append('<option>Autres</option>');
                    } else if (res[0] == null) {
                        $("#url").empty();
                        $("#url").append('<option value="">-- Select --</option>');
                        $("#url").append('<option>Autres</option>');
                    }
                }
            });
        } else {
            $("#option").empty();
        }
    });
</script>
<script>
    CKEDITOR.replace('lettre');
</script>
<script>
    $(document).ready(function() {
        $('#url').on('change', function() {
            if ($(this).val() !== '') {
                $('#url_bio').prop('disabled', false);
            } else {
                $('#url_bio').prop('disabled', true);
            }
        });
    });
</script>
@endsection