@extends('layouat.layoutCoordinateur')
@section('contenu')
<div class="content-wrapper">
    <div class="content-body">
        <section id="page-account-settings">
            <div class="row">
                <!-- left menu section -->
                <div class="col-md-3 mb-2 mb-md-0">
                    <ul class="nav nav-pills flex-column nav-left">
                        <!-- personal -->
                        <li class="nav-item">
                            <a class="nav-link active" id="account-pill-personal" data-toggle="pill" href="#account-vertical-personal" aria-expanded="true">
                                <i data-feather="user" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">Informations personnelles</span>
                            </a>
                        </li>
                        <!-- adress -->
                        <li class="nav-item">
                            <a class="nav-link" id="account-pill-adress" data-toggle="pill" href="#account-vertical-adress" aria-expanded="true">
                                <i data-feather="map-pin" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">Adresse</span>
                            </a>
                        </li>
                        <!-- general -->
                        <li class="nav-item">
                            <a class="nav-link" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="false">
                                <i data-feather="lock" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">Informations générales</span>
                            </a>
                        </li>
                        <!-- medical -->
                        <li class="nav-item">
                            <a class="nav-link" id="account-pill-medical" data-toggle="pill" href="#account-vertical-medical" aria-expanded="false">
                                <i data-feather="info" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">Informations médicales</span>
                            </a>
                        </li>
                        <!-- files -->
                        <li class="nav-item">
                            <a class="nav-link" id="account-pill-files" data-toggle="pill" href="#account-vertical-files" aria-expanded="false">
                                <i data-feather="paperclip" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">Pièces jointes</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!--/ left menu section -->

                <!-- right content section -->
                <div class="card col-md-9">
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- personal -->
                            <div role="tabpanel" class="tab-pane active" id="account-vertical-personal" aria-labelledby="account-pill-personal" aria-expanded="true">
                                <form class="validate-form mt-2" method="post" action="{{url('coordinateur/dossiers/update_personal/'.$dossier->id)}}" enctype="multipart/form-data"> @csrf
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="media col-4">
                                                <a href="javascript:void(0);" class="mr-25">
                                                    <img src=" {{asset('uploads/users/'.($dossier->user->image??'user.png'))}}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80">
                                                </a>
                                            </div>
                                            <div class="card-title col-8">Informations personnelles</div>
                                        </div>
                                    </div>
                                    <div class="card_body row">
                                        <div class="col-4">
                                            <label for="nom"><b>Nom:</b></label>
                                            <input class="form-control" name="nom" id="nom" type="text" value="{{old('nom',$dossier->user->nom ?? null)}}">
                                        </div>
                                        <div class="col-4">
                                            <label for="prenom"><b>Prénom:</b></label>
                                            <input class="form-control" name="prenom" id="prenom" type="text" value="{{old('prenom',$dossier->user->prenom ?? null)}}">
                                        </div>
                                        <div class="col-4">
                                            <label for="sexe"><b>Sexe:</b></label>
                                            <select class="form-control" name="sexe" id="sexe" disabled>
                                                <option value="{{$dossier->user->sexe_id}}">{{$dossier->user->sexe->lib}}</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="profession"><b>Profession:</b></label>
                                            <select class="form-control" name="profession" id="profession">
                                                @if($dossier->user->profession_id)
                                                <option value="{{$dossier->user->profession->id}}">{{$dossier->user->profession->lib}}</option>
                                                @endif
                                                <option value="">--Select--</option>
                                                @foreach ($Professions as $prof)
                                                <option value="{{$prof->id}}">{{$prof->lib}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="datenaissance"><b>Date de naissance:</b></label>
                                            <input class="form-control" name="datenaissance" id="datenaissance" type="date" disabled value="{{old('datenaissance',$dossier->user->datenaissance ?? null)}}">
                                        </div>
                                        <div class="col-6">
                                            <label for="lieunaissance"><b>Lieu de naissance:</b></label>
                                            <input class="form-control" name="lieunaissance" id="lieunaissance" type="text" value="{{old('lieunaissance',$dossier->user->lieunaissance ?? null)}}">
                                        </div>
                                        <div class="col-6">
                                            <label for="tel"><b>Tel:</b></label>
                                            <input class="form-control" name="tel" id="tel" type="text" value="{{old('tel',$dossier->user->tel ?? null)}}">
                                        </div>
                                        <div class="col-6">
                                            <label for="email"><b>E-mail:</b></label>
                                            <input class="form-control" name="email" id="email" type="email" value="{{old('email',$dossier->user->email ?? null)}}">
                                        </div>
                                        <div class="col-12">
                                            <label for="image">Avatar:</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="image" class="custom-file-input">
                                                    <label class="custom-file-label" id="filename1">{{old('image',$dossier->user->image ?? null)}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="contactdurgence"><b>Contact d'urgence:</b></label>
                                            <input class="form-control" name="contactdurgence" id="contactdurgence" type="text" value="{{old('contactdurgence',$dossier->contactdurgence ?? null)}}">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
                                    </div>
                                </form>
                            </div>
                            <!--/ personal -->

                            <!-- adress -->
                            <div role="tabpanel" class="tab-pane" id="account-vertical-adress" aria-labelledby="account-pill-adress" aria-expanded="true">
                                <form class="validate-form mt-2" method="post" action="{{url('coordinateur/dossiers/update_adress/'.$dossier->id)}}" enctype="multipart/form-data"> @csrf
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="media col-4">
                                                <a href="javascript:void(0);" class="mr-25">
                                                    <img src=" {{asset('uploads/users/'.($dossier->user->image??'user.png'))}}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80">
                                                </a>
                                            </div>
                                            <div class="card-title col-8">Informations médicales</div>
                                        </div>
                                    </div>
                                    <div class="card-body row">
                                        <div class="col-4">
                                            <label for="pays"><b>pays:</b></label>
                                            <select id="pays" name="pays" class="form-control">
                                                <option value="{{$dossier->user->country->code}}">{{$dossier->user->country->lib}}</option>
                                                @foreach($Countries as $key=>$country)
                                                <option value="{{$country->code}}">{{$country->lib}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="title"><b>ville:</b></label>
                                                <select name="state" id="state" class="form-control">
                                                    <option value="{{$dossier->user->ville->id_ville}}">{{$dossier->user->ville->name}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="cp"><b>CP:</b></label>
                                            <input type="text" class="form-control" id="cp" name="cp" value="{{old('cp',$dossier->user->cp ?? null)}}">
                                        </div>
                                        <div class="col-12">
                                            <label for="cp"><b>Rue:</b></label>
                                            <input type="text" class="form-control" id="rue" name="rue" value="{{old('rue',$dossier->user->rue ?? null)}}">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
                                    </div>
                                </form>
                            </div>
                            <!--/ adress -->

                            <!-- general -->
                            <div class="tab-pane fade" id="account-vertical-general" role="tabpanel" aria-labelledby="account-pill-general" aria-expanded="false">
                                <form class="validate-form mt-2" method="post" action="{{url('coordinateur/dossiers/update_general/'.$dossier->id)}}" enctype="multipart/form-data"> @csrf
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="media col-4">
                                                <a href="javascript:void(0);" class="mr-25">
                                                    <img src=" {{asset('uploads/users/'.($dossier->user->image??'user.png'))}}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80">
                                                </a>
                                            </div>
                                            <div class="card-title col-8">Informations générale</div>
                                        </div>
                                    </div>
                                    <div class="card-body row">
                                        <div class="col-6">
                                            <label for="convention"><b>convention:</b></label>
                                            <select class="form-control" name="convention" id="convention">
                                                @if($dossier->convention_id)<option value="{{$dossier->convention->id}}">{{$dossier->convention->lib}}</option>@endif
                                                <option value="">--select--</option>
                                                @foreach ($Conventions as $convention)
                                                <option value="{{$convention->id}}">{{$convention->lib}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="groupe_sanguin"><b>Groupe Sanguin:</b></label>
                                            <select class="form-control" name="groupe_sanguin" id="groupe_sanguin">
                                                @if($dossier->groupe_sanguin)<option value="{{$dossier->bloodtype->id}}">{{$dossier->bloodtype->lib}}</option>@endif
                                                <option value="">--select--</option>
                                                @foreach ($Bloodtypes as $bloodtype)
                                                <option value="{{$bloodtype->id}}"> {{$bloodtype->lib}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="taille"><b>Taille:</b></label>
                                            <input class="form-control" name="taille" id="taille" type="text" value="{{old('taille',$dossier->taille ?? null)}}">
                                        </div>
                                        <div class="col-6">
                                            <label for="poids"><b>Poids:</b></label>
                                            <input class="form-control" name="poids" id="poids" type="text" value="{{old('poids',$dossier->poids ?? null)}}">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
                                    </div>
                                </form>
                            </div>
                            <!--/ general -->

                            <!-- medical -->
                            <div class="tab-pane fade" id="account-vertical-medical" role="tabpanel" aria-labelledby="account-pill-medical" aria-expanded="false">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="media col-4">
                                            <a href="javascript:void(0);" class="mr-25">
                                                <img src=" {{asset('uploads/users/'.($dossier->user->image??'user.png'))}}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80">
                                            </a>
                                        </div>
                                        <div class="card-title col-8">Informations médicales</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Antécédants medicaux:</div>
                                    </div>
                                    <div class="card-body">{!!$dossier->antecedants_chirg!!}</div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Antécédants chirurgicaux:</div>
                                    </div>
                                    <div class="card-body">{!!$dossier->antecedants_chirg!!}</div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Antécédants familials:</div>
                                    </div>
                                    <div class="card-body">{!!$dossier->antecedants_fam!!}</div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Allergies: </div>
                                    </div>
                                    <div class="card-body">{!!$dossier->allergies!!}</div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Indicateurs biologiques:</div>
                                    </div>
                                    <div class="card-body">{!!$dossier->indicateur_bio!!}</div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Traitements chroniques:</div>
                                    </div>
                                    <div class="card-body">{!!$dossier->traitement_chr!!}</div>
                                </div>
                            </div>
                            <!--/ medical-->

                            <!-- files -->
                            <div class="tab-pane fade" id="account-vertical-files" role="tabpanel" aria-labelledby="account-pill-files" aria-expanded="false">
                                <form class="validate-form mt-2" method="post" action="{{url('coordinateur/dossiers/update_files/'.$dossier->id)}}" enctype="multipart/form-data"> @csrf
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="media col-4">
                                                <a href="javascript:void(0);" class="mr-25">
                                                    <img src=" {{asset('uploads/users/'.($dossier->user->image??'user.png'))}}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80">
                                                </a>
                                            </div>
                                            <div class="card-title col-8">Pièces jointes</div>
                                        </div>
                                    </div>
                                    <div class="card-body row">
                                        <div class="col-12">
                                            <label for="file"><b>Pièce jointe (complément d'informations):</b></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                                                    <label class="custom-file-label" id="filename">Choisir fichier</label>
                                                </div>
                                            </div>
                                        </div>
                                        @if($dossier->files->count()>0)
                                        <div class="card-header">
                                            <div class="card-title">Compléments d'informations</div>
                                        </div>
                                        <div class="card-body row">
                                            @foreach($dossier->files as $f)
                                            <div class="d-flex justify-content-start align-items-center mt-2 col-12">
                                                <div class="mr-75">
                                                    <a href="{{url('uploads/dossierFiles/'.$f->downloads)}}">{{$f->downloads}}</a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('coordinateur.dossier.deleteFile', $f->id) }}" method="POST" style="display:inline;"> {{ csrf_field() }} {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier: {{ $f->downloads }} ?')"><i data-feather="trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
                                    </div>
                                </form>
                            </div>
                            <!--/ files -->
                        </div>
                    </div>
                </div>
                <!--/ right content section -->
            </div>
        </section>
    </div>
</div>

</body>
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
                        $("#state").empty();
                        $("#state").append('<option>Select</option>');
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
</script>

<script>
    $.each(this.files, function(key, value) {
        alert(key + ": " + value);
    });
    $("#image").change(function() {
        var chaine = "";
        $.each(this.files, function(key, value) {
            chaine = chaine + value.name + ',';
        });
        $("#filename1").text(chaine);
    });
</script>

<script>
    $.each(this.files, function(key, value) {
        alert(key + ": " + value);
    });
    $("#fileup").change(function() {
        var chaine = "";
        $.each(this.files, function(key, value) {
            chaine = chaine + value.name + ',';
        });
        $("#filename").text(chaine);
    });
</script>
@endsection