@component('menus.menu_med_traitant') @endcomponent

<br>
  <div class="col-6"><h5>Tous les médecins:</h5></div>  

  
  <table id="myTable" class="table table-striped table-bordered">
    <thead >
      <tr>
        <th>Organisme <i class="fas fa-sort"></i></th>
        <th>Nom et prénom <i class="fas fa-sort"></i></th>
        <th>Spécialité <i class="fas fa-sort"></i></th>
        <th>Pays <i class="fas fa-sort"></i></th>
        <th>Ville <i class="fas fa-sort"></i></th>
        <th>Rue <i class="fas fa-sort"></i></th>
        <th>Tel <i class="fas fa-sort"></i></th>
        <th>E-mail<i class="fas fa-sort"></i></th>
        <th>Nouvele Discussion</th>

      </tr>
    </thead>
    <tbody>
      @foreach($listMedecins as $medecin)
      <tr>
        <td>{{$medecin->lib}}</td>
        <td>{{$medecin->prenom}} {{$medecin->nom}}</td>
        <td>{{$medecin->specialite}}</td>
        <td>{{$medecin->pays}}</td>
        <td>{{$medecin->name}}</td>
        <td>{{$medecin->rue}}</td>
        <td>{{$medecin->tel}}</td>
        <td><a href="{{url('mailto:'.$medecin->email)}}">{{$medecin->email}}</a></td>
        <td><a class="btn btn-info" href="{{url('/discussions/createMed/'.$medecin->id)}}">Nouvelle Discussion</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>

<script>
$(document).ready(function(){
    $('#myTable').DataTable();
});
</script>