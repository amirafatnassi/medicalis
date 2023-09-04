@extends('layouat.layaoutPatient')
@section('contenu')

<div class="card">
    <div class="card-header row">
        <div class="card-title col-6">Liste de coordinateurs disponibles sur la platforme</div>
        <div class="col-6">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                </div>
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher médecin selon nom et prénom.." aria-label="Search..." aria-describedby="email-search" />
            </div>
        </div>
    </div>

    <div class="card-body">
        <table id="myTable" class="table table-striped">
            <tr>
                <td>Nom et prénom</td>
                <td>Role</td>
                <td>Tel</td>
                <td>E-mail</td>
                <td>Actions</td>
            </tr>
            @foreach($coordinateurs as $c)
            <tr class="list-goup-item">
                <td><a type="button" href="{{url('patient/coordinateurs/show',$c->id)}}">{{$c->prenom}} {{$c->nom}}</a></td>
                <td>{{$c->Role->lib}}</td>
                <td>{{$c->tel}}</td>
                <td>{{$c->email}}</td>
                <td>
                    @if ($c->dossierUsers->contains('dossier_id', $dossier->id))
                    <form action="{{ route('patient.deactivate.coordinateur', ['userId' => $c->id]) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success">Désactiver</button>
                    </form>
                    @else
                    <form action="{{ route('patient.activate.coordinateur', ['userId' => $c->id]) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">Activer</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
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
            td = tr[i].getElementsByTagName("td")[1];
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