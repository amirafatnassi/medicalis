@extends('layouat.layoutCoordinateur')
@section('contenu')

<div class="card user-card">
    <div class="card-body row">
        <div class="col-6">
            <div class="user-avatar-section">
                <div class="d-flex justify-content-start">
                    <img class="img-fluid rounded" src="{{asset('uploads/users/'.($dossier->user->image??'user.png'))}}" height="104" width="104" alt="User avatar" />
                    <div class="d-flex flex-column ml-1">
                        <div class="user-info mb-1">
                            <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->user->nom}} {{$dossier->user->nom}}</h4>
                            <span class="card-text">{{$dossier->user->email}}</span>
                        </div>
                        <div class="d-flex flex-wrap">
                            <a href="" class="btn btn-primary">
                                <i data-feather="edit-3"></i></a>
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
        <div class="card-title col-12">Historiques de consultations</div>
        <div class="col-6">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                </div>
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher consultation selon spécialité.." aria-label="Search..." aria-describedby="email-search" />
            </div>
        </div>
        <div class="col-6">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                </div>
                <input type="text" class="form-control" id="myInput1" onkeyup="myFunction1()" placeholder="Rechercher consultation selon médecin.." title="Type in a name">
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table " id="myTable">
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
                @foreach($consultation as $consult)
                <tr class="table-primary">
                    <td><a href="{{url('coordinateur/dossiers/consultations/show/'.$consult->id)}}" class="btn btn-primary">ID:{{$consult->id}}</a></td>
                    <td>Consultation</td>
                    <td>{{date('d/m/Y',strtotime($consult->date))}}</td>
                    <td>@if($consult->id_medecin){{$consult->medecin->prenom}} {{$consult->medecin->nom}}@endif</td>
                    <td>
                        @if($consult->files->count()!=0)
                        <a href="{{url('coordinateur/consultation/showExamenfiles/'.$consult->id)}}">
                            <i data-feather="paperclip"></i>
                        </a>
                        @endif
                    </td>
                    <td>{{$consult->url_pacs}}</td>
                    <td>
                        @if(!is_null($consult->remarques))
                        <h5><a href="#" class="badge badge-danger">{{$consult->remarques}}</a></h5>
                        @endif
                    </td>
                </tr>
                @endforeach
                @foreach($examenBio as $exbio)
                <tr class="table-success">
                    <td><a href="{{url('coordinateur/dossiers/examenbios/show/'.$exbio->id)}}" class="btn btn-primary">ID:{{$exbio->id}}</a></td>
                    <td>Examen bio</td>
                    <td>{{date('d/m/Y',strtotime($exbio->date))}}</td>
                    <td>@if($exbio->id_medecin){{$exbio->medecin->prenom}} {{$exbio->medecin->nom}}@endif</td>
                    <td>
                        @if($exbio->files->count()!=0)
                        <a href="{{url('coordinateur/examenbio/showExamenfiles/'.$exbio->id)}}">
                            <i data-feather="paperclip"></i>
                        </a>
                        @endif
                    </td>
                    <td>{{$exbio->url_pacs}}</td>
                    <td>
                        @if(!is_null($exbio->remarques))
                        <h5><a href="#" class="badge badge-danger">{{$exbio->remarques}}</a></h5>
                        @endif
                    </td>
                </tr>
                @endforeach
                @foreach($examenRadio as $exradio)
                <tr class="table-warning">
                    <td><a href="{{url('coordinateur/dossiers/examenradios/show/'.$exradio->id)}}" class="btn btn-primary">ID:{{$exradio->id}}</a></h1>
                    </td>
                    <td>Examen radio</td>
                    <td>{{date('d/m/Y',strtotime($exradio->date))}}</td>
                    <td>@if($exradio->id_medecin){{$exradio->medecin->prenom}} {{$exradio->medecin->nom}}@endif</td>
                    <td>
                        @if($exradio->files->count()!=0)
                        <a href="{{url('coordinateur/examenradio/showExamenfiles/'.$exradio->id)}}">
                            <i data-feather="paperclip"></i>
                        </a>
                        @endif
                    </td>
                    <td><a href="{{$exradio->url_radio}}" target="_blank">{{$exradio->url_radio}}</a></td>
                    <td>
                        @if(!is_null($exradio->remarques))
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