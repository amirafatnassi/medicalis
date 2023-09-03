@extends('layouat.layaoutPatient')
@section('contenu')

<form method="POST" action="{{url('patient/examenradios/store')}}" enctype="multipart/form-data"> @csrf
    <div class="card">
        <div class="card-header"><div class="card-title">Nouveau examen radio:</div></div>
        <div class="card-body row">
            <div class="col-6">
                <label for="date"><b>Date:</b></label>
                <input class="form-control" name="date" id="date" type="date" value="{{old('date',now()->toDateString() ?? null)}}">
            </div>
            <div class="col-6">
                <label for="id_specialite">Specialité:</label>
                <select class="form-control" name="id_specialite" id="id_specialite" onchange="myFunction1()">
                    @foreach ($Specialites as $list_med)
                    <option value="{{$list_med->id}}"> {{$list_med->lib}} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label for="typeradio"><b>Modalité:</b></label>
                <select id="typeradio" name="typeradio" class="form-control">
                    <option value=""> select</option>
                    @foreach($RadioTypes as $key=>$country)
                    <option value="{{$country->id}}">{{$country->lib}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label for="state"><b>Examen:</b></label>
                <select name="state" id="state" class="form-control"></select>
            </div>
            <div class="col-6">
                <label for="url_radio"><b>URL Pacs (à saisir manuellement):</b></label>
                <input class="form-control" id="url_radio" name="url_radio" placeholder="url radio">
            </div>
            <div class="col-12">
                <label for="file"><b>Pièce jointe (compte rendu ou autres):</b></label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                        <label class="custom-file-label" id="filename">Choisir fichier</label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <label for="lettre"><b>Compte rendu ou observations:</b></label>
                <textarea class="ckeditor form-control" id="lettre" name="lettre" placeholder="lettre" cols="30" rows="30">{{old('lettre') }}</textarea>
                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" hidden>
                    Le rapport est obligatoire !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit" id="b_submit"> <i data-feather="save"></i> Terminer examen radio</button>
        </div>
    </div>
</form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    // Handle file upload changes
    $("#fileup").change(function() {
      var chaine = "";
      $.each(this.files, function(key, value) {
        chaine += value.name + ',';
      });
      $("#filename").text(chaine);
    });

    // Handle form submission
    $("#b_submit").click(function(e) {
      var type_radio = $("#typeradio");
      var radio = $("#state");

      if (type_radio.val() === '' && radio.val() === '') {
        e.preventDefault();
        type_radio.css("backgroundColor", "rgba(218, 79, 79, 0.3)");
        radio.css("backgroundColor", "rgba(218, 79, 79, 0.3)");
      } else if (type_radio.val() !== '' && radio.val() === '') {
        e.preventDefault();
        type_radio.css("backgroundColor", "rgba(255, 255, 255, 0.3)");
        radio.css("backgroundColor", "rgba(218, 79, 79, 0.3)");
      } else if (type_radio.val() === '') {
        e.preventDefault();
        type_radio.css("backgroundColor", "rgba(218, 79, 79, 0.3)");
        radio.css("backgroundColor", "rgba(255, 255, 255, 0.3)");
      } else if (radio.val() === '') {
        e.preventDefault();
        type_radio.css("backgroundColor", "rgba(255, 255, 255, 0.3)");
        radio.css("backgroundColor", "rgba(218, 79, 79, 0.3)");
      } else {
        return confirm('Voulez-vous vraiment enregistrer cet examen radio? Vous ne pourrez plus apporter des modifications');
      }
    });

    // Handle select change for URL radio
    $("#option").change(function() {
      var url_radio = $("#url_radio");
      if ($(this).val() === "Autres") {
        url_radio.css("display", "block");
        url_radio.prop("disabled", false);
      } else {
        url_radio.css("display", "none");
        url_radio.prop("disabled", true);
      }
    });

    // Handle select change for NV ex
    $("#state").change(function() {
      var nv_ex = $("#nv_ex");
      if (
        $(this).val() === "13" ||
        $(this).val() === "19" ||
        $(this).val() === "20" ||
        $(this).val() === "21"
      ) {
        nv_ex.css("display", "block");
        nv_ex.prop("disabled", false);
      } else {
        nv_ex.css("display", "none");
        nv_ex.prop("disabled", true);
      }
    });

    // Handle typeradio change
    $('#typeradio').change(function() {
      var countryID = $(this).val();
      if (countryID) {
        $.ajax({
          type: "GET",
          url: "{{url('get-state-list')}}?typeradio=" + countryID,
          success: function(res) {
            var stateSelect = $("#state");
            stateSelect.empty();
            if (res) {
              stateSelect.append('<option value="">Select</option>');
              $.each(res, function(key, value) {
                stateSelect.append('<option value="' + key + '">' + value + '</option>');
              });
            }
          }
        });
      } else {
        $("#state").empty();
      }
    });
  });
</script>
@endsection