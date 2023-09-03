@extends('layouat.layoutCoordinateur')
@section('contenu')

<div class="content-body row">
    <div class="col-md-3 mb-2 mb-md-0">
        <ul class="nav nav-pills flex-column nav-left">
            <!-- general -->
            <li class="nav-item">
                <a class="nav-link active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                    <i data-feather="user" class="font-medium-3 mr-1"></i>
                    <span class="font-weight-bold">Informations générales</span>
                </a>
            </li>
            <!-- change password -->
            <li class="nav-item">
                <a class="nav-link" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                    <i data-feather="lock" class="font-medium-3 mr-1"></i>
                    <span class="font-weight-bold">Changer mot de passe</span>
                </a>
            </li>
            <!-- information -->
            <li class="nav-item">
                <a class="nav-link" id="account-pill-info" data-toggle="pill" href="#account-vertical-info" aria-expanded="false">
                    <i data-feather="info" class="font-medium-3 mr-1"></i>
                    <span class="font-weight-bold">Plus d'Informations</span>
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
                    <!-- general tab -->
                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                        <!-- header media -->
                        <div class="media">
                            @if($user->image!==null)
                            <a href="javascript:void(0);" class="mr-25">
                                <img src=" {{asset('uploads/users/'.$user->image)}}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80">
                            </a>
                            @else
                            <a href="javascript:void(0);" class="mr-25">
                                <img src="{{asset('uploads/users/user.png')}}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80">
                            </a>
                            @endif
                        </div>
                        <!--/ header media -->

                        <!-- form -->
                        <form class="validate-form mt-2" method="POST" action="{{url('coordinateur/update_general')}}" enctype="multipart/form-data"> {{csrf_field()}}
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="prenom">Prénom</label>
                                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" value="{{old('prenom',$user->prenom ?? null)}}" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="nom">Name</label>
                                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" value="{{old('nom',$user->nom ?? null)}}" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="e-mail">E-mail</label>
                                        <input type="email" class="form-control" id="e-mail" name="email" placeholder="Email" value="{{old('email', $user->email ?? null)}}" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="account-company">Tel</label>
                                        <input type="phone" class="form-control" id="tel" name="tel" placeholder="Tel" value="{{old('tel', $user->tel ?? null)}}" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="image">Avatar:</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input">
                                            <label class="custom-file-label" id="filename1">{{old('image',$user->image ?? null)}}</label>
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
                                    <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                                    <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--/ general tab -->

                    <!-- change password -->
                    <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                        <form class="validate-form" method="post" action="{{url('coordinateur/updatemdp')}}"> @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="account-old-password">Old Password</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input type="password" class="form-control" id="account-old-password" name="ampd" placeholder="Old Password" />
                                            <div class="input-group-append">
                                                <div class="input-group-text cursor-pointer">
                                                    <i data-feather="eye"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="account-new-password">New Password</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input type="password" id="account-new-password" name="nmpd" class="form-control" placeholder="New Password" />
                                            <div class="input-group-append">
                                                <div class="input-group-text cursor-pointer">
                                                    <i data-feather="eye"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="account-retype-new-password">Retype New Password</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input type="password" class="form-control" id="account-retype-new-password" name="cmpd" placeholder="New Password" />
                                            <div class="input-group-append">
                                                <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1 mt-1">Save changes</button>
                                    <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--/ change password -->

                    <!-- information -->
                    <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                        <form class="validate-form" method="POST" action="{{url('coordinateur/update_information')}}" enctype="multipart/form-data"> {{csrf_field()}}
                            <div class="row">
                                <div class="col-6">
                                    <label for="motif"><b>Sexe:</b></label>
                                    <select class="form-control" name="sexe_id" id="sexe_id">
                                        <option value="{{$user->sexe->id}}">{{$user->sexe->lib}}</option>
                                        @foreach($Sexes as $sexe)
                                        <option value="{{$sexe->id}}">{{$sexe->lib}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="motif"><b>Role:</b></label>
                                    <select class="form-control" name="role_id" id="role_id" readonly>
                                        <option value="{{$user->role->id}}">{{$user->role->lib }}</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="pays"><b>pays:</b></label>
                                    <select id="pays" name="pays" class="form-control" required>
                                        <option value="{{$user->country->code}}">{{$user->country->lib}}</option>
                                        <option value="">--Sélectionnez votre pays--</option>
                                        @foreach($Countries as $country)
                                        <option value="{{$country->code}}">{{$country->lib}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="title"><b>Ville:</b></label>
                                        <select name="state" id="state" class="form-control" required>
                                            @if($user->ville_id)
                                            <option value="{{$user->ville->id_ville}}">{{$user->ville->name}}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="cp"><b>Code postal:</b></label>
                                    <input type="number" class="form-control" id="cp" name="cp" value="{{old('cp', $user->cp ?? null)}}">
                                </div>
                                <div class="col-12">
                                    <label for="rue"><b>Rue:</b></label>
                                    <input type="text" class="form-control" id="rue" name="rue" value="{{old('rue', $user->rue ?? null)}}">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mt-1 mr-1"> <i data-feather="save"></i> Enregistrer modifications</button>
                                    <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>

                                </div>
                            </div>
                        </form>

                        <!--/ form -->
                    </div>
                    <!--/ information -->
                </div>
            </div>
        </div>
    </div>
    <!--/ right content section -->
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
                        $("#state").empty();
                        $("#state").append('<option value="">Selectionnez votre ville</option>');
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
@endsection