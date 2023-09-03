@extends('layouat.layaoutMedecin')
@section('contenu')
<div class="row">
    <div class="col-2">
        <div class="position-relative">
            <div class="profile-img-container d-flex align-items-center">
                <div class="profile-img">
                    <img src="{{ asset('uploads/users/' . ($medecin->image ??'user.png')) }}" class="rounded img-fluid" alt="Card image" />
                </div>
            </div>
            <div class="row">
                <a class="btn btn-block btn-primary" href="{{ url('medecin/profile')}}"><i data-feather="eye" class="mr-1"></i></a>
            </div>
        </div>
    </div>
    <div class="col-10">
        <form method="post" action="{{url('medecin/updateMonProfil')}}" enctype="multipart/form-data"> @csrf
            <div class="card">
                <div class="card-body row">
                    <div class="col-5">
                        <label for="nom">Nom:</label>
                        <input class="form-control" name="nom" id="nom" type="text" value="{{old('nom',$medecin->nom ?? null)}}">
                    </div>
                    <div class="col-5">
                        <label for="prenom">Prénom:</label>
                        <input class="form-control" name="prenom" id="prenom" type="text" value="{{old('prenom', $medecin->prenom ?? null)}}">
                    </div>
                    <div class="col-2">
                        <label for="sexe">Sexe:</label>
                        <select class="form-control" name="sexe" id="sexe">
                            <option value="{{$medecin->Sexe->id}}">{{$medecin->Sexe->lib}}</option>
                            @foreach($Sexes as $sx)
                            <option value="{{$sx->id}}">{{$sx->lib}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="sexe">Spécialité:</label>
                        <select class="form-control" name="specialite" id="specialite">
                            <option value="{{$medecin->Specialite->id}}">{{$medecin->Specialite->lib}}</option>
                            @foreach($Specialites as $s)
                            <option value="{{$s->id}}">{{$s->lib}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input">
                                    <label class="custom-file-label">{{old('nom',$medecin->image ?? null)}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="tel">Tel:</label>
                        <input class="form-control" name="tel" id="tel" type="text" value="{{old('tel', $medecin->tel ?? null)}}">
                    </div>
                    <div class="col-6">
                        <label for="email">E-mail:</label>
                        <input class="form-control" name="email" id="email" type="text" value="{{old('email', $medecin->email ?? null)}}">
                    </div>
                    <div class="col-12">
                        <label for="Adresse">Adresse:</label>
                    </div>
                    <div class="col-4">
                        <label for="pays">pays:</label>
                        <select id="pays" name="pays" class="form-control">
                            <option value="{{$medecin->country->code}}"> {{$medecin->country->lib}}</option>
                            @foreach($Countries as $key=>$country)
                            <option value="{{$country->code}}">{{$country->lib}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="title">ville:</label>
                            <select name="ville" id="ville" class="form-control">
                                @if($medecin->ville_id)
                                <option value="{{$medecin->Ville->id_ville}}"> {{$medecin->Ville->name}}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="cp">Code postal:</label>
                        <input type="text" class="form-control" id="cp" name="cp" value="{{old('cp',$medecin->cp ?? null)}}">
                    </div>
                    <div class="col-12">
                        <label for="rue">Rue:</label>
                        <input class="form-control" name="rue" id="rue" type="text" value="{{old('rue', $medecin->rue ?? null)}}">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer modification</button>
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
                        $("#ville").append('<option>Select</option>');
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