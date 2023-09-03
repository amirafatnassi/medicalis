@extends('layouat.layaoutPatient')
@section('contenu')

<div class="card-body">
    <form method="get" action="{{url('patient/tousmedecinstous')}}">
        <div class="row">
            <div class="col-12">
                <h5>Chercher un medecin:</h5>
            </div>
            <div class="col-5">
                <div class="input-group input-group-merge">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                    </div>
                    <select name="country" id="country" class="form-control">
                        <option value="d">Tous</option>
                        @foreach($countries as $key => $country)
                        <option value="{{$key}}" @if( old("country")==$key) selected="selected" @endif> {{$country}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-5">
                <div class="input-group input-group-merge">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                    </div>
                    <select name="ville" id="ville" class="form-control">
                        <option value="d">Tous</option>
                        @foreach($listVilles as $key => $listVille)
                        <option value="{{$key}}" @if( old("ville")==$key) selected="selected" @endif> {{$listVille}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="row">
                    <div class="col-6"><button class="btn btn-primary pull-right" type="submit" id="b_submit"><i data-feather="search" class="mr-1"></i></button></div>
                    <div class="col-6"><a href="{{url('/patient/tousmedecins')}}" class="btn btn-primary"><i data-feather="home" class="mr-1"></i></a></div>
                </div>
            </div>
    </form>
</div>
<br />
<table id="myTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th style="width:10%">Organisme</th>
            <th style="width:25%">Nom et prénom</th>
            <th style="width:15%">Spécialité</th>
            <th style="width:30%">Adresse</th>
            <th style="width:10%">Tel</th>
            <th style="width:10%">Ajouter Medecin</th>
        </tr>
    </thead>
    <tbody>
        @foreach($liste_med_autre as $medecin)
        <tr>
            <td>{{$medecin->lib}}</td>
            <td>{{$medecin->prenom}} {{$medecin->nom}}</td>
            <td>{{$medecin->specialite}}</td>
            <td>{{$medecin->name}} {{$medecin->pays}}</td>
            <td>{{$medecin->tel}}</td>
            <td><a class="btn btn-info" href="{{url('/tousmedecins/'.$medecin->id)}}"><i data-feather="user" class="mr-1"></i></a></td>
        </tr>
        @endforeach
        @foreach($liste_med_patient as $med)
        <tr>
            <td>{{$med->lib}}</td>
            <td>{{$med->prenom}} {{$med->nom}}</td>
            <td>{{$med->specialite}}</td>
            <td>{{$med->pays}} {{$med->name}}</td>
            <td>{{$med->tel}}</td>
            <td><button type="button" class="btn btn-outline-info" disabled><i data-feather="user" class="mr-1"></i></button></td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>
</body>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

<script type="text/javascript">
    $('#country').change(function() {
        console.log('ttttt');
        var countryID = $(this).val();
        if (countryID) {
            console.log("ok:" + countryID);
            $.ajax({
                type: "GET",
                url: "{{url('get-ville')}}?country_id=" + countryID,
                success: function(res) {
                    if (res) {
                        $("#ville").empty();
                        $("#ville").append('<option value="d" selected>Tous</option>');
                        $.each(res, function(key, value) {
                            $("#ville").append('<option value="' + key + '">' + value + '</option>');
                        });

                    } else {
                        $("#ville").empty();
                    }
                }
            });
        } else {
            $("#ville").empty();

        }
    });
</script>
@endsection