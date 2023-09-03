@extends('layouat.layaoutMedecin')
@section('contenu')

<div class="row">
    <div class="col-lg-2 col-3">
        <ul class="timeline">
            <a href="{{url('/medecin/forum/create')}}" class="list-group-item list-group-item-action">
                <i data-feather="plus-circle" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Nouvelle discussion</span>
            </a>
            <a href="{{url('/medecin/forum/recu')}}" class="list-group-item list-group-item-action active">
                <i data-feather="mail" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Discussions reçues</span>
            </a>
            <a href="{{url('/medecin/forum/envoye')}}" class="list-group-item list-group-item-action">
                <i data-feather="send" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Envoyé</span>
            </a>

            <a href="{{url('/medecin/forum/cloture')}}" class="list-group-item list-group-item-action">
                <i data-feather="info" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Messages Cloturés</span>
            </a>
            <a href="{{url('/medecin/forum/recucloture')}}" class="list-group-item list-group-item-action">
                <i data-feather="info" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Discussions reçues cloturés</span>
            </a>
            <a href="{{url('/medecin/forum/envoyecloture')}}" class="list-group-item list-group-item-action">
                <i data-feather="info" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Envoyé Cloturés</span>
            </a>
        </ul>
    </div>
    <div class="col-lg-10 col-9">
        <ul class="timeline">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                </div>
                <input type="text" class="form-control" id="email-search" placeholder="Search email" aria-label="Search..." aria-describedby="email-search" />
            </div>
            @foreach($discussions as $d)
            <div class="card mt-1">
                <div class="card-header row">
                    <div class="col-9">
                        <span class="avatar">
                            <img src="{{asset('uploads/users/'.($d->emetteur->image??'user.png'))}}" class="round" height="30" width="30" alt="" />
                            @if ($d->etat==0) <span class="avatar-status-busy"></span></span>
                        @elseif ($d->etat==1) <span class="avatar-status-online"></span>
                        @else <span class="avatar-status-offline"></span>
                        @endif</span>
                        {{$d->emetteur->prenom}} {{$d->emetteur->nom}}
                    </div>
                    <div class="col-3">
                        <span class="mail-date"> {{date('d/m/Y H:i', strtotime($d->updated_at))}}</span>
                    </div>
                </div>
                <div class="card-body">
                    <h3>
                        {{$d->type_courrier}}: {{$d->title}}
                        <a href="{{url('/medecin/forum/show',['slug'=>$d->slug])}}">
                            <small>cliquez içi</small>
                        </a>
                        <a href="#" class="badge badge-secondary">
                            {{$d->replies->count()}}
                        </a>
                    </h3>
                    <small>{!!Str::limit($d->content,200)!!}</small>
                </div>
                <div class="card-footer row">
                    <div class="col-1">
                        @if($d->cloture==1)
                        <span class="badge badge-secondary">Cloturé</span>
                        @endif
                    </div>
                    <div class="col-8"></div>
                    <div class="col-3">
                        @if(!is_null($d->dossier_id))
                        <a class="btn btn-outline-dark pull-right" href="#" role="button">
                            <i data-feather="bookmark"></i>
                            Dossier n° {{$d->dossier_id}}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </ul>
    </div>
</div>
@endsection