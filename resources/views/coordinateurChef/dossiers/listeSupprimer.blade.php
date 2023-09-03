@extends('menus.layoutCoordinateurChef')
@section('contenu')

<div class="row">
    <div class="col-4">
        <h3>Effets marquants:</h3>
    </div>
    <div class="col-2"><a href="{{URL::previous()}}" class="btn btn-primary">Antécédants</a></div>
    <div class="col-6">
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
            </div>
            <input type="text" class="form-control" id="myInput1" onkeyup="myFunction1()" placeholder="Rechercher effet marquant selon date.." title="Type in a name">
        </div>
    </div>
    <div class="col-12">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th style="width:15%">ID</th>
                    <th style="width:15%">Date</th>
                    <th style="width:40%">Observation...</th>
                    <th style="width:15%">Supprimé par</th>
                    <th style="width:15%">Date Suppression</th>
                </tr>
            </thead>
            <tbody>
                @foreach($liste_consultations as $consultation)
                <tr>
                    <td><a href="{{url('coordinateurChef/dossiers/consultations/show/'.$consultation->id)}}" class="btn btn-primary">ID: {{$consultation -> id}}</a></td>
                    <td>{{date('d/m/Y',strtotime($consultation->date))}}</td>
                    <td>{!!$consultation->observation!!}</td>
                    <td>{{$consultation->nom}} {{$consultation->prenom}}</td>
                    <td>{{$consultation->deleted_at}}</td>
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
</section>
<!-- Dashboard Ecommerce ends -->

</div>
</div>
</div>
<!-- END: Content-->
@endsection