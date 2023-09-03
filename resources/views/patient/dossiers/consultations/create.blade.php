@extends('layouat.layaoutPatient')
@section('contenu')

<form method="POST" action="{{url('patient/consultations/store')}}" enctype="multipart/form-data"> {{csrf_field()}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Nouvelle consultation</div>
        </div>
        <div class="card-body row">
            <div class="col-6">
                <label for="date"><b>Date:</b></label>
                <input class="form-control" name="date" type="date" id="d" value="{{old('date',now()->toDateString() ?? null)}}">
            </div>
            <div class="col-6">
                <label for="médecin"><b>Médecin:</b></label>
                <select class="form-control" name="id_medecin" id="id_medecin">
                     @foreach ($Medecins as $medecin)
                    <option value="{{$medecin->id}}">{{$medecin->prenom}} {{$medecin->nom}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label for="motif_id"><b>Motif:</b></label>
                <select class="form-control" name="motif_id" id="motif_id">
                    @foreach ($Motifs as $motif)
                    <option value="{{$motif->id}}">{{$motif->lib}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label for="file"><b>Pièce jointe:</b></label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                        <label class="custom-file-label" id="filename">Choisir fichier</label>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group"><label for="taille"><b>Taille: </b></label>
                    <input class="form-control" name="taille" id="taille" type="number" value="{{old('taille', $dossier->taille ?? null)}}">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="poids"><b>Poids:</b></label>
                    <input class="form-control" name="poids" id="poids" type="number" value="{{old('poids', $dossier->poids ?? null)}}">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="ta"><b>TA:</b></label>
                    <input class="form-control" name="ta" id="ta" type="number" value="{{old('ta', $consultation->ta ?? null)}}">
                </div>
            </div>
            <div class="col-12">
                <label for="observation"><b>Rapport:</b></label>
                <textarea class="form-control" id="observation" name="observation" placeholder="observation" cols="30" rows="30" @error('observation') is-invalid @enderror>{{old('observation') }}</textarea>
                 @error('observation')
                <div class="invalid-feedback" style="display: block;">{{ $errors->first('observation') }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label for="observation_prive"><b>Observation privée <small><b class="red">( affiché pour vous uniquement )</b></small></b></label>
                <textarea class="ckeditor form-control" id="observation_prive" name="observation_prive" placeholder="Observation privé">{{old('observation_prive')}}</textarea>
            </div>
            <div class="col-12">
                <label for="effet_marquant_txt">Cochez si vous voulez ajouter un antécédant:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" class="form-check-input" name="effet_marquant" id="effet_marquant" name="checkbox"  value="1">
                <small><b class="red">( tout ce qui est affiché en antécédent sera répertorié dans l'historique du patient ) </b></small>
                <textarea class="form-control" rows="3" id="effet_marquant_txt" name="effet_marquant_txt" placeholder="Antécédant" disabled>
                {{old('effet_marquant_txt')}}
                </textarea>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                <i data-feather="save"></i> Enregistrer consultation
            </button>
        </div>
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
    $(document).ready(function() {
        $('#effet_marquant').change(function() {
            if(this.checked) {
                $('#effet_marquant_txt').prop('disabled', false);
            } else {
                $('#effet_marquant_txt').prop('disabled', true);
            }
        });
    });
</script>
<script>
    CKEDITOR.replace('observation');
</script>
@endsection