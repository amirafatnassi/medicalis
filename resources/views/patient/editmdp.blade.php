@extends('layouat.layoutPatientNoHeader')
@section('contenu')

<div class="card">
    <div class="card-body row">
        <div class="col-3">
            <img src="{{asset('uploads/users/'.($patient->image ?? 'user.png'))}}" class="rounded img-fluid" alt="Card image" />
            <div class="row">
                <div class="col-6">
                    <a class="btn btn-block btn-primary" href="{{ url('patient/profile')}}"> <i data-feather="eye"></i></a>
                </div>
                <div class="col-6">
                    <a href="{{ url('patient/editMonProfil')}}" class="btn btn-block btn-primary">
                        <i data-feather="edit-3"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-9">
            <form  method="post"  action="{{url('patient/editmdp/'.$patient->id)}}">@csrf
                <div class="row">
                    <div class="col-12 col-sm-6">
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
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
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
                <div class="col-12 col-sm-6">
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
                <div class="col-12">
                    <button type="submit" class="btn btn-primary mr-1 mt-1">Save</button>
                    <a href="{{url('medecin/profile')}}" class="btn btn-outline-secondary mt-1">Cancel</a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection