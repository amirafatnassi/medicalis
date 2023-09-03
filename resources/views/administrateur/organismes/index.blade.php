@extends('layouat.layoutAdmin')
@section('contenu')
<div class="card">
    <div class="card-header row">
        <div class="col-4 card-title">Liste de organismes</div>
        <div class="col-2">
                <a href="{{url('administrateur/organismes/create')}}" class="btn btn-outline-success">
                    nouveau organisme
                </a>
            </div>
        <div class="col-6">
           <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                </div>
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher consultation selon libellé.." aria-label="Search..." aria-describedby="email-search" />
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table id="myTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libelle</th>
                    <th>Actions</th>
                    <th>Remarques</th>
                </tr>
            </thead>
            <tbody>
                @forelse($Organismes as $organisme)
                <tr>
                    <td>{{$organisme->id}}</td>
                    <td>{{$organisme->lib}}</td>
                    <td>
                        <a href="{{url('administrateur/organismes/edit',$organisme->id)}}" class="text-success">
                            <i data-feather="edit-3"></i>
                        </a>
                        <form action="{{ route('organisme.deleteorganisme', $organisme->id) }}" method="POST" style="display:inline;"> {{ csrf_field() }} {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet organisme {{ $organisme->lib }} ?')"><i data-feather="trash"></i></button>
                        </form> 
                    </td>
                    <td></td>
                </tr>
                @empty<span class="badge badge-danger">Liste d'organismes vide !</span>
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
@endsection