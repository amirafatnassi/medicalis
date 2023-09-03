@extends('menus.layoutCoordinateur')
@section('contenu')

<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="104" width="104" alt="User avatar" />
                        <div class="d-flex flex-column ml-1">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                                <span class="card-text">{{$dossier->email}}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a  href="{{url('coordinateur/dossiers/edit/'.$dossier->id)}}" class="btn btn-primary"> <i data-feather="edit-2"></i></a>
                                <a class="btn btn-outline-primary ml-1" href="">
                                    <i data-feather="printer" class="mr-1"></i>
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
<h3>Historiques de consultations:</h3>
<div class="row">
    <div class="col-5">
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
            </div>
            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher consultation selon spécialité.." aria-label="Search..." aria-describedby="email-search" />
        </div>
    </div>
    <div class="col-5">
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
            </div>
            <input type="text" class="form-control" id="myInput1" onkeyup="myFunction1()" placeholder="Rechercher consultation selon médecin.." title="Type in a name">
        </div>
    </div>
    <div class="col-2">
        <div class="row">
            <div>
                <a href="{{url('coordinateur/dossiers/'.$dossier->id.'/historiques')}}" class="btn btn-primary">Historiques</a>
            </div>
            <div>&nbsp;</div>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nouveau</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('medecin/consultation/create/'.$dossier->id)}}">Consultation</a>
                    <a class="dropdown-item" href="{{url('medecin/examenbio/create/'.$dossier->id)}}">Examen Bio</a>
                    <a class="dropdown-item" href="{{url('medecin/examenradio/create/'.$dossier->id)}}">Examen Radio</a>
                </div>
            </div>
        </div>
    </div>
</div>

<table class="table table-striped" id="myTable">
    <thead>
        <tr>
            <th style="width:10%">ID</th>
            <th style="width:15%">Type</th>
            <th style="width:10%">Date</th>
            <th style="width:10%">Médecin</th>
            <th style="width:15%">Spécialité</th>
            <th style="width:10%"><i data-feather="paperclip"></i>Pièce jointe</th>
            <th style="width:15%">URL Pacs</th>
            <th style="width:15%">Remarques</th>
        </tr>
    </thead>
    <tbody>
        @foreach($resultats as $consultation)
        @if(strcmp($consultation->type,"consultation")==0)
        <tr class="table-primary">
            <td><a href="{{url('coordinateur/dossiers/consultations/show/'.$consultation->id)}}" class="btn btn-primary">ID:{{$consultation->id}}</a></td>
            <td>Consultation</td>
            <td>{{date('d/m/Y',strtotime($consultation->date))}}</td>
            <td>{{$consultation->id_medecin}}</td>
            <td>{{$consultation->specialite}}</td>
            <td>
                @if(($consultation->downloads)!==0)
                <a href="{{url('coordinateur/dossiers/consultations/showExamenfiles/'.$consultation->id)}}"><i data-feather="paperclip"></i></a>
                @endif
            </td>
            <td>{{$consultation->url_pacs}}</td>
            <td>Saisie par : {{$consultation->user}}</td>
        </tr>

        @elseif (strcmp($consultation->type,"examenbio")==0)
        <tr class="table-success">
            <td><a href="{{url('coordinateur/dossiers/examenbios/show/'.$consultation->id)}}" class="btn btn-primary">ID:{{$consultation->id}}</a></td>
            <td>Examen bio</td>
            <td>{{date('d/m/Y',strtotime($consultation->date))}}</td>
            <td>{{$consultation->id_medecin}}</td>
            <td>{{$consultation->specialite}}</td>
            <td>
                @if(($consultation->downloads)!==0)
                <a href="{{url('coordinateur/dossiers/examenbios/showExamenfiles/'.$consultation->id)}}"><i data-feather="paperclip"></i></a>
                @endif
            </td>
            <td>{{$consultation->url_pacs}}</td>
            <td>Saisie par : {{$consultation->user}}</td>
        </tr>

        @elseif ($consultation->type=="examenradio")
        <tr class="table-warning">
            <td><a href="{{url('coordinateur/dossiers/examenradios/show/'.$consultation->id)}}" class="btn btn-primary">ID:{{$consultation->id}}</a></h1>
            </td>
            <td>Examen radio</td>
            <td>{{date('d/m/Y',strtotime($consultation->date))}}</td>
            <td>{{$consultation->id_medecin}}</td>
            <td>{{$consultation->specialite}}</td>
            <td>
                @if(($consultation->downloads)!==0)
                <a href="{{url('coordinateur/dossiers/examenradios/showExamenfiles/'.$consultation->id)}}"><i data-feather="paperclip"></i></a>
                @endif
            </td>
            <td><a href="{{url('examenradio/urlRadio/'.$consultation->id)}}">{{$consultation->url_pacs}}</a></td>
            <td>Saisie par : {{$consultation->user}}</td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>

<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[4];
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