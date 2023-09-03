@extends('layouat.layoutAdmin')
@section('contenu')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3 card-title"> Liste des pays</div>
            <div class="col-3">
                <a href="{{url('administrateur/pays/create')}}" class="btn btn-outline-success">
                    nouveau Pays
                </a>
            </div>
            <div class="col-6">
                <div class="input-group input-group-merge">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                    </div>
                    <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher pays.." aria-label="Search..." aria-describedby="email-search" />
                </div>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>Indicatif</th>
                    <th>Libelle</th>
                    <th>Actions</th>
                    <th>Remarques</th>
                </tr>
            </thead>
            <tbody>
                @forelse($Countries as $pays)
                <tr>
                    <td><a href="{{url('administrateur/pays/show/'.$pays->code)}}" class="btn btn-outline-primary">{{$pays->code}}</a></td>
                    <td>{{$pays->lib}}</td>
                    <td>
                        <a href="{{url('administrateur/pays/edit',$pays->code)}}" class="text-success">
                            <i data-feather="edit-3"></i>
                        </a>
                        <form action="{{ route('pays.deletepays', $pays->code) }}" method="POST" style="display:inline;"> {{ csrf_field() }} {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce pays {{ $pays->lib }} ?')"><i data-feather="trash"></i></button>
                        </form> 
                    </td>
                    <td></td>
                </tr>
                @empty<span class="badge badge-danger">Liste des pays vide !</span>
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