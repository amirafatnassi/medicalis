@extends('layouat.layaoutPatient')
@section('contenu')

<div class="card">
    <form method="POST" action="{{url('patient/examenradios/update/'.$examenradio->id)}}" enctype="multipart/form-data"> @csrf
        <div class="card-header"><div class="card-title">Modifier examen radio</div></div>
        <div class="card-body row">
            <div class="col-6">
                <label for="date"><b>Date:</b></label>
                <input class="form-control" name="date" id="date" type="date" value="{{old('date',$examenradio->date ?? null)}}">
            </div>
            <div class="col-6"></div>
            <div class="col-6">
                <label for="typeradio"><b>Modalité:</b></label>
                <select id="typeradio" name="typeradio" class="form-control">
                    <option value="{{$examenradio->typeradio->id}}" selected>{{$examenradio->typeradio->lib}}</option>
                    @foreach($RadioTypes as $radtype)
                    <option value="{{$radtype->id}}">{{$radtype->lib}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label for="title"><b>Examen:</b></label>
                <select name="state" id="state" class="form-control">
                    <option value="{{$examenradio->Radio->id}}" selected>{{$examenradio->Radio->lib}}</option>
                </select>
            </div>
            <div class="col-6">
                <label for="nv_ex"><b>Autres (à saisir manuellement):</b></label>
                <input class="form-control" id="nv_ex" name="nv_ex" placeholder="nv_ex" disabled>
            </div>
            @if(!is_null($examenradio->url_radio))
            <div class="col-6">
                <label for="url_radio"><b>URL Pacs (à saisir manuellement):</b></label>
                <input class="form-control" id="url_radio" name="url_radio" placeholder="url radio" value="{{old('url_radio',$examenradio->url_radio ?? null)}}">
            </div>
            @else
            <div class="col-6">
                <label for="url_radio"><b>URL Pacs (à saisir manuellement):</b></label>
                <input class="form-control" id="url_radio" name="url_radio" placeholder="url radio">
            </div>
            @endif
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
                <label for="lettre"><b>Compte rendu:</b></label>
                <textarea class="ckeditor form-control" id="lettre" name="lettre" placeholder="lettre" cols="30" rows="30">{{old('lettre', $examenradio->lettre ?? null) }}</textarea>
                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" hidden>
                    Le rapport est obligatoire !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit" id="b_submit"> <i data-feather="save"></i> Terminer examen radio</button>
        </div>
    </form>
    @if($examenradio->files->count()!=0)
    <div class="card-header"><div class="card-title">Liste de téléchargements</div></div>
    <div class="card-body">
        @foreach($examenradio->files as $f)
        <div class="row" style="display: flex; align-items: center;">
            <a href="{{url('/uploads/exradio/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
            <form action="{{ route('patient.examenradio.deleteFile', $f->id) }}" method="POST" style="display:inline;"> {{ csrf_field() }} {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier: {{ $f->downloads }} ?')"><i data-feather="trash"></i></button>
            </form> 
        </div>
        @endforeach
    </div>
    @endif
</div>
<script>
    $(document).ready(function() {
    $("#fileup").change(function() {
      var filenames = Array.from(this.files, file => file.name).join(',');
      $("#filename").text(filenames);
    });
    
    $("#typeradio").change(function() {
      var radioTypeID = $(this).val();
      if (radioTypeID) {
        $.ajax({
          url: "{{url('dropdownlist/getradios/')}}" + "/" + radioTypeID,
          type: "GET",
          dataType: "json",
          success: function(data) {
            console.log(data);
            $("#state").empty();
            $.each(data, function(key, value) {
              $('#state').append('<option value="' + key + '">' + value + '</option>');
            });
          }
        });
      } else {
        $("#state").empty();
      }
    });

    var b_submit = document.getElementById("b_submit");
    var type_radio = document.getElementById("typeradio");
    var radio = document.getElementById("state");
    var msg = document.getElementById("msg");
    b_submit.addEventListener('click', valider);

    function valider(e) {
        if (!type_radio.value && !radio.value) {
            e.preventDefault();
            type_radio.style.backgroundColor = "rgba(218, 79, 79, 0.3)";
            radio.style.backgroundColor = "rgba(218, 79, 79, 0.3)";
        } else if (!type_radio.value && radio.value) {
            e.preventDefault();
            type_radio.style.backgroundColor = "rgba(255, 255, 255, 0.3)";
            radio.style.backgroundColor = "rgba(218, 79, 79, 0.3)";
        }  else if (type_radio.value && !radio.value) {
            e.preventDefault();
            type_radio.style.backgroundColor = "rgba(218, 79, 79, 0.3)";
            radio.style.backgroundColor = "rgba(255,255,255,0.3)";
        } else {
        return confirm('Voulez-vous vraiment enregistrer cet examen radio? Vous ne pourrez plus apporter de modifications.');
        }
    }
    $("#option").change(function() {
        var select = document.getElementById("option");
        var text = document.getElementById("url_radio");
        var disabled = document.getElementById("url_radio").disabled;
            if (select.value == "Autres") {
            url_radio.style.display = "block";
            document.getElementById("url_radio").disabled = false;
        } else {
            url_radio.style.display = "none";
            document.getElementById("url_radio").disabled = true;
        }
    });
    
    $("#id_specialite").change(function() {
      var med = document.getElementById("id_medecin").value;
      var url = document.getElementById('m');
      url.innerHTML = med;
      document.getElementById('url_radio').innerHTML = med;
      alert('ok');
      $.ajax({
        type: "GET",
        url: "{{url('get-pacs')}}?country_id=" + med,
        success: function(res) {
          if (res) {
            $("#option").empty();
            $.each(res, function(key, value) {
              $("#option").append('<option value="' + key + '">' + value + '</option>');
            });
            $("#option").append('<option>Autres</option>');
          }
        }
      });
    });
    
    $("#state").change(function() {
      var select_ex = document.getElementById("state");
      var nv_ex = document.getElementById("nv_ex");
      var disabled1 = document.getElementById("nv_ex").disabled;
      if (
        select_ex.value == 13 ||
        select_ex.value == 19 ||
        select_ex.value == 20 ||
        select_ex.value == 21
      ) {
        nv_ex.style.display = "block";
        document.getElementById("nv_ex").disabled = false;
      } else {
        nv_ex.style.display = "none";
        document.getElementById("nv_ex").disabled = true;
      }
    });
    
    // $('#typeradio').change(function() {
    //   var countryID = $(this).val();
    //   if (countryID) {
    //     $.ajax({
    //       type: "GET",
    //       url: "{{url('get-state-list')}}?typeradio=" + countryID,
    //       success: function(res) {
    //         if (res) {
    //           $("#state").empty();
    //           $("#state").append('<option value="">Select</option>');
    //           $.each(res, function(key, value) {
    //             $("#state").append('<option value="' + key + '">' + value + '</option>');
    //           });
    //         } else {
    //           $("#state").empty();
    //         }
    //       }
    //     });
    //   } else {
    //     $("#state").empty();
    //   }
    // });
  });
</script>
@endsection