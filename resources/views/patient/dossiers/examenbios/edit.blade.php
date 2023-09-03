@extends('layouat.layaoutPatient')
@section('contenu')

<div class="card">
    <form method="POST" action="{{url('patient/examenbios/update/'.$examenbio->id)}}" enctype="multipart/form-data">@csrf
        <div class="card-header"><div class="card-title">Modifier examen bio</div></div>
        <div class="card-body row">
            <div class="col-6">
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
            <div class="col-12">
                <label for="lettre"><b class="blueLabel">Observation:</b></label>
                <textarea class="ckeditor form-control" id="lettre" name="lettre" placeholder="lettre">{{old('lettre',$examenbio->lettre?? null)}}</textarea>
                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" hidden>
                    Le rapport est obligatoire !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit" id="b_submit"> <i data-feather="save"></i> Terminer examen bio</button>
        </div>
    </form>

    @if($examenbio->files->count()!=0)
    <div class="card-header"><div class="card-title">Liste de téléchargements</div></div>
    <div class="card-body">
        @foreach($examenbio->files as $f)
        <div class="row" style="display: flex; align-items: center;">
            <a href="{{url('/uploads/exbio/'.$f->downloads)}}"> <i data-feather="paperclip"></i> {{$f->downloads}}</a>
            <form action="{{ route('patient.examenbio.deleteFile', $f->id) }}" method="POST" style="display:inline;"> {{ csrf_field() }} {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier {{ $f->downloads }} parmi vos téléchargement ?')"><i data-feather="trash"></i></button>
            </form>
        </div>
        @endforeach        
    </div>
    @endif
</div>

<script>
  $(document).ready(function() {
    $("#fileup").change(function() {
      var filenames = Array.from(this.files, file => file.name).join(',');
      $("#filename").text(filenames);
    });

    CKEDITOR.replace('lettre');

    $("#b_submit").click(function(e) {
      var lettreData = CKEDITOR.instances.lettre.getData();

      if (!lettreData) {
        e.preventDefault();
        $("#msg").prop("hidden", false);
      } else {
        $("#msg").prop("hidden", true);
        return confirm('Voulez-vous vraiment enregistrer cet examen bio? Vous ne pourrez plus apporter de modifications.');
      }
    });
  });
</script>

@endsection