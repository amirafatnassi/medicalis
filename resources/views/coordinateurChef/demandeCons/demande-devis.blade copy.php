@extends('menus.layoutCoordinateurChef')
@section('contenu')
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="60px" width="60px" alt="avatar" />
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


    <div class="container">
        <h1>Laravel 8 Autocomplete Search using Bootstrap Typeahead JS</h1>
        <form method="POST" action="{{url('coordinateurChef/demandeDevis/enregistrer')}}"enctype="multipart/form-data"> {{csrf_field()}}
            <div class="row">
                <div class="col-11"> 
                    <input class="typeahead form-control" type="text" name="medecin_id">
                </div>
                <div class="col-1">
                    <button class="btn btn-link" type="submit" data-mdb-toggle="tooltip" title="submit">
                        <i data-feather="check"></i>
                    </button>
                </div>
            </div>
        </form>
        <ul>
            @foreach($temp as $m)
            <li> {{$m->id}} : {{$m->prenom}} {{$m->nom}} <button class="btn btn-link" href="#!" data-mdb-toggle="tooltip" title="Remove"><i data-feather="trash"></i></button></li>
            @endforeach
        </ul>

    </div>
</div>

<script>
    var path = "{{ route('autocomplete')  }}";
    $('input.typeahead').typeahead({
        source: function(query, process) {
            return $.get(path, {
                term: query
            }, function(data) {
                return process(data);
            });
        }
    });
</script>
@endsection