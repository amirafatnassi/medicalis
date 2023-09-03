@extends('layouat.layaoutPatient')
@section('contenu')

<div class="card">
  <div class="card-header">
    <div class="card-title col-4">Liste de consultations</div>
    <div class="col-2"><a href="{{url('patient/consultations/create/'.Auth::user('patient')->id)}}" class="btn btn-outline-success">Nouvelle Consultation</a></div>
    <div class="col-6">
      <div class="input-group input-group-merge">
        <div class="input-group-prepend">
          <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
        </div>
        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher consultation" aria-label="Search..." aria-describedby="email-search" />
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
          <th><i data-feather="paperclip"></i> Pièces jointes</th>
          <th>Remarques</th>
        </tr>
      </thead>
      <tbody>
        @foreach($liste_consultations as $consultation)
        <tr>
          <td><a href="{{url('patient/consultations/'.$consultation->id.'/show')}}" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true">{{$consultation->id}}</a></td>
          <td>{{date('d/m/Y',strtotime($consultation->date))}}</td>
          <td>
            @if ($consultation->medecin && $consultation->medecin->role_id==3)
            {{ $consultation->medecin->prenom }} {{ $consultation->medecin->nom }}
            @endif
          </td>
          <td>
            @if ($consultation->medecin && $consultation->medecin->specialite_id)
            {{$consultation->medecin->Specialite->lib}}
            @endif
          </td>
          <td>
            @if($consultation->files->count()>0)
            <a href="{{url('patient/consultations/showConsultationFiles/'.$consultation->id)}}"><i data-feather="paperclip"></i></a>
            @endif
          </td>
          <td>
            @if($consultation->remarques)
            <a href="#" class="badge badge-danger">{{$consultation->remarques}}</a>
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
      td = tr[i].getElementsByTagName("td")[3];
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