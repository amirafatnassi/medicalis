@extends('layouat.layoutPatientNoHeader')
@section('contenu')

<div class="row">
  <div class="col-lg-2 col-3">
    <ul class="timeline">
      <a href="{{url('/patient/discussions/create')}}" class="list-group-item list-group-item-action">
        <i data-feather="plus-circle" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Nouvelle discussion</span>
      </a>
      <a href="{{url('/patient/discussions/recu')}}" class="list-group-item list-group-item-action">
        <i data-feather="mail" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Discussions reçues</span>
      </a>
      <a href="{{url('/patient/discussions/envoye')}}" class="list-group-item list-group-item-action">
        <i data-feather="send" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Envoyé</span>
      </a>
      <a href="{{url('/patient/discussions/cloture')}}" class="list-group-item list-group-item-action">
        <i data-feather="info" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Messages Cloturés</span>
      </a>
      <a href="{{url('/patient/discussions/recucloture')}}" class="list-group-item list-group-item-action">
        <i data-feather="info" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Discussions reçues cloturés</span>
      </a>
      <a href="{{url('/patient/discussions/envoyecloture')}}" class="list-group-item list-group-item-action">
        <i data-feather="info" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Envoyé Cloturés</span>
      </a>
    </ul>
  </div>
  <div class="col-lg-10 col-9">
    <figure>
      <blockquote class="blockquote">
        <img src="{{asset('uploads/users/'.($d->emetteur->image??'user.png'))}}" class="round" height="30" width="30" />
        {{ $d->emetteur->prenom }} {{ $d->emetteur->nom }}
        <i data-feather="arrow-right"></i>
        <img src="{{asset('uploads/users/'.($d->destinataire->image??'user.png'))}}" class="round" height="30" width="30" />
        {{ $d->destinataire->prenom }} {{ $d->destinataire->nom }}
        :
        {{$d->type_courrier}}: {{$d->title}}
      </blockquote>
      <figcaption class="blockquote-footer">
        <cite title="Source Title"> {{date('d/m/Y H:i',strtotime($d->created_at))}}</cite>
      </figcaption>
      <div class="row">
        <div class="col-9">
          <p id="cloture" hidden>{{$d->cloture}}</p>
        </div>
        @if($d->dossier_id)
        <div class="col-3">
          <a class="btn btn-outline-dark pull-right" href="{{url('patient/mondossier')}}" role="button">
            <i data-feather="bookmark"></i>
            Dossier n° {{$d->dossier_id}}
          </a>
        </div>
        @endif
      </div>
    </figure>
    @foreach($replies as $r)
    <div class="card mb-3">
      <div class="card-header">
        <div class="col-9">
          <img src="{{asset('uploads/users/'.($r->emetteur->image??'user.png'))}}" class="round" height="30" width="30" alt="" />
          {{ $r->emetteur->prenom }} {{ $r->emetteur->nom }}
        </div>
        <div class="col-3"><b>{{date('d/m/Y H:i',strtotime($r->created_at))}}</b></div>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>{!!$r->content!!}</p>
        </div>
        <div>
          @if($r->files->count()>0)
          @foreach($r->files as $f)
          @if($f->id_reply_med_patients==$r->id)
          <div class="row">
            <a href="/uploads/courrierMedPatient/{{$f->downloads}}">
              <i data-feather="paperclip"></i> {{$f->downloads}}
            </a>
          </div>
          @endif
          @endforeach
          @endif
        </div>
      </div>
    </div>
    <br>
    @endforeach
    @if($d->cloture == 0)
    <div class="card mb-1">
      <div class="card-header">
        <div class="card-title">Réponse</div>
      </div>
      <form method="POST" action="{{url('patient/discussions/reply',['id'=>$d->id])}}" enctype="multipart/form-data"> @csrf
        <div class="card-body row">
          <div class="col-12" id="rep">
            <textarea name="reply" id="reply" cols="30" rows="10" class="CKEDITOR form-control"></textarea>
            <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg1" hidden>
              Le rapport est obligatoire !
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
          </div>
          <div class="col-12" id="pieceJointe">
            <label for="file">Pièce jointe:</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                <label class="custom-file-label" id="filename">Choisir fichier</label>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary" id="b_submit">
            <i data-feather="send"></i> Répondre
          </button>
          <a type=submit class="btn btn-primary" href="{{url('/patient/discussions/cloturer',['id'=>$d->id])}}" id="b_cloture">
            <i data-feather="key"></i> Cloturer
          </a>
        </div>
      </form>
    </div>
    @else
    <div class="alert alert-warning" role="alert">
      Cette discussion a été cloturée !
    </div>
    @endif
  </div>
</div>
<script>
  CKEDITOR.replace('reply');
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

<script>
  var b_submit = document.getElementById("b_submit");
  var reply = document.getElementById("reply");
  b_submit.addEventListener('click', valider);
  var msg1 = document.getElementById("msg1");

  function valider(e) {
    if ((CKEDITOR.instances.reply.getData() == '') || (CKEDITOR.instances.reply.getData() == null) || (CKEDITOR.instances.reply.getData() == undefined)) {
      e.preventDefault();
      msg1.hidden = false;
    } else {
      msg1.hidden = true;
    }
  }
</script>

<script>
  var b_submit = document.getElementById("b_submit");
  var b_cloture = document.getElementById("b_cloture");
  var msg = document.getElementById("msg");
  var reply = document.getElementById("reply");
  var pieceJointe = document.getElementById("pieceJointe");
  var cloture = document.getElementById("cloture").innerHTML;
  console.log(cloture);
  if (cloture == 1) {
    b_submit.disabled = true;
    b_cloture.disabled = true;
    msg.hidden = false;
    reply.disabled = true;
    pieceJointe.hidden = true;
  } else {
    b_submit.disabled = false;
    b_cloture.disabled = false;
    msg.hidden = true;
    reply.disabled = false;
    pieceJointe.hidden = false;
  }
</script>
@endsection