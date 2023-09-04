@extends('layouat.layoutPatientNoHeader')
@section('contenu')

<div class="row">
  <div class="col-lg-2 col-3">
    <ul class="timeline">
      <a href="{{url('/patient/discussions/create')}}" class="list-group-item list-group-item-action active">
        <i data-feather="plus-circle" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Nouvelle discussion</span>
      </a>
      <a href="{{url('/patient/discussions/recu')}}" class="list-group-item list-group-item-action">
        <i data-feather="mail" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Discussions reçues</span>
      </a>
      <a href="{{url('/patient/discussions/envoye')}}" class="list-group-item list-group-item-action">
        <i data-feather="send" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Discussions envoyé</span>
      </a>
      <a href="{{url('/patient/discussions/cloture')}}" class="list-group-item list-group-item-action">
        <i data-feather="info" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Discussions Cloturés</span>
      </a>
      <a href="{{url('/patient/discussions/recucloture')}}" class="list-group-item list-group-item-action">
        <i data-feather="info" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Discussions reçues cloturés</span>
      </a>
      <a href="{{url('/patient/discussions/envoyecloture')}}" class="list-group-item list-group-item-action">
        <i data-feather="info" class="font-medium-3 mr-50"></i>
        <span class="align-middle">Discussions envoyé Cloturés</span>
      </a>
    </ul>
  </div>
  <div class="col-lg-10 col-9">
    <form method="POST" action="{{url('/patient/discussions/store')}}" enctype="multipart/form-data"> @csrf
      <div class="card">
        <div class="card-header">
          <div class="card-title">Nouvelle discussion</div>
        </div>
        <div class="card-body row">
          <div class="col-md-6 col-12">
            <label><b>Type de discussion:</b></label>
            <select name="type_courrier" id="type_courrier" class="form-control" required>
              <option selected>Avis médical</option>
              <option>Information libre</option>
              <option>Téléradiologie</option>
              <option>Demande devis</option>
            </select>
          </div>
          <div class="col-md-6 col-12">
            <label for="dossier"><b>Dossier médical:</b></label>
            <select name="dossier_id" id="dossier_id" class="form-control">
              <option value="{{$dossier->id}}">{{$dossier->id}}: {{$dossier->user->prenom}} {{$dossier->user->nom}}</option>
            </select>
          </div>
          <div class="col-12">
            <label for=""><b>Médecin destintaire:</b></label>
          </div>
          <div class="col-12">
            <input type="text" id="filter_input" class="form-control">
          </div>
          <div class="col-12 mt-1">
            <select name="destination_id" id="user_select" class="form-control">
              @foreach($meds as $med)
              <option value="{{$med->id}}"> {{$med->prenom}} {{$med->nom}} , {{$med->specialite->lib}} , @if($med->Country){{$med->Country->lib}}@endif @if($med->Ville){{$med->Ville->name}}@endif</option>
              @endforeach
            </select>
          </div>
          <div class="col-12">
            <label for="title"><b>Sujet:</b></label>
            <input type="text" name="title" class="form-control" id="sujet">
          </div>
          <div class="col-12">
            <label for="content"><b>Message:</b></label>
            <textarea class="CKEDITOR form-control" id="content" name="content" placeholder="observation"></textarea>
          </div>
          <div class="col-12">
            <label for="file"><b>Pièce jointe:</b></label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                <label class="custom-file-label" id="filename">Choisir fichier</label>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary" id="b_submit">
            <i data-feather="send"></i> Envoyer
          </button>
        </div>
      </div>
    </form>


  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    let allOptions = $('#user_select option').clone();

    $('#filter_input').keyup(filterUsers);

    function filterUsers() {
      let filterValue = $('#filter_input').val().toLowerCase();
      let keywords = filterValue.split(' ').filter(keyword => keyword !== '');

      $('#user_select').empty();

      allOptions.filter(function() {
        let userText = $(this).text().toLowerCase();
        return keywords.every(keyword => userText.includes(keyword));
      }).appendTo('#user_select');
    }
  });
</script>
<script>
  $(document).ready(function() {
    $.each($("#fileup")[0].files, function(key, value) {
      alert(key + ": " + value);
    });

    $("#fileup").change(function() {
      let filenames = [...this.files].map(file => file.name).join(", ");
      $("#filename").text(filenames);
    });

    $("#b_submit").click(function(e) {
      let sujet = $("#sujet");
      if (sujet.val() === "") {
        e.preventDefault();
        sujet.css("backgroundColor", "rgba(218, 79, 79, 0.3)");
      }
    });

    CKEDITOR.replace('content');
  });
</script>
@endsection