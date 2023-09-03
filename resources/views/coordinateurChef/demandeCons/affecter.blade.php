@extends('menus.layoutCoordinateurChef')
@section('contenu')
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="55px" width="55px" alt="avatar" />
                        <div class="d-flex flex-column ml-1">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                                <span class="card-text">{{$dossier->email}}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="" class="btn btn-primary">
                                    <i data-feather="edit-2"></i>
                                </a>
                                <a class="btn btn-outline-primary ml-1" href="">
                                    <i data-feather="printer"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                <div class="user-info-wrapper">
                    <div class="d-flex flex-wrap my-50">
                        <div class="user-info-title">
                            <i data-feather="flag" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Pays: </span>
                        </div>
                        <p class="card-text mb-0">{{$dossier->pays}}</p>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="user-info-title">
                            <i data-feather="phone" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Tel: </span>
                        </div>
                        <p class="card-text mb-0">{{$dossier->tel}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-title">
        <h3>Affecter demande de consultation n° {{$demandeCons->id}}</h3>
    </div>
    <div class="card-header">
        <ul class="timeline">
            <div><u><b>Coordinateur en charge:</b></u> {{$demandeCons->coordinateurEnCharge}}</div>
        </ul>
    </div>
    <div class="card-body">
        <form method="POST" action="{{url('coordinateurChef/demandeCons/save')}}" enctype="multipart/form-data"> {{csrf_field()}}
            <div class="col-12">
                <label for="coordinateur"><b>Coordinateur:</b></label>
                <select class="form-control" name="coordinateur_id">
                    @foreach ($coordinateurs as $c)
                    <option value="{{$c->id}}">{{$c->prenom}} {{$c->nom}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <input type="text" value="{{$demandeCons->id}}" name="demande_cons_id" hidden>
            </div>
            <br>
            <div class="row">
                <button class="btn btn-primary" type="submit" data-mdb-toggle="tooltip" title="submit">
                    <i data-feather="check"></i> Affecter
                </button>
            </div>
        </form>
    </div>
</div>
@endsection