@extends('layouat.layaoutMedecin')
@section('contenu')

<div class="content-wrapper">
    <div class="row">
        <!-- left menu section -->
        <div class="col-3">
            <ul class="nav nav-pills nav-left row">
                <!-- personal -->
                <li class="nav-item col-12">
                    <a class="nav-link active d-flex align-items-center" id="pill-personal" data-toggle="pill" href="#personal-tab" aria-expanded="true">
                        <i data-feather="user"></i>Informations personnelles
                    </a>
                </li>
                <!-- adress -->
                <li class="nav-item col-12">
                    <a class="nav-link d-flex align-items-center" id="pill-adress" data-toggle="pill" href="#adress-tab" aria-expanded="true">
                        <i data-feather="map-pin"></i>Adresse
                    </a>
                </li>
                <!-- general -->
                <li class="nav-item col-12">
                    <a class="nav-link d-flex align-items-center" id="pill-general" data-toggle="pill" href="#general-tab" aria-expanded="true">
                        <i data-feather="lock"></i>Informations générales
                    </a>
                </li>
                <!-- medical -->
                <li class="nav-item col-12">
                    <a class="nav-link d-flex align-items-center" id="pill-medical" data-toggle="pill" href="#medical-tab" aria-expanded="true">
                        <i data-feather="info"></i>Informations médicales
                    </a>
                </li>
                <!-- files -->
                <li class="nav-item col-12">
                    <a class="nav-link d-flex align-items-center" id="pill-files" data-toggle="pill" href="#files-tab" aria-expanded="true">
                        <i data-feather="paperclip"></i>Pièces jointes
                    </a>
                </li>
            </ul>
        </div>
        <!--/ left menu section -->

        <!-- right content section -->
        <div class="col-9 card">
            <div class="card-body">
                <div class="tab-content">
                    <!-- personal -->
                    <div role="tabpanel" class="tab-pane fade show active" id="personal-tab" aria-labelledby="pill-personal" aria-expanded="true">
                        <form class="validate-form" method="post" action="{{url('medecin/dossiers/update_personal/'.$dossier->id)}}" enctype="multipart/form-data"> @csrf
                            <div class="media">
                                @if($dossier->image!==null)
                                <a href="javascript:void(0);">
                                    <img src=" {{asset('uploads/dossier/'.$dossier->image)}}" class="rounded mr-50" alt="profile image" height="80" width="80">
                                </a>
                                @else
                                <a href="javascript:void(0);">
                                    <img src="{{asset('uploads/users/user.png')}}" class="rounded mr-50" alt="profile image" height="80" width="80">
                                </a>
                                @endif
                            </div>
                            <div class="card-body row">
                                <div class="col-4">
                                    <label for="nom">Nom</label>
                                    <input class="form-control" name="nom" id="nom" type="text" value="{{old('nom',$dossier->nom ?? null)}}">
                                </div>
                                <div class="col-4">
                                    <label for="prenom">Prénom</label>
                                    <input class="form-control" name="prenom" id="prenom" type="text" value="{{old('prenom',$dossier->prenom ?? null)}}">
                                </div>
                                <div class="col-4">
                                    <label for="sexe">Sexe</label>
                                    <select class="form-control" name="sexe" readonly>
                                        <option value="{{$dossier->user->Sexe->id}}">{{$dossier->user->Sexe->lib}}</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="profession">Profession</label>
                                    <select class="form-control" name="profession" id="profession">
                                        @if($dossier->user->profession_id)
                                        <option value="{{$dossier->user->Profession->id}}">{{$dossier->user->Profession->lib}}</option>
                                        @endif
                                        @foreach ($Professions as $prof)
                                        <option value="{{$prof->id}}">{{$prof->lib}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="datenaissance">Date de naissance</label>
                                    <input class="form-control" name="datenaissance" id="datenaissance" type="date" value="{{$dossier->datenaissance}}" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="lieunaissance">Lieu de naissance:</b></label>
                                    <input class="form-control" name="lieunaissance" id="lieunaissance" type="text" value="{{old('lieunaissance',$dossier->lieunaissance ?? null)}}">
                                </div>
                                <div class="col-6">
                                    <label for="tel">Tel</label>
                                    <input class="form-control" name="tel" id="tel" type="text" value="{{old('tel',$dossier->tel ?? null)}}">
                                </div>
                                <div class="col-6">
                                    <label for="email">E-mail</label>
                                    <input class="form-control" name="email" id="email" type="email" value="{{old('email',$dossier->email ?? null)}}">
                                </div>
                                <div class="col-6">
                                    <label for="avatar">Avatar</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="avatar" class="custom-file-input form-control @error('avatar') is-invalid @enderror">
                                            <label class="custom-file-label" id="avatar">{{old('avatar',$dossier->image ?? null)}}</label>
                                            @error('avatar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="contactdurgence">Contact d'urgence</label>
                                    <input class="form-control" name="contactdurgence" id="contactdurgence" type="text" value="{{old('contactdurgence',$dossier->contactdurgence ?? null)}}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-block btn-primary d-flex align-items-center justify-content-center" type="submit"> <i data-feather="save"></i>Enregistrer les modifications</button>
                            </div>
                        </form>
                    </div>
                    <!-- adress -->
                    <div role="tabpanel" class="tab-pane fade" id="adress-tab" aria-labelledby="pill-adress" aria-expanded="true">
                        <form class="validate-form" method="post" action="{{url('medecin/dossiers/update_adress/'.$dossier->id)}}"> @csrf
                            <div class="card-body row">
                                <div class="col-4">
                                    <label for="pays"><b>pays:</b></label>
                                    <select id="pays" name="pays" class="form-control">
                                        <option value="{{$dossier->user->Country->code}}">{{$dossier->user->Country->lib}}</option>
                                        @foreach($Countries as $key=>$country)
                                        <option value="{{$country->code}}">{{$country->lib}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="title"><b>ville:</b></label>
                                        <select name="ville" id="ville" class="form-control">
                                            @if($dossier->user->ville_id)
                                            <option value="{{$dossier->user->Ville->id_ville}}">{{$dossier->user->Ville->name}}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="cp"><b>Zip:</b></label>
                                    <input type="text" class="form-control" id="cp" name="cp" value="{{old('cp',$dossier->cp ?? null)}}">
                                </div>
                                <div class="col-12">
                                    <label for="cp"><b>Rue:</b></label>
                                    <input type="text" class="form-control" id="rue" name="rue" value="{{old('rue',$dossier->rue ?? null)}}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-block btn-primary d-flex align-items-center justify-content-center" type="submit"> <i data-feather="save"></i>Enregistrer les modifications</button>
                            </div>
                        </form>
                    </div>
                    <!-- general -->
                    <div role="tabpanel" class="tab-pane fade" id="general-tab" aria-labelledby="pill-general" aria-expanded="true">
                        <form class="validate-form mt-2" method="post" action="{{url('medecin/dossiers/update_general/'.$dossier->id)}}"> @csrf
                            <div class="card-body row">
                                <div class="col-6">
                                    <label for="groupe_sanguin"><b>Groupe Sanguin:</b></label>
                                    <select class="form-control" name="groupe_sanguin" id="groupe_sanguin">
                                        @if($dossier->groupe_sanguin)
                                        <option value="{{$dossier->bloodtype->id}}">{{$dossier->bloodtype->lib}}</option>
                                        @endif
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
                                <button class="btn btn-block btn-primary d-flex align-items-center justify-content-center" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
                            </div>
                        </form>
                    </div>
                    <!-- medical -->
                    <div role="tabpanel" class="tab-pane fade" id="medical-tab" aria-labelledby="pill-medical" aria-expanded="true">
                        <form class="validate-form mt-2" method="post" action="{{url('medecin/dossiers/update_medical/'.$dossier->id)}}"> @csrf
                            <div class="card-body row">
                                <div class="col-12">
                                    <label for="antecedants_med"><b>Antécédants medicaux:</b></label>
                                    <textarea class="CKEDITOR form-control" name="antecedants_med" id="antecedants_med" type="text">{{old('antecedants_med',$dossier->antecedants_med ?? null)}}</textarea>
                                </div>
                                <div class="col-12">
                                    <label for="antecedants_chirg"><b>Antécédants chirurgicaux: </b></label>
                                    <textarea class="CKEDITOR form-control" name="antecedants_chirg" id="antecedants_chirg" type="text">{{old('antecedants_chirg',$dossier->antecedants_chirg ?? null)}}</textarea>
                                </div>
                                <div class="col-12">
                                    <label for="antecedants_fam"><b>Antécédants familials:</b></label>
                                    <textarea class="CKEDITOR form-control" name="antecedants_fam" id="antecedants_fam" type="text">{{old('antecedants_fam',$dossier->antecedants_fam ?? null)}}</textarea>
                                </div>
                                <div class="col-12">
                                    <label for="allergies"><b>Allergies: </b></label>
                                    <textarea class="CKEDITOR form-control" name="allergies" id="allergies" type="text">{{old('allergies',$dossier->allergies ?? null)}}</textarea>
                                </div>
                                <div class="col-12">
                                    <label for="indicateur_bio"><b>Indicateurs biologiques:</b></label>
                                    <textarea class="CKEDITOR form-control" name="indicateur_bio" id="indicateur_bio" type="text">{{old('indicateur_bio',$dossier->indicateur_bio ?? null)}}</textarea>
                                </div>
                                <div class="col-12">
                                    <label for="traitement_chr"><b>Traitements chroniques:</b></label>
                                    <textarea class="CKEDITOR form-control" name="traitement_chr" id="traitement_chr" type="text">{{old('traitement_chr',$dossier->traitement_chr ?? null)}}</textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-block btn-primary d-flex align-items-center justify-content-center" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
                            </div>
                        </form>
                    </div>
                    <!-- files -->
                    <div role="tabpanel" class="tab-pane fade" id="files-tab" aria-labelledby="pill-files" aria-expanded="true">
                        <form class="validate-form mt-2" method="POST" action="{{ url('medecin/dossiers/update_files/'.$dossier->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body row">
                                <div class="col-12">
                                    <label for="file"><b>Pièce jointe (complément d'informations):</b></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="files[]" class="custom-file-input" multiple id="fileup">
                                            <label class="custom-file-label" id="filename">Choisir fichier</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button class="btn btn-block btn-primary d-flex align-items-center justify-content-center" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
                            </div>
                        </form>
                        @if($dossier->files->count() === 0)
                        <div class="alert alert-info">
                            Ce dossier ne contient pas des compléments d'informations.
                        </div>
                        @else
                        <div class="card-body">
                            <div class="card-title">Compléments d'informations</div>
                            <ul>
                                @foreach($dossier->files as $f)
                                <li class="d-flex align-items-center">
                                    <i data-feather="paperclip"></i>
                                    <a href="{{url('/uploads/dossierFiles/'.$f->downloads)}}">{{$f->downloads}}</a>
                                    <form action="{{ route('medecin.dossier.deleteFile', $f->id) }}" method="POST" style="display:inline;"> {{ csrf_field() }} {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier {{ $f->downloads }} ?')"><i data-feather="trash"></i></button>
                                    </form>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
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
                    </div>
                </div>
            </div>
        </div>
        <!--/ right content section -->
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
<script>
    CKEDITOR.replace('antecedants_med');
    CKEDITOR.replace('antecedants_chirg');
    CKEDITOR.replace('antecedants_fam');
    CKEDITOR.replace('allergies');
    CKEDITOR.replace('indicateur_bio');
    CKEDITOR.replace('traitement_chr');
</script>
<script>
    $(document).ready(function() {
        // Show the first tab and hide the others
        $('.nav-pills a:first').tab('show');
        $('.tab-pane:first').addClass('show active');
        // Listen for click events on the tabs
        $('.nav-pills a').click(function() {
            // Hide all the panels
            $('.tab-pane').removeClass('show active');

            // Show the selected panel
            $($(this).attr('href')).addClass('show active');
        });
    });
</script>
@endsection