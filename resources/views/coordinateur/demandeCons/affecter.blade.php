@extends('layouat.layoutCoordinateur')
@section('contenu')
<div class="card user-card">
    <div class="card-body row">
        <div class="col-6">
            <div class="user-avatar-section">
                <div class="d-flex justify-content-start">
                    <img class="img-fluid rounded" src="{{asset('uploads/users/'.($dossier->user->image??'user.png'))}}" height="55px" width="55px" alt="avatar" />
                    <div class="d-flex flex-column ml-1">
                        <div class="user-info mb-1">
                            <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->user->prenom}} {{$dossier->user->nom}}</h4>
                            <span class="card-text">{{$dossier->user->email}}</span>
                        </div>
                        <div class="d-flex flex-wrap">
                            <a href="" class="btn btn-primary">
                                <i data-feather="edit-3"></i>
                            </a>
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
                    <p class="card-text mb-0">{{$dossier->user->Country->lib}}</p>
                </div>
                <div class="d-flex flex-wrap">
                    <div class="user-info-title">
                        <i data-feather="phone" class="mr-1"></i>
                        <span class="card-text user-info-title font-weight-bold mb-0">Tel: </span>
                    </div>
                    <p class="card-text mb-0">{{$dossier->user->tel}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Affecter demande de consultation n° {{$demandeCons->id}}</div>
    </div>
    <form method="POST" action="{{url('coordinateur/demandeCons/affecter')}}" enctype="multipart/form-data"> {{csrf_field()}}
        <div class="card-body row">
            <div class="col-12">
                <u><b>Coordinateur en charge actuel:</b></u> {{$demandeCons->coordinateurEnCharge->prenom}} {{$demandeCons->coordinateurEnCharge->nom}}
            </div>
            <div class="col-12">
                <label for="coordinateur"><b>Affecter à:</b></label>
                <select class="form-control" name="coordinateur_id">
                    @foreach ($coordinateurs as $c)
                    <option value="{{$c->id}}">{{$c->prenom}} {{$c->nom}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <input type="text" value="{{$demandeCons->id}}" name="demande_cons_id" hidden>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit" data-mdb-toggle="tooltip" title="submit">
                <i data-feather="check"></i> Affecter
            </button>
        </div>
    </form>
</div>
@endsection