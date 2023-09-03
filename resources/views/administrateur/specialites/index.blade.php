@extends('layouat.layoutAdmin')
@section('contenu')
<div class="card">
    <div class="card-header row">
        <div class="col-4 card-title">Liste de specialites</div>
        <div class="col-2">
            <a href="{{url('administrateur/specialites/create')}}" class="btn btn-outline-success">
            Nouvelle spécialité
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
                    @forelse($Specialites as $specialite)
                    <tr>
                        <td>{{$specialite->id}}</td>
                        <td>{{$specialite->lib}}</td>
                        <td>
                            <a href="{{url('administrateur/specialites/edit',$specialite->id)}}" class="text-sucess">
                                <i data-feather="edit-3"></i>
                            </a>
                            <form action="{{ route('specialite.deletespecialite', $specialite->id) }}" method="POST" style="display:inline;"> {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette spécialiteé {{ $specialite->lib }} ?')"><i data-feather="trash"></i></button>
                            </form>
                        </td>
                        <td></td>
                    </tr>
                    @empty<span class="badge badge-danger">Liste de spécilaité vide !</span>
                    @endforelse
                </tbody>
            </table>
        </div>
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