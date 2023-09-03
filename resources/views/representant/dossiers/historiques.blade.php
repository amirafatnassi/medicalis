@extends('menus.layoutRepresentant')
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
                                <a href="" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                    </svg></a>
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

<div class="row">
    <div class="col-12">
        <h3>Historiques de consultations:</h3>
    </div>
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
                <a href="{{url('representant/dossiers/'.$dossier->id.'/monHistorique')}}" class="btn btn-primary">Mon historique</a>
            </div>
            <div>&nbsp;</div>
            <div>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="plus"></i></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{url('representant/dossiers/'.$dossier->id.'/consultations/create')}}">Consultation</a>
                        <a class="dropdown-item" href="{{url('representant/dossiers/'.$dossier->id.'/examenbios/create')}}">Examen Bio</a>
                        <a class="dropdown-item" href="{{url('representant/dossiers/'.$dossier->id.'/examenradios/create')}}">Examen Radio</a>
                    </div>
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
            <td><a href="{{url('representant/dossiers/consultations/show/'.$consultation->id)}}" class="btn btn-primary">ID:{{$consultation->id}}</a></td>
            <td>Consultation</td>
            <td>{{date('d/m/Y',strtotime($consultation->date))}}</td>
            <td>{{$consultation->id_medecin}}</td>
            <td>{{$consultation->specialite}}</td>
            <td>
                @if(($consultation->downloads)!==0)
                <a href="{{url('representant/dossiers/consultations/showExamenfiles/'.$consultation->id)}}"><i data-feather="paperclip"></i></a>
                @endif
            </td>
            <td>{{$consultation->url_pacs}}</td>
            <td>Saisie par : {{$consultation->user}}</td>
        </tr>

        @elseif (strcmp($consultation->type,"examenbio")==0)
        <tr class="table-success">
            <td><a href="{{url('representant/dossiers/examenbios/show/'.$consultation->id)}}" class="btn btn-primary">ID:{{$consultation->id}}</a></td>
            <td>Examen bio</td>
            <td>{{date('d/m/Y',strtotime($consultation->date))}}</td>
            <td>{{$consultation->id_medecin}}</td>
            <td>{{$consultation->specialite}}</td>
            <td>
                @if(($consultation->downloads)!==0)
                <a href="{{url('representant/dossiers/examenbios/showExamenfiles/'.$consultation->id)}}"><i data-feather="paperclip"></i></a>
                @endif
            </td>
            <td>{{$consultation->url_pacs}}</td>
            <td>Saisie par : {{$consultation->user}}</td>
        </tr>

        @elseif ($consultation->type=="examenradio")
        <tr class="table-warning">
            <td><a href="{{url('representant/dossiers/examenradios/show/'.$consultation->id)}}" class="btn btn-primary">ID:{{$consultation->id}}</a></h1>
            </td>
            <td>Examen radio</td>
            <td>{{date('d/m/Y',strtotime($consultation->date))}}</td>
            <td>{{$consultation->id_medecin}}</td>
            <td>{{$consultation->specialite}}</td>
            <td>
                @if(($consultation->downloads)!==0)
                <a href="{{url('representant/dossiers/examenradios/showExamenfiles/'.$consultation->id)}}"><i data-feather="paperclip"></i></a>
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