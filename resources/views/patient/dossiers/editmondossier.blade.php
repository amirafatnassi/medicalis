@extends('layouat.layaoutPatient')
@section('contenu')

<form method="post" action="{{url('patient/updatemondossier')}}" enctype="multipart/form-data"> @csrf
    <div class="card">
        <div class="card-header">
            <div class="card-title">Modifier mon dossier</div>
        </div>
        <div class="card-body row">
            <div class="col-4">
                <label for="nom"><b>Nom:</b></label>
                <input class="form-control" name="nom" id="nom" type="text" value="{{old('nom', $dossier->user->nom ?? null)}}">
            </div>
            <div class="col-4">
                <label for="prenom"><b>Prénom:</b></label>
                <input class="form-control" name="prenom" id="prenom" type="text" value="{{old('prenom', $dossier->user->prenom ?? null)}}">
            </div>
            <div class="col-4">
                <label for="sexe"><b>Sexe:</b></label>
                <select class="form-control" name="sexe" disabled>
                    <option>{{$dossier->user->Sexe->lib}}</option>
                </select>
            </div>
            <div class="col-6">
                <label for="profession"><b>Profession:</b></label>
                <select class="form-control" name="profession" id="profession">
                    @if($dossier->user->profession_id) <option value="{{$dossier->user->Profession->id}}">{{$dossier->user->Profession->lib}}</option>@endif
                    @foreach ($Professions as $list_prof)
                    <option value="{{$list_prof->id}}">{{$list_prof->lib}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label for="datenaissance"><b>Date de naissance:</b></label>
                <input class="form-control" name="datenaissance" id="datenaissance" type="date" value="{{old('datenaissance', $dossier->user->datenaissance ?? null)}}" disabled>
            </div>
            <div class="col-6">
                <label for="lieunaissance"><b>Lieu de naissance:</b></label>
                <input class="form-control" name="lieunaissance" id="lieunaissance" type="text" value="{{old('lieunaissance', $dossier->user->lieunaissance ?? null)}}">
            </div>
            <div class="col-6">
                <label for="tel"><b>Tel:</b></label>
                <input class="form-control" name="tel" id="tel" type="text" value="{{old('tel', $dossier->user->tel ?? null)}}">
            </div>
            <div class="col-6">
                <label for="email"><b>E-mail:</b></label>
                <input class="form-control" name="email" id="email" type="email" value="{{old('email', $dossier->user->email ?? null)}}">
            </div>
            <div class="col-12">
                <label for="image"><b>Image:</b></label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <label for="contactdurgence"><b>Contact d'urgence:</b></label>
                <input class="form-control" name="contactdurgence" id="contactdurgence" type="text" value="{{old('contactdurgence', $dossier->contactdurgence ?? null)}}">
            </div>
            <div class="col-4">
                <label for="pays"><b>pays:</b></label>
                <select id="pays" name="pays" class="form-control">
                    <option value="{{$dossier->user->country_id}}"> {{$dossier->user->Country->lib}}</option>
                    @foreach($Countries as $key=>$country)
                    <option value="{{$country->code}}">{{$country->lib}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="title"><b>ville:</b></label>
                    <select name="ville" id="ville" class="form-control">
                        <option value="{{$dossier->user->ville_id}}"> {{$dossier->user->Ville->name}}</option>
                    </select>
                </div>
            </div>
            <div class="col-4">
                <label for="cp"><b>Zip:</b></label>
                <input type="text" class="form-control" id="cp" name="cp" value="{{old('cp',$dossier->user->cp ?? null)}}">
            </div>
            <div class="col-4">
                <label for="groupe_sanguin"><b>Groupe Sanguin:</b></label>
                <select class="form-control" name="groupe_sanguin" id="groupe_sanguin">
                    @if($dossier->groupe_sanguin)<option value="{{$dossier->bloodtype->id}}"> {{$dossier->bloodtype->lib}}</option>@endif
                    @foreach ($Bloodtypes as $liste_gsang)
                    <option value="{{$liste_gsang->id}}"> {{$liste_gsang->lib}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <label for="taille"><b>Taille:</b></label>
                <input class="form-control" name="taille" id="taille" type="text" placeholder="170cm" value="{{old('taille', $dossier->taille ?? null)}}">
            </div>
            <div class="col-4">
                <label for="poids"><b>Poids:</b></label>
                <input class="form-control" name="poids" id="poids" type="text" placeholder="70kg" value="{{old('poids', $dossier->poids  ?? null)}}">
            </div>
            @if(!is_null($dossier->antecedants_med))
            <div class="col-12">
                <label for="antecedants_med"> <i data-feather="star"></i><b>Antécédants medicaux:</b></label>
                {!!$dossier->antecedants_med!!}
            </div>
            @endif
            @if(!is_null($dossier->antecedants_chirg))
            <div class="col-12">
                <label for="antecedants_chirg"><i data-feather="star"></i><b>Antécédants chirurgicaux: </b></label>
                {!!$dossier->antecedants_chirg!!}
            </div>
            @endif
            @if(!is_null($dossier->antecedants_fam))
            <div class="col-12">
                <label for="antecedants_fam"><i data-feather="star"></i><b>Antécédants familials:</b></label>
                {!!$dossier->antecedants_fam!!}
            </div>
            @endif
            @if(!is_null($dossier->allergies))
            <div class="col-12">
                <label for="allergies"><i data-feather="star"></i><b>Allergies: </b></label>
                {!!$dossier->allergies!!}
            </div>
            @endif
            @if(!is_null($dossier->indicateur_bio))
            <div class="col-12">
                <label for="indicateur_bio"><i data-feather="star"></i><b>Indicateurs biologiques:</b></label>
                {!!$dossier->indicateur_bio!!}
            </div>
            @endif
            @if(!is_null($dossier->traitement_chr))
            <div class="col-12">
                <label for="traitement_chr"><i data-feather="star"></i><b>Traitements chroniques:</b></label>
                {!!$dossier->traitement_chr!!}
            </div>
            @endif
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save"></i>Enregistrer les modifications</button>
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