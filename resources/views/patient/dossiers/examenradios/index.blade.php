@extends('layouat.layaoutPatient')
@section('contenu')

<div class="card">
  <div class="card-header row">
    <div class="col-3 card-title">Liste d'examens radio</div>
    <div class="col-3"><a href="{{url('patient/examenradios/create')}}" class="btn btn-outline-success">Nouveau Examen Radio</a></div>
    <div class="col-6">
      <div class="input-group input-group-merge">
        <div class="input-group-prepend">
          <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
        </div>
        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher Rechercher examen radio" aria-label="Search..." aria-describedby="email-search" />
      </div>
    </div>
  </div>

  <div class="card-body table-responsive">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Date</th>
          <th>Médecin</th>
          <th>Spécialité</th>
          <th>URL Pacs</th>
          <th><i data-feather="paperclip"></i> Pièces jointes</th>
          <th>Remarques</th>
        </tr>
      </thead>
      <tbody>
        @foreach($liste_examenradios as $examenradio)
        <tr>
          <td><a href="{{url('patient/examenradios/'.$examenradio->id.'/show')}}" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true">ID:{{$examenradio -> id}}</a></td>
          <td>{{date('d/m/Y',strtotime($examenradio->date))}}</td>
          <td>@if($examenradio->id_medecin)
            {{$examenradio->medecin->prenom}} {{$examenradio->medecin->nom}}
            @endif
          </td>
          <td>@if($examenradio->id_medecin && $examenradio->medecin->specialite_id)
            {{$examenradio->medecin->Specialite->lib}}
            @endif
          </td>
          <td><a href="{{$examenradio->url_radio}}" target="_blank">{{$examenradio->url_radio}}</a></td>
          <td>
            @if($examenradio->files->count()>0)
            <a href="{{url('patient/examenradios/showExamenradioFiles/'.$examenradio->id)}}"><i data-feather="paperclip"></i></a>
            @endif
          </td>
          <td style="width:10%">
            @if(!is_null($examenradio->remarques))
            <h5><a href="#" class="badge badge-danger">{{$examenradio->remarques}}</a></h5>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

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