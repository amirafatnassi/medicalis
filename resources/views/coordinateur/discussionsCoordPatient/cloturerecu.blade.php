@extends('layouat.layoutCoordinateur')
@section('contenu')

<div class="row">
    <div class="col-lg-2 col-3">
        <div class="timeline">
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
            <a href="{{url('coordinateur/discussionsCoordPatient/recucloture')}}" class="list-group-item list-group-item-action active">
                <i data-feather="info" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Discussions reçues cloturés</span>
            </a>
            <a href="{{url('coordinateur/discussionsCoordPatient/envoyecloture')}}" class="list-group-item list-group-item-action">
                <i data-feather="info" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Envoyé Cloturés</span>
            </a>
        </div>
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
                        <img src="{{asset('uploads/users/'.($d->emetteur->image??'user.png'))}}" class="round" height="30" width="30" alt="" />
                        {{$d->emetteur->prenom}} {{$d->emetteur->nom}}
                    </div>
                    <div class="col-3">
                        <span class="mail-date"> {{date('d/m/Y H:i', strtotime($d->updated_at))}}</span>
                    </div>
                </div>
                <div class="card-body">
                    <h3>
                        @if ($d->etat==0) <span class="mr-50 bullet bullet-danger bullet-sm"></span>
                        @elseif ($d->etat==1) <span class="mr-50 bullet bullet-success bullet-sm"></span>
                        @else <span class="mr-50 bullet bullet-info bullet-sm"></span>
                        @endif
                        {{$d->type_courrier}}: {{$d->title}}
                        <a href="{{url('coordinateur/discussionsCoordPatient/show',['slug'=>$d->slug])}}">
                            <small>cliquez içi</small>
                        </a>
                        <a href="#" class="badge badge-secondary">
                            {{$d->replies->count()}}
                        </a>
                    </h3>
                    <small>{!!Str::limit($d->content,200)!!}</small>
                </div>
                <div class="card-footer row">
                    <div class="col-9">
                        @if($d->cloture==1)
                        <span class="badge badge-secondary">Cloturé</span>
                        @endif
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
            </div>
            @endforeach
        </ul>
    </div>
</div>
@endsection