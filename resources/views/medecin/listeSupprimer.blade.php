@extends('layouat.layaoutMedecin')
@section('contenu')

<div class="card">
    <div class="card-header">
        <div class="card-title col-4">Effets marquants:</div>
        <div class="col-2"><a href="{{URL::previous()}}" class="btn btn-primary">Antécédants</a></div>
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
                    <th>Date</th>
                    <th>Observation...</th>
                    <th>Supprimé par</th>
                    <th>Date Suppression</th>
                </tr>
            </thead>
            <tbody>
                @foreach($liste_effets as $effet)
                <tr>
                    <td><a href="{{url('medecin/consultation/'.$effet->id_consultation.'/show')}}" class="btn btn-primary">ID: {{$effet -> id_consultation}}</a></td>
                    <td>{{date('d/m/Y',strtotime($effet->date))}}</td>
                    <td>{!!$effet->consultation->observation!!}</td>
                    <td>@if($effet->medecin){{$effet->medecin->nom}} {{$effet->medecin->prenom}}@endif</td>
                    <td>{{$effet->created_at}}</td>
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