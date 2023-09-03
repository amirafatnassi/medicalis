@extends('layouat.layaoutMedecin')
@section('contenu')
<div class="card user-card">
    <div class="card-body row">
        <div class="col-6">
            <div class="user-avatar-section">
                <div class="d-flex justify-content-start">
                    <img class="img-fluid rounded" src="{{asset('uploads/users/'.($dossier->user->image??'user.png'))}}" height="104" width="104" alt="User avatar" />
                    <div class="d-flex flex-column ml-1">
                        <div class="user-info mb-1">
                            <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->user->prenom}} {{$dossier->user->nom}}</h4>
                            <span class="card-text">{{$dossier->user->email}}</span>
                        </div>
                        <div class="d-flex flex-wrap">
                            <a href="" class="btn btn-primary"><i data-feather="edit-3"></i></a>
                            <a class="btn btn-outline-primary ml-1" href=""><i data-feather="printer"></i></a>
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
                    <p class="card-text mb-0">{{$dossier->user->country->lib}}</p>
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
        <div class="card-title col-4">Liste d'examens radio:</div>
        <div class="col-2">
            <a href="{{url('medecin/examenradio/create/'.$dossier->id)}}" class="btn btn-outline-success">Nouveau examen radio</a>
        </div>
        <div class="col-6">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                </div>
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher  examen radio selon médecin.." aria-label="Search..." aria-describedby="email-search" />
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Médecin</th>
                    <th>Spécialité</th>
                    <th>URL Pacs</th>
                    <th><i data-feather="paperclip"></i> Pièces jointes</th>
                    <th>Remarques</th>
                </tr>
            </thead>
            <tbody>
                @foreach($liste_examenradios as $examenradio)
                <tr>
                    <td><a href="{{url('medecin/examenradio/'.$examenradio->id.'/show')}}" class="btn btn-primary">ID:{{$examenradio->id}}</a></td>
                    <td>{{date('d/m/Y',strtotime($examenradio->date))}}</td>
                    <td>@if ($examenradio->medecin){{$examenradio->medecin->prenom}} {{$examenradio->medecin->nom}}@endif</td>
                    <td>@if ($examenradio->medecin && $examenradio->medecin->specialite_id){{$examenradio->medecin->Specialite->lib}}@endif</td>
                    <td><a href="{{$examenradio->url_radio}}" target="_blank">{{$examenradio->url_radio}}</a></td>
                    <td>@if($examenradio->files->count()!=0)
                        <a href="{{url('medecin/examenradio/showExamenfiles/'.$examenradio->id)}}"><i data-feather="paperclip"></i></a>
                        @endif
                    </td>
                    <td>
                        @if(!is_null($examenradio->remarques))
                        <h5><a href="#" class="badge badge-danger">{{$examenradio->remarques}}</a></h5>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.getElementById("myInput");
        var table = document.getElementById("myTable");

        input.addEventListener('input', function() {
            var filter = input.value.toUpperCase();
            var rows = table.getElementsByTagName("tr");

            Array.from(rows).forEach(function(row) {
                var cells = row.getElementsByTagName("td");
                var shouldDisplay = false;

                Array.from(cells).forEach(function(cell) {
                    var cellText = cell.textContent || cell.innerText;
                    if (cellText.toUpperCase().indexOf(filter) > -1) {
                        shouldDisplay = true;
                        return;
                    }
                });

                row.style.display = shouldDisplay ? "" : "none";
            });
        });
    });
</script>

@endsection