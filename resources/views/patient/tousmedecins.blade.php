@extends('layouat.layaoutPatient')
@section('contenu')

<div class="card">
    <div class="card-body">
        <form method="get" action="{{url('patient/tousmedecins')}}">
        <div class="card-header row">
            <div class="card-title col-12">Chercher un medecin</div>
            <div class="col-6">
            <div class="input-group input-group-merge">
              <div class="input-group-prepend">
                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
              </div>
              <select name="country" id="pays" class="form-control">
                <option value="d">Tous</option>
                @foreach($Countries as $key => $country)
                <option value="{{$country->code}}" @if( old("pays")==$country->code) selected="selected" @endif> {{$country->lib}}</option>
                @endforeach
              </select>
            </div>
          </div>
            <div class="col-5">
            <div class="input-group input-group-merge">
              <div class="input-group-prepend">
                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
              </div>
              <select name="ville" id="state" class="form-control">
                <option value="d">Tous</option>
              </select>
            </div>
          </div>
            <div class="col-1">
                <button class="btn btn-primary pull-right" type="submit" id="b_submit"><i data-feather="search"></i></button>
            </div>
        </div>
        </form>
        <div class="table-responsive">
            <table id="myTable" class="table table-striped table-bordered">
                <thead>
                <tr>
                  <th>Organisme</th>
                  <th>Nom et prénom</th>
                  <th>Spécialité</th>
                  <th>Adresse</th>
                  <th>Tel</th>
                  <th>Ajouter Medecin</th>
                </tr>
                </thead>
                <tbody>
                @foreach($liste_medecins as $medecin)
                <tr>
                    <td>{{$medecin->Organisme->lib ?? 'N/A'}}</td>
                    <td>{{$medecin->prenom}} {{$medecin->nom}}</td>
                    <td>{{$medecin->Specialite->lib}}</td>
                    <td>@if($medecin->ville_id){{$medecin->Ville->name}},@endif {{$medecin->Country->lib}}</td>
                    <td>{{$medecin->tel}}</td>
                    <td>
                        @if (DB::table('dossier_users')->where('dossier_id', $dossier->id)->where('user_id', $medecin->id)->exists())
                            <!-- Medecin exists in dossier_users table -->
                        @else
                            <!-- Medecin doesn't exist in dossier_users table -->
                            <a class="btn btn-primary" href="{{url('patient/tousmedecins/'.$medecin->id)}}"><i data-feather="user-plus"></i></i></a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#pays').change(function() {
            var countryID = $(this).val();console.log(countryID);
            if (countryID) {console.log('test');
                $.ajax({
                    type: "GET",
                    url: "{{url('get-ville-list')}}?pays=" + countryID,
                    success: function(res) {console.log(res);
                        if (res) {
                            $("#state").empty();
                            $.each(res, function(key, value) {
                                $("#state").append('<option value="' + key + '">' + value + '</option>');
                            });
                        } else {
                            $("#state").empty();
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