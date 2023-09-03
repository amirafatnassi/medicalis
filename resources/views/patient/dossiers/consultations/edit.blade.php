@extends('layouat.layaoutPatient')
@section('contenu')
<div class="card">
    <form method="POST" action="{{url('patient/consultations/update/'.$consultation->id)}}" enctype="multipart/form-data"> {{csrf_field()}}
        <div class="card-header"><div class="card-title">Modifier consultation n° {{$consultation->id}}</div></div>
        <div class="card-body row">
            <div class="col-6">
              <label for="date"><b>Date:</b></label>
              <input class="form-control" name="date" type="date" id="d" value="{{old('date',$consultation->date?? null)}}">
            </div>
            <div class="col-6">
              <label for="motif_id"><b>Motif:</b></label>
              <select class="form-control" name="motif_id" id="motif_id">
                <option value="{{$consultation->Motif->id}}">{{$consultation->Motif->lib}}</option>
                @foreach ($Motifs as $motif)
                <option value="{{$motif->id}}">{{$motif->lib}}</option>
                @endforeach
              </select>
            </div>
            <div class="col">
              <div class="form-group"><label for="taille"><b>Taille: </b></label>
                <input class="form-control" name="taille" id="taille" type="text" value="{{old('taille',$consultation->taille ?? null)}}">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="poids"><b>Poids:</b></label>
                <input class="form-control" name="poids" id="poids" type="text" value="{{old('poids', $consultation->poids ?? null)}}">
              </div>
            </div>
            <div class="col">
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
          <textarea class="CKEDITOR form-control" id="observation" name="observation" placeholder="observation">{{old('observation', $consultation->observation ?? null)}}</textarea>
          <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" hidden>
            Le rapport est obligatoire !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit" id="b_submit"> <i data-feather="save"></i> Enregistrer modifications</button>
        </div>
    </form>
    @if($consultation->files->count()!=0)
    <div class="card-header"><div class="card-title">Liste de téléchargement</div></div>
    <div class="card-body">
        @foreach($consultation->files as $f)
        <div class="row" style="display: flex; align-items: center;">
            <a href="{{url('/uploads/consultation/'.$f->downloads)}}"> <i data-feather="paperclip"></i>{{$f->downloads}}</a>
            <form action="{{ route('patient.consultation.deleteFile', $f->id) }}" method="POST" style="display:inline;"> {{ csrf_field() }} {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier {{ $f->downloads }} parmi vos téléchargement ?')"><i data-feather="trash"></i></button>
            </form>
        </div>
        @endforeach
    </div>
    @endif
</div>

<script>
  CKEDITOR.replace('observation');

  $(document).ready(function() {
    var b_submit = document.getElementById("b_submit");
    var msg = document.getElementById("msg");
    b_submit.addEventListener('click', valider);

    function valider(e) {
      var observationData = CKEDITOR.instances.observation.getData();

      if (!observationData) {
        e.preventDefault();
        msg.hidden = false;
      } else {
        msg.hidden = true;
        return confirm('Voulez-vous vraiment enregistrer cette consultation? Vous ne pourrez plus apporter de modifications.');
      }
    }

    $("#fileup").change(function() {
      var chaine = "";
      $.each(this.files, function(key, value) {
        chaine = chaine + value.name + ',';
      });
      $("#filename").text(chaine);
    });
  });
</script>
@endsection