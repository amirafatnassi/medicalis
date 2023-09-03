@extends('layouat.layaoutPatient')
@section('contenu')
<div class="row">
    <div class="col-3">
        <div class="position-relative">
            <div class="profile-img-container d-flex align-items-center">
                <div class="profile-img">
                    <img src="{{asset('uploads/users/'.($coordinateur->image??'user.png'))}}" class="rounded img-fluid" alt="Card image" />
                </div>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h5 class="mb-75">ID: {{$coordinateur->id}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-75">Nom et Prénom: {{$coordinateur->prenom}} {{$coordinateur->nom}}</h5>
                    </div>
                    @if($coordinateur->specialite_id)
                    <div class="col-12">
                        <h5 class="mb-75">Spécialité: {{$coordinateur->specialite}}</h5>
                    </div>
                    @endif
                    @if($coordinateur->organisme_id)
                    <div class="col-12">
                        <h5 class="mb-75">Organisme: {{$coordinateur->organisme}}</h5>
                    </div>
                    @endif
                    @if($coordinateur->profession_id)
                    <div class="col-12">
                        <h5 class="mb-75">Profession: {{$coordinateur->profession}}</h5>
                    </div>
                    @endif
                    <div class="col-12">
                        <h5 class="mb-75">E-mail: {{$coordinateur->email}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-75">N°Tel: {{$coordinateur->tel}}</h5>
                    </div>
                    @if($coordinateur->country_id)<div class="col-12">
                        <h5 class="mb-50">Pays: {{$coordinateur->Country->lib}}</h5>
                    </div>
                    @endif
                    <div class="col-12">
                        <h5 class="mb-50">Adresse: {{$coordinateur->rue}} {{$coordinateur->cp}} @if($coordinateur->ville_id){{$coordinateur->Ville->name}}@endif</h5>
                    </div>
                    <div class="col-12">
                        <h5>Crée le: </b>{{$coordinateur->created_at}}</h5>
                    </div>
                    <div class="col-12">
                        <h5>Mis à jour le: </b>{{$coordinateur->updated_at}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection