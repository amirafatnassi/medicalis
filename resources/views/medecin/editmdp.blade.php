@extends('layouat.layaoutMedecin')
@section('contenu')
<div class="content-body">
    <div id="user-profile">
        <section id="profile-info">
            <div class="row">
                <div class="col-3">
                    <div class="position-relative">
                        <div class="profile-img-container d-flex align-items-center">
                            <div class="profile-img">
                                <img src="{{asset('uploads/medecin/'.$medecin->image)}}" class="rounded img-fluid" alt="Card image" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-block btn-primary" href="{{ url('medecin/profile')}}"> <i data-feather="eye"></i></a>
                            </div>
                            <div class="col-6">
                                <a href="{{ url('medecin/editMonProfil')}}" class="btn btn-block btn-primary"><i data-feather="edit-3"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <form  method="post"  action="{{url('medecin/editmdp/'.$medecin->id)}}"> @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Modifier mot de passe</div>
                            </div>
                            <div class="card-body row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="account-old-password"> Mot de Passe Actuel</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input type="password" class="form-control" id="ampd" name="ampd" placeholder="Mot de Passe Actuel" />
                                                <div class="input-group-append">
                                                    <div class="input-group-text cursor-pointer">
                                                        <i data-feather="eye"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-12">
                                        <div class="form-group">
                                            <label for="account-new-password">Nouveau Mot de Passe</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" id="nmpd" name="nmpd" class="form-control" placeholder="Nouveau Mot de Passe" />
                                                <div class="input-group-append">
                                                    <div class="input-group-text cursor-pointer">
                                                        <i data-feather="eye"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-12">
                                        <div class="form-group">
                                            <label for="account-retype-new-password">Retape le Nouveau Mot de Passe</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" class="form-control" id="cmpd" name="cmpd" placeholder="Nouveau Mot de Passe" />
                                                <div class="input-group-append">
                                                    <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-1 mt-1"><i data-feather="save"></i> Enregistrer</button>
                                <a href="{{url('patient/profile')}}" class="btn btn-outline-secondary mt-1"><i data-feather="x"></i> Annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection