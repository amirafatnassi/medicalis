@extends('layouat.layoutCoordinateur')
@section('contenu')

<div class="row">
  <div class="col-lg-2 col-3">
    <ul class="timeline">
      <a href="{{url('coordinateur/discussionsCoordPatient/create')}}" class="list-group-item list-group-item-action">
        <i data-feather="plus-circle" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Nouvelle discussion</span>
      </a>
      <a href="{{url('coordinateur/discussionsCoordPatient/recu')}}" class="list-group-item list-group-item-action">
        <i data-feather="mail" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Discussions reçues</span>
      </a>
      <a href="{{url('coordinateur/discussionsCoordPatient/envoye')}}" class="list-group-item list-group-item-action">
        <i data-feather="send" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Envoyé</span>
      </a>
      <a href="{{url('coordinateur/discussionsCoordPatient/cloture')}}" class="list-group-item list-group-item-action">
        <i data-feather="info" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Messages Cloturés</span>
      </a>
      <a href="{{url('coordinateur/discussionsCoordPatient/recucloture')}}" class="list-group-item list-group-item-action">
        <i data-feather="info" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Discussions reçues cloturés</span>
      </a>
      <a href="{{url('coordinateur/discussionsCoordPatient/envoyecloture')}}" class="list-group-item list-group-item-action">
        <i data-feather="info" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Envoyé Cloturés</span>
      </a>
    </ul>
  </div>

  <div class="col-lg-10 col-9">
    <figure>
      <blockquote class="blockquote">
        <img src="{{ asset('uploads/users/'.($d->emetteur->image??'user.png')) }}" class="round" height="30" width="30" alt="" />
        {{ $d->emetteur->prenom }} {{ $d->emetteur->nom }}
        <i data-feather="arrow-right"></i>
        <img src="{{ asset('uploads/users/'.($d->destinataire->image??'user.png')) }}" class="round" height="30" width="30" alt="" />
        {{ $d->destinataire->prenom }} {{ $d->destinataire->nom }}
        : {{$d->type_courrier}}: {{$d->title}}
      </blockquote>
      <figcaption class="blockquote-footer">
        <cite title="Source Title"> {{date('d/m/Y H:i',strtotime($d->created_at))}}</cite>
      </figcaption>
      <div class="row">
        <div class="col-9">
          <p id="cloture" hidden>{{$d->cloture}}</p>
        </div>
        <div class="col-3">
          @if($d->dossier_id)
          <a class="btn btn-outline-dark pull-right" href="#" role="button">
            <i data-feather="bookmark"></i>
            Dossier n° {{$d->dossier_id}}
          </a>
          @endif
        </div>
      </div>
    </figure>

    @foreach ($d->replies as $r)
    <div class="card mb-3">
      <div class="card-header">
        <div class="col-6">
          <img src="{{asset('uploads/users/'. ($r->emetteur->image??'user.png'))}}" class="round" height="30" width="30" alt="" />
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
            <a href="{{ asset('uploads/courrierMedPatient/'.$f->downloads) }}">
              <i data-feather="paperclip"></i> {{$f->downloads}}
            </a>
          </div>
          @endif
          @endforeach
          @endif
        </div>
      </div>
    </div>
    @endforeach
    @if ($d->cloture)
    <p class="text-warning">Cette discussion a été clôturée. Vous ne pouvez pas répondre.</p>
    @else
    <div class="card">
      @if ($errors->any())
      <div class="alert alert-danger col-12">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <form method="POST" action="{{ url('coordinateur/discussionsCoordPatient/reply', ['id' => $d->id]) }}" enctype="multipart/form-data"> @csrf
        <div class="card-header">
          <div class="card-title">Réponse</div>
        </div>
        <div class="card-body row">
          <div class="col-12" id="rep">
            <textarea name="reply" id="reply" cols="30" rows="10" class="form-control" required></textarea>
            <div class="invalid-feedback">Ce champ est obligatoire.</div>
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
          <a type="submit" class="btn btn-primary" href="{{ url('coordinateur/discussionsCoordPatient/cloturer', ['id' => $d->id]) }}" id="b_cloture">
            <i data-feather="lock"></i> Cloturer
          </a>
        </div>
      </form>
    </div>
    @endif
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $("#fileup").change(function() {
      let filenames = Array.from(this.files).map(file => file.name).join(", ");
      $("#filename").text(filenames);
    });

    CKEDITOR.replace('reply');
  });
</script>
@endsection