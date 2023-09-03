@extends('layouat.layoutAdmin')
@section('contenu')
<form method="POST" action="{{url('administrateur/medecins/update', ['medecin'=>$medecin->id])}}" enctype="multipart/form-data"> @csrf
    <div class="card">
        <div class="card-header">
            <div class="card-title">{{$medecin->prenom}} {{$medecin->nom}}</div>
        </div>
        <div class="card-body row">
            <div class="col-lg-6 col-12">
                <label for="nom">Nom:</label>
                <input class="form-control" name="nom" id="nom" type="text" value="{{old('nom',$medecin->nom ?? null)}}">
            </div>
            <div class="col-lg-6 col-12">
                <label for="prenom">Prénom:</label>
                <input class="form-control" name="prenom" id="prenom" type="text" value="{{old('prenom', $medecin->prenom ?? null)}}">
            </div>
            <div class="col-lg-6 col-12">
                <label for="sexe">Sexe:</label>
                <select class="form-control" name="sexe" id="sexe">
                    <option value="{{$medecin->Sexe->id}}" selected> {{$medecin->Sexe->lib}}</option>
                    @foreach ($Sexes as $sexe)
                    <option value="{{$sexe->id}}">{{$sexe->lib}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6 col-12">
                <div class="form-group">
                    <label for="image">Image:</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <label for="specialite">Spécialité:</label>
                <select class="form-control" name="specialite" id="specialite">
                    <option value="{{$medecin->Specialite->id}}"> {{$medecin->Specialite->lib}}</option>
                    @foreach ($Specialites as $spe)
                    <option value="{{$spe->id}}"> {{$spe->lib}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6 col-12">
                <label for="organisme">Organisme:</label>
                <select class="form-control" name="organisme" id="organisme">
                    <option value="{{$medecin->Organisme->id}}"> {{$medecin->Organisme->lib}}</option>
                    @foreach ($Organismes as $org)
                    <option value="{{$org->id}}"> {{$org->lib}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6 col-12">
                <label for="tel">Tel:</label>
                <input class="form-control" name="tel" id="tel" type="number" value="{{old('tel', $medecin->tel ?? null)}}">
            </div>
            <div class="col-lg-6 col-12">
                <label for="email">E-mail:</label>
                <input class="form-control" name="email" id="email" type="text" value="{{old('email', $medecin->email ?? null)}}">
            </div>
            <div class="col-lg-6 col-12">
                <label for="Adresse">Adresse:</label>
            </div>
            <div class="col-12">
                <label for="rue">Rue:</label>
                <input class="form-control" name="rue" id="rue" type="text" value="{{old('rue', $medecin->rue ?? null)}}">
            </div>
            <div class="col-2">
                <label for="cp">CP:</label>
                <input class="form-control" name="cp" id="cp" type="text" value="{{old('cp', $medecin->cp ?? null)}}">
            </div>
            <div class="col-5">
                <label for="pays">Pays:</label>
                <select class="form-control" name="pays" id="pays">
                    <option value="{{$medecin->Country->code}}"> {{$medecin->Country->lib}}</option>
                    @foreach ($Countries as $count)
                    <option value="{{$count->code}}"> {{$count->lib}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-5">
                <label for="ville">Ville:</label>
                <select name="ville" id="ville" class="form-control">
                    <option value="{{$medecin->Ville->id_ville}}"> {{$medecin->Ville->name}}</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit">
                <i data-feather="save"></i> Enregistrer modifications
            </button>
        </div>
    </div>
</form>
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