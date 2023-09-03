@extends('layouat.layoutAdmin')
@section('contenu')
<div class="card">
    <div class="card-header">
        <div class="col-4 card-title">Liste des villes:</div>
         <div class="col-2">
            <a href="{{url('administrateur/pays/ville/create/'.$pays->code)}}" class="btn btn-outline-success">
                nouvelle ville
            </a>
        </div>
        <div class="col-6">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                    </div>
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher ville..." aria-label="Search..." aria-describedby="email-search" />
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libelle</th>
                    <th>Actions</th>
                    <th>Remarques</th>
                </tr>
            </thead>
            <tbody>
                @forelse($villes as $ville)
                <tr>
                    <td>{{$ville->id_ville}}</td>
                    <td>{{$ville->name}}</td>
                    <td>
                        <a href="{{ route('administrateur.pays.ville.edit', $ville->id_ville) }}" class="text-success"><i data-feather="edit"></i></a>
                        <form action="{{ route('ville.deleteville', $ville->id_ville) }}" method="POST" style="display:inline;"> {{ csrf_field() }} {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette ville {{ $ville->name }} ?')"><i data-feather="trash"></i></button>
                        </form>
                    </td>
                    <td></td>
                </tr>
                @empty<span class="badge badge-danger">Liste des villes vide !</span>
                @endforelse
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
<script>
    $(document).ready(function() {
    $('#myTable').dataTable();
});
</script>
@endsection