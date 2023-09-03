@extends('menus.layoutRepresentant')
@section('contenu')
<div class="content-wrapper">
    <div class="content-body">
        <!-- account setting page -->
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
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- personal -->
                                <div role="tabpanel" class="tab-pane active" id="account-vertical-personal" aria-labelledby="account-pill-personal" aria-expanded="true">
                                    <!-- header media -->
                                    <div class="media">
                                        @if($dossier->image!==null)
                                        <a href="javascript:void(0);" class="mr-25">
                                            <img src=" {{asset('uploads/dossier/'.$dossier->image)}}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80">
                                        </a>
                                        @else
                                        <a href="javascript:void(0);" class="mr-25">
                                            <img src="{{asset('uploads/users/user.png')}}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80">
                                        </a>
                                        @endif
                                    </div>
                                    <!--/ header media -->

                                    <!-- form -->
                                    <form class="validate-form mt-2" method="post" action="{{url('representant/dossiers/update_personal/'.$dossier->id)}}" enctype="multipart/form-data"> @csrf
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="nom"><b>Nom:</b></label>
                                                <input class="form-control" name="nom" id="nom" type="text" value="{{old('nom',$dossier->nom ?? null)}}">
                                            </div>
                                            <div class="col-4">
                                                <label for="prenom"><b>Prénom:</b></label>
                                                <input class="form-control" name="prenom" id="prenom" type="text" value="{{old('prenom',$dossier->prenom ?? null)}}">
                                            </div>
                                            <div class="col-4">
                                                <label for="sexe"><b>Sexe:</b></label>
                                                <select class="form-control" name="sexe" id="" disabled>
                                                    <option value="{{$dossier->sexe_id}}">{{$dossier->sexe_lib}}</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="profession"><b>Profession:</b></label>
                                                <select class="form-control" name="profession" id="profession">
                                                    <option value="{{$dossier->profession}}">{{$dossier->profession_lib}}</option>
                                                    @foreach ($Professions as $prof)
                                                    <option value="{{$prof->id}}">{{$prof->lib}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="datenaissance"><b>Date de naissance:</b></label>
                                                <input class="form-control" name="datenaissance" id="datenaissance" type="date" disabled value="{{old('datenaissance',$dossier->datenaissance ?? null)}}">
                                            </div>
                                            <div class="col-6">
                                                <label for="lieunaissance"><b>Lieu de naissance:</b></label>
                                                <input class="form-control" name="lieunaissance" id="lieunaissance" type="text" value="{{old('lieunaissance',$dossier->lieunaissance ?? null)}}">
                                            </div>
                                            <div class="col-6">
                                                <label for="tel"><b>Tel:</b></label>
                                                <input class="form-control" name="tel" id="tel" type="text" value="{{old('tel',$dossier->tel ?? null)}}">
                                            </div>
                                            <div class="col-6">
                                                <label for="email"><b>E-mail:</b></label>
                                                <input class="form-control" name="email" id="email" type="email" value="{{old('email',$dossier->email ?? null)}}">
                                            </div>
                                            <div class="col-12">
                                                <label for="image">Avatar:</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="image" class="custom-file-input">
                                                        <label class="custom-file-label" id="filename1">{{old('image',$dossier->image ?? null)}}</label>
                                                    </div>
                                                </div>
                                            </div>
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
                                            <div class="col-12">
                                                <label for="contactdurgence"><b>Contact d'urgence:</b></label>
                                                <input class="form-control" name="contactdurgence" id="contactdurgence" type="text" value="{{old('contactdurgence',$dossier->contactdurgence ?? null)}}">
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--/ form -->
                                </div>
                                <!--/ personal -->

                                <!-- adress -->
                                <div role="tabpanel" class="tab-pane" id="account-vertical-adress" aria-labelledby="account-pill-adress" aria-expanded="true">
                                    <!-- form -->
                                    <form class="validate-form mt-2" method="post" action="{{url('representant/dossiers/update_adress/'.$dossier->id)}}" enctype="multipart/form-data"> @csrf
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="pays"><b>pays:</b></label>
                                                <select id="pays" name="pays" class="form-control">
                                                    <option value="{{$dossier->pays}}">{{$dossier->pays_lib}}</option>
                                                    @foreach($Countries as $key=>$country)
                                                    <option value="{{$country->code}}">{{$country->lib}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="title"><b>ville:</b></label>
                                                    <select name="state" id="state" class="form-control">
                                                        <option value="{{$dossier->ville}}">{{$dossier->ville_lib}}</option>
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
                                            <div class=" d-grid gap-2 col-6 mx-auto">
                                                <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--/ form -->
                                </div>
                                <!--/ adress -->


                                <!-- general -->
                                <div class="tab-pane fade" id="account-vertical-general" role="tabpanel" aria-labelledby="account-pill-general" aria-expanded="false">
                                    <!-- form -->
                                    <form class="validate-form mt-2" method="post" action="{{url('representant/dossiers/update_general/'.$dossier->id)}}" enctype="multipart/form-data"> @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="convention"><b>convention:</b></label>
                                                <select class="form-control" name="convention" id="convention">
                                                    <option value="{{$dossier->convention}}">{{$dossier->convention_lib}}</option>
                                                    @foreach ($Conventions as $convention)
                                                    <option value="{{$convention->id}}">{{$convention->lib}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="groupe_sanguin"><b>Groupe Sanguin:</b></label>
                                                <select class="form-control" name="groupe_sanguin" id="groupe_sanguin">
                                                    <option value="{{$dossier->groupe_sanguin}}">{{$dossier->groupe_sanguin_lib}}</option>
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
                                            <div class="col-12">
                                                <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--/ form -->
                                </div>
                                <!--/ general -->

                                <!-- medical -->
                                <div class="tab-pane fade" id="account-vertical-medical" role="tabpanel" aria-labelledby="account-pill-medical" aria-expanded="false">
                                    <!-- form -->
                                    <form class="validate-form mt-2" method="post" action="{{url('representant/dossiers/update_medical/'.$dossier->id)}}" enctype="multipart/form-data"> @csrf
                                        <div class="row">
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
                                            <div class=" d-grid gap-2 col-6 mx-auto">
                                                <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--/ form -->
                                </div>
                                <!--/ medical-->

                                <!-- files -->
                                <div class="tab-pane fade" id="account-vertical-files" role="tabpanel" aria-labelledby="account-pill-files" aria-expanded="false">
                                    <!-- form -->
                                    <form class="validate-form mt-2" method="post" action="{{url('representant/dossiers/update_files/'.$dossier->id)}}" enctype="multipart/form-data"> @csrf
                                        <div class="col-12">
                                            <label for="file"><b>Pièce jointe (complément d'informations):</b></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                                                    <label class="custom-file-label" id="filename">Choisir fichier</label>
                                                </div>
                                            </div>
                                        </div>

                                        @if(!empty($files))
                                        <h1><b><u>Compléments d'informations</u></b></h1>
                                        @foreach($files as $f)
                                        <div class="d-flex justify-content-start align-items-center mt-2">
                                            <div class="mr-75">
                                                <a href="{{url('/uploads/dossierFiles/'.$f->downloads)}}">{{$f->downloads}}</a>
                                            </div>
                                            <div>
                                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$f->id}})" data-target="#DeleteModal" class="nav-link" style="color: red">
                                                    <i data-feather="trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                        <div class="row">
                                            <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
                                        </div>
                                    </form>
                                    <!--/ form -->
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
                                <!--/ files -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ right content section -->
            </div>
        </section>
        <!-- / account setting page -->

    </div>
</div>

<div id="DeleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="" id="deleteForm" method="post">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Confirmation de suppression</h4>
                </div>
                <div class="modal-body">{{csrf_field()}} {{method_field('DELETE')}}
                    <p class="text-center">Vous avez demandez de supprimer un fichier parmi vos téléchargement,<br>voulez-vous confirmez ?</p>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Oui, supprimer!</button>
                    </center>
                </div>
            </div>
        </form>
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
    CKEDITOR.replace('antecedants_med');
    CKEDITOR.replace('antecedants_chirg');
    CKEDITOR.replace('antecedants_fam');
    CKEDITOR.replace('allergies');
    CKEDITOR.replace('indicateur_bio');
    CKEDITOR.replace('traitement_chr');
</script>
<script>
    $(document).ready(function() {
        $('#myTable').dataTable();
    });

    function deleteData(id) {
        var id = id;
        var url = '{{route("representant.dossier.deleteFile",":id")}}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit() {
        $("#deleteForm").submit();
    }
</script>
</section>
</div>
</div>
</div>
@endsection