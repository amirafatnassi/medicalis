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
                            <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->user->prenom}} {{$dossier->user->nom}}</h4>
                            <span class="card-text">{{$dossier->user->email}}</span>
                        </div>
                        <div class="d-flex flex-wrap">
                            <a href="{{url('coordinateur/dossiers/edit/'.$dossier->id)}}" class="btn btn-primary"> <i data-feather="edit-2"></i></a>
                            <a class="btn btn-outline-primary ml-1" href="">
                                <i data-feather="printer" class="mr-1"></i>
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
        <div class="col-3 card-title">Antécédants</div>
        <div class="col-3"><a href="{{url('coordinateur/'.$dossier->id.'/listeSupprimer')}}" class="btn btn-primary">Liste des antécédants Supprimé</a>&nbsp;</div>
        <div class="col-6">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                </div>
                <input type="text" class="form-control" id="myInput1" onkeyup="myFunction1()" placeholder="Rechercher effet marquant selon date.." title="Type in a name">
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Motif</th>
                    <th>Médecin</th>
                    <th>Date</th>
                    <th>Antécédant</th>
                    <th>Pièces jointes</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consultations as $consultation)
                <tr>
                    <td><a href="{{url('coordinateur/consultation/'.$consultation->id.'/show')}}" class="btn btn-primary">ID:{{$consultation->id}}</a></td>
                    <td>{{$consultation->Motif->lib}}</td>
                    <td>@if($consultation->medecin_id){{$consultation->medecin->prenom}} {{$consultation->medecin->nom}}@endif</td>
                    <td>{{date('d/m/Y',strtotime($consultation->date))}}</td>
                    <td>{{$consultation->effet_marquant_txt}}</td>
                    <td>
                        @if($consultation->files->count()>0)
                        <a href="{{url('coordinateur/consultation/showExamenfiles/'.$consultation->id)}}">
                            <i data-feather="paperclip"></i>
                        </a>
                        @endif
                    </td>
                    <td>
                        <form style="display:inline" method="post" action="{{url('coordinateur/'.$consultation->id.'/effetsmarquants/delete')}}">{{csrf_field()}} {{method_field('DELETE')}}
                            <button class="btn btn-danger" type="submit">
                                <i data-feather="trash-2"></i>
                            </button>
                        </form>
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
</script>
@endsection