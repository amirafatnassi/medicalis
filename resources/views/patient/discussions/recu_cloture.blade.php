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
        <span class="align-middle">Discussions envoyé</span>
      </a>
      <a href="{{url('/patient/discussions/cloture')}}" class="list-group-item list-group-item-action">
        <i data-feather="info" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Discussions Cloturés</span>
      </a>
      <a href="{{url('/patient/discussions/recucloture')}}" class="list-group-item list-group-item-action active">
        <i data-feather="info" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Discussions reçues Cloturés</span>
      </a>
      <a href="{{url('/patient/discussions/envoyecloture')}}" class="list-group-item list-group-item-action">
        <i data-feather="info" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Discussions envoyé Cloturés</span>
      </a>
    </ul>
  </div>
  <div class="col-lg-10 col-9">
    <div class="input-group input-group-merge">
      <div class="input-group-prepend">
        <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
      </div>
      <input type="text" id="searchInput" class="form-control" placeholder="Rechercher discussions">
    </div>

    @foreach($discussions as $d)
    <input class="discussion-content" value="{{ $d->content }}" type="hidden">
    <div class="card mt-1">
      <div class="card-header">
        <div class="col-10 d-flex align-items-center">
          <span class="avatar">
            <img src="{{asset('uploads/users/'.($d->emetteur->image??'user.png'))}}" class="round" height="30" width="30" />
            @if ($d->etat==0) <span class="avatar-status-busy"></span></span>
          @elseif ($d->etat==1) <span class="avatar-status-online"></span>
          @else <span class="avatar-status-offline"></span>
          @endif
          </span>
          <div class="ms-2">
            {{$d->emetteur->prenom}} {{$d->emetteur->nom}}
          </div>
        </div>
        <div class="col-2">
          <span class="mail-date"> {{date('d/m/Y H:i', strtotime($d->updated_at))}}</span>
        </div>
      </div>
      <div class="card-body">
        <h3>
          {{$d->type_courrier}}: {{$d->title}}
          <a href="{{url('patient/discussions/show',['slug'=>$d->slug])}}">
            <small>cliquez içi</small>
          </a>
          <a href="#" class="badge badge-secondary">
            {{$d->replies->count()}}
          </a>
        </h3>
        <small>{!!Str::limit($d->content,200)!!}</small>
      </div>
      <div class="card-footer row">
        <div class="col-9">@if($d->cloture==1)
          <span class="badge badge-secondary">Cloturé</span>
          @endif
        </div>
        <div class="col-3">
          @if($d->dossier_id)
          <a class=" btn btn-outline-dark pull-right" href="{{url('patient/mondossier')}}" role="button">
            <i data-feather="bookmark"></i> Dossier n° {{$d->dossier_id}}
          </a>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function() {
      var keywords = this.value.toLowerCase();
      console.log(keywords); // Display entered keyword

      var cards = document.getElementsByClassName('card');
      for (var i = 0; i < cards.length; i++) {
        var discussionContent = cards[i].querySelector('.discussion-content').value.toLowerCase();
        if (discussionContent.includes(keywords)) {
          cards[i].style.display = 'block';
        } else {
          cards[i].style.display = 'none';
        }
      }
    });
  });
</script>
@endsection