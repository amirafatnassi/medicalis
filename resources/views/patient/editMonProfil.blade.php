@extends('layouat.layoutPatientNoHeader')
@section('contenu')
<div class="row">
    <div class="col-3">
        <img src="{{asset('uploads/users/'.($patient->image ?? 'user.png'))}}" class="rounded img-fluid" alt="Card image" />
        <div class="row">
            <a class="btn btn-block btn-primary" href="{{ url('patient/profile')}}"> <i data-feather="eye"></i></a>
        </div>
    </div>
    <div class="col-9">
        @if ($errors->any())
        <div class="alert alert-danger col-12">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="post" action="{{url('patient/updateProfil')}}" enctype="multipart/form-data"> @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Modifier mon profile</div>
                </div>
                <div class="card-body row">
                    <div class="col-5">
                        <label for="nom">Nom:</label>
                        <input class="form-control" name="nom" id="nom" type="text" value="{{old('nom',$patient->nom ?? null)}}">
                    </div>
                    <div class="col-5">
                        <label for="prenom">Prénom:</label>
                        <input class="form-control" name="prenom" id="prenom" type="text" value="{{old('prenom', $patient->prenom ?? null)}}">
                    </div>
                    <div class="col-2">
                        <label for="sexe_id">Sexe:</label>
                        <select class="form-control" name="sexe_id" id="sexe_id" disabled>
                            <option value="{{$patient->Sexe->lib}}">{{$patient->Sexe->lib}} </option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="datenaissance">Date de naissance</label>
                        <input type="date" id="datenaissance" class="form-control" required name="datenaissance" value="{{old('datenaissance', $patient->datenaissance ?? null)}}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="lieunaissance">Lieu de naissance</label>
                        <input type="texte" id="lieunaissance" class="form-control" name="lieunaissance" value="{{old('lieunaissance', $patient->lieunaissance ?? null)}}">
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input">
                                    <label class="custom-file-label">{{old('nom',$patient->image ?? null)}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="tel">Tel:</label>
                        <input class="form-control" name="tel" id="tel" type="text" value="{{old('tel', $patient->tel ?? null)}}">
                    </div>
                    <div class="col-6">
                        <label for="email">E-mail:</label>
                        <input class="form-control" name="email" id="email" type="text" value="{{old('email', $patient->email ?? null)}}">
                    </div>
                    <div class="col-12">
                        <label for="Adresse">Adresse:</label>
                    </div>
                    <div class="col-4">
                        <label for="pays">pays:</label>
                        <select id="pays" name="pays" class="form-control">
                            <option value="{{$patient->Country->code}}">{{$patient->Country->lib}} </option>
                            @foreach($Countries as $key=>$country)
                            <option value="{{$country->code}}">{{$country->lib}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="title">ville:</label>
                            <select name="ville" id="ville" class="form-control">
                                <option value="{{$patient->Ville->id_ville}}">{{$patient->Ville->name}} </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="cp">Code postal:</label>
                        <input type="number" class="form-control" id="cp" name="cp" value="{{old('cp',$patient->cp ?? null)}}">
                    </div>
                    <div class="col-12">
                        <label for="rue">Rue:</label>
                        <input class="form-control" name="rue" id="rue" type="text" value="{{old('rue', $patient->rue ?? null)}}">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save"></i>Enregistrer modification</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $('#pays').change(function() {
        var countryID = $(this).val();
        if (countryID) {
            $.ajax({
                type: "GET",
                url: "{{url('get-ville-list')}}?pays=" + countryID,
                success: function(res) {
                    if (res) {
                        $("#ville").empty();
                        $("#ville").append('<option value="">Select</option>');
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