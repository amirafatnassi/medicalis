@extends('layouat.layaoutPatient')
@section('contenu')

<div class="card">
    <div class="card-header">
        <div class="col-6 card-title">Mes médecins</div>
        <div class="col-6">
            <div class="input-group input-group-merge">
              <div class="input-group-prepend">
                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
              </div>
              <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher médecin" aria-label="Search..." aria-describedby="email-search" />
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table" id="myTable" class="table-responsive">
            <thead>
              <tr>
                <th>Nom et prénom</th>
                <th>Spécialité</th>
                <th><i data-feather="flag"></i> Pays</th>
                <th><i data-feather="phone"></i> Tel</th>
                <th>E-mail</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($listeMedecins as $medecin)
              <tr>
                <td><a type="button" aria-disabled="true" href="{{url('patient/medecin/'.$medecin->id)}}">{{$medecin->prenom}} {{$medecin->nom}}</td>
                <td>{{$medecin->Specialite->lib}}</td>
                <td >{{$medecin->country->lib}}</td>
                <td>{{$medecin->tel}}</td>
                <td><a href="{{url('mailto:'.$medecin->email)}}">{{$medecin->email}}</a></td>
                <td>
                    <a href="{{url('patient/medControle',['id'=>$medecin->id])}}" class="btn btn-success">
                        <i data-feather="lock"></i>
                    </a>
                    <a href="{{url('patient/discussions/createById',['id'=>$medecin->id])}}" class="btn btn-primary">
                        <i data-feather="send"></i>
                    </a>
                    <form action="{{ route('patient.deleteMedecin', $medecin->id) }}" method="POST" style="display:inline;"> {{ csrf_field() }} {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer Dr {{ $medecin->prenom }} {{$medecin->nom}} de votre liste de médecins traitants?')"><i data-feather="trash"></i></button>
                    </form>
                </td>
              </tr>
              @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  $('#ControleModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var recipent = button.data('id')
    var modal = $(this)
    modal.find('.modal-body #id_medecin').val(recipent);
  })
</script>
<script type="text/javascript">
  $('#ControleModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var recipent = button.data('id')
    var modal = $(this)
    modal.find('.modal-body #id_medecin').val(recipent);
  })
</script>
<script>
  function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
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