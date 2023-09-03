@extends('layouat.layaoutPatient')
@section('contenu')

<form method="POST" action="{{url('patient/examenbios/store')}}" enctype="multipart/form-data">@csrf
  <div class="card">
    <div class="card-header"><div class="card-title">Nouveau examen bio</div></div>
    <div class="card-body row">
        <div class="col-6">
          <label for="date"><b>Date:</b></label>
          <input class="form-control" name="date" id="date" type="date" value="{{old('date',now()->toDateString() ?? null)}}">
        </div>
        <div class="col-6"></div>
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
            <label for="lettre"><b>Observation:</b></label>
            <textarea class="ckeditor form-control" id="lettre" name="lettre" placeholder="lettre" @error('lettre') is-invalid @enderror>{{old('lettre')}}</textarea>
            @error('lettre')
            <div class="invalid-feedback" style="display: block;">{{ $errors->first('lettre') }}</div>
            @enderror
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-block btn-primary" type="submit" id="b_submit"> <i data-feather="save" class="mr-1"></i> Terminer examen bio</button>
    </div>
  </div>
</form>
<script>
  $(document).ready(function() {
    $("#fileup").change(function() {
      var chaine = "";
      $.each(this.files, function(key, value) {
        chaine = chaine + value.name + ',';
      });
      $("#filename").text(chaine);
    });

    CKEDITOR.replace('lettre');

    $("#consultationForm").submit(function(e) {
      var observationData = CKEDITOR.instances.observation.getData();

      if (!observationData) {
        e.preventDefault();
        $("#observation").addClass("is-invalid");
      } else {
        $("#observation").removeClass("is-invalid");
      }
    });
  });
</script>


@endsection