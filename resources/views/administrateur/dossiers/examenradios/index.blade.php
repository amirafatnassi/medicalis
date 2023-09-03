@extends('layouat.layoutAdmin')
@section('contenu')
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        @if($dossier->image!=null)
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="105" width="105" alt="avatar" />
                        @else
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/user.png')}}" height="105" width="105" alt="avatar" />
                        @endif
                        <div class="d-flex flex-column ml-1">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                                <span class="card-text">{{$dossier->email}}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="" class="btn btn-primary"><i data-feather="edit-3"></i></a>
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
    <div class="card-header">
        <div class="card-title">Liste d'examens radio</div>
        <div class="col-3">
            <a href="{{url('administrateur/dossiers/'.$dossier->id.'/examenradios/create')}}" class="btn btn-outline-success">Nouveau examen radio</a>
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
                    <th>URL Pacs</th>
                    <th><i data-feather="paperclip"></i> Pièces jointes</th>
                    <th>Remarques</th>
                </tr>
            </thead>
            <tbody>
                @foreach($liste_examenradios as $examenradio)
                <tr>
                    <td><a href="{{url('administrateur/dossiers/examenradios/show/'.$examenradio->id)}}" class="btn btn-primary">ID:{{$examenradio->id}}</a></td>
                    <td>{{date('d/m/Y',strtotime($examenradio->date))}}</td>
                    <td>@if($examenradio->id_medecin){{$examenradio->medecin->prenom}} {{$examenradio->medecin->nom}}@endif</td>
                    <td><a href="https://{{$examenradio->url_radio}}" target="_blank">{{$examenradio->url_radio}}</a></td>
                    <td>@if($examenradio->files->count()!=0)
                        <a href="{{url('administrateur/dossiers/examenradios/showExamenfiles/'.$examenradio->id)}}"><i data-feather="paperclip"></i></a>
                        @endif
                    </td>
                    <td><span class="badge badge-pill badge-light-primary">{{$examenradio->remarques}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection