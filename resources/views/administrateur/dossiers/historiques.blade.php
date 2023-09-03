@extends('layouat.layoutAdmin')
@section('contenu')

<div class="card user-card">
    <div class="card-body row">
        <div class="col-6">
            <div class="user-avatar-section">
                <div class="d-flex justify-content-start">
                    <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.($dossier->image??'user.png'))}}" height="104" width="104" alt="User avatar" />
                    <div class="d-flex flex-column ml-1">
                        <div class="user-info mb-1">
                            <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->prenom}} {{$dossier->nom}}</h4>
                            <span class="card-text">{{$dossier->email}}</span>
                        </div>
                        <div class="d-flex flex-wrap">
                            <a href="{{url('administrateur/dossiers/edit/'.$dossier->id)}}" class="btn btn-primary">
                                <i data-feather="edit-3"></i>
                            </a>
                            <a class="btn btn-outline-primary ml-1" href="{{ url('administrateur/dossiers/imprimerDossier',['dossier'=>$dossier->idD])}}">
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
<div class="card">
    <div class="card-header row">
        <div class="card-title col-4">Historiques de consultations</div>
        <div class="col-3">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                </div>
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher consultation selon date..." aria-label="Search..." aria-describedby="email-search" />
            </div>
        </div>
        <div class="col-3">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                </div>
                <input type="text" class="form-control" id="myInput1" onkeyup="myFunction1()" placeholder="Rechercher consultation selon médecin.." title="Type in a name">
            </div>
        </div>
        <div class="col-2">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nouveau</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('administrateur/dossiers/consultation/create/'.$dossier->id)}}">Consultation</a>
                    <a class="dropdown-item" href="{{url('administrateur/dossiers/examenbio/create/'.$dossier->id)}}">Examen Bio</a>
                    <a class="dropdown-item" href="{{url('administrateur/dossiers/examenradio/create/'.$dossier->id)}}">Examen Radio</a>
                </div>
            </div>

        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Médecin</th>
                    <th>Pièce jointe</th>
                    <th>URL Pacs</th>
                    <th>Remarques</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consultation as $cons)
                <tr class="table-primary">
                    <td><a href="{{url('administrateur/dossiers/'.$dossier->id.'/consultation/'.$cons->id.'/show')}}" class="btn btn-primary">ID:{{$cons->id}}</a></td>
                    <td>Consultation</td>
                    <td>{{date('d/m/Y',strtotime($cons->date))}}</td>
                    <td>@if($cons->id_medecin){{$cons->medecin->prenom}} {{$cons->medecin->nom}}@endif</td>
                    <td>
                        @if($cons->files->count()!=0)
                        <a href="{{url('administrateur/dossiers/'.$dossier->id.'/consultation/showExamenfiles/'.$cons->id)}}">
                            <i data-feather="paperclip"></i>
                        </a>
                        @endif
                    </td>
                    <td>{{$cons->url_pacs}}</td>
                    <td>
                        @if($cons->remarques)
                        <h5><a href="#" class="badge badge-danger">{{$cons->remarques}}</a></h5>
                        @endif
                    </td>
                </tr>
                @endforeach

                @foreach($examenBio as $exbio)
                <tr class="table-success">
                    <td><a href="{{url('administrateur/dossiers/'.$dossier->id.'/examenbio/'.$exbio->id.'/show')}}" class="btn btn-primary">ID:{{$exbio->id}}</a></td>
                    <td>Examen bio</td>
                    <td>{{date('d/m/Y',strtotime($exbio->date))}}</td>
                    <td>@if($exbio->id_medecin){{$exbio->medecin->prenom}} {{$exbio->medecin->nom}}@endif</td>
                    <td>
                        @if($exbio->files->count()!=0)
                        <a href="{{url('administrateur/dossiers/'.$dossier->id.'/examenbio/showExamenfiles/'.$exbio->id)}}">
                            <i data-feather="paperclip"></i>
                        </a>
                        @endif
                    </td>
                    <td>{{$exbio->url_pacs}}</td>
                    <td>
                        @if($exbio->remarques)
                        <h5><a href="#" class="badge badge-danger">{{$exbio->remarques}}</a></h5>
                        @endif
                    </td>
                </tr>
                @endforeach

                @foreach($examenRadio as $exradio)
                <tr class="table-warning">
                    <td><a href="{{url('administrateur/dossiers/'.$dossier->id.'/examenradio/'.$exradio->id.'/show')}}" class="btn btn-primary">ID:{{$exradio->id}}</a></h1>
                    </td>
                    <td>Examen radio</td>
                    <td>{{date('d/m/Y',strtotime($exradio->date))}}</td>
                    <td>@if($exradio->id_medecin){{$exradio->medecin->prenom}} {{$exradio->medecin->nom}}@endif</td>
                    <td>
                        @if($exradio->files->count()!=0)
                        <a href="{{url('administrateur/dossiers/'.$dossier->id.'/examenradio/showExamenfiles/'.$exradio->id)}}">
                            <i data-feather="paperclip"></i>
                        </a>
                        @endif
                    </td>
                    <td><a href="{{url('examenradio/urlRadio/'.$exradio->id)}}">{{$exradio->url_pacs}}</a></td>
                    <td>
                        @if($exradio->remarques)
                        <h5><a href="#" class="badge badge-danger">{{$exradio->remarques}}</a></h5>
                        @endif
                    </td>
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

    function myFunction1() {
        var input1, filter1, table, tr, td, i, txtValue;
        input1 = document.getElementById("myInput1");
        filter1 = input1.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter1) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection