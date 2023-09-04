@extends('layouat.layaoutPatient')
@section('contenu')
<div class="card">
  <div class="card-header">
    <div class="card-title">Consultation n° {{$consultation->id}}</div>
  </div>
  <div class="card-body row">
    <div class="col-12">
      <b>Médecin: </b>
      @if ($consultation->medecin && $consultation->medecin->role_id==3)
      {{ $consultation->medecin->prenom }} {{ $consultation->medecin->nom }}
      @endif

      @if ($consultation->medecin && $consultation->medecin->specialite_id)
      <b>Spécialité: </b>: {{$consultation->medecin->Specialite->lib}}
      @endif

      @if($consultation->remarques)
      <a href="#" class="badge badge-danger">{{$consultation->remarques}}</a>
      @endif
    </div>
    <div class="col-12"><b>Motif: </b>{{$consultation->Motif->lib}}</div>
    <div class="col-12">
      <div class="card-group">
        @if($consultation->taille)
        <div class="card col-4">
          <div class="card-body">
            <p class="card-title"><b>Taille</b></p>
            <a href="#" class="btn btn-primary">{{$consultation->taille}}</a>
          </div>
        </div>
        @endif
        @if($consultation->poids)
        <div class="card col-4">
          <div class="card-body">
            <p class="card-title"><b>Poids</b></p>
            <a href="#" class="btn btn-primary">{{$consultation->poids}}</a>
          </div>
        </div>
        @endif
        @if($consultation->ta)
        <div class="card col-4">
          <div class="card-body">
            <p class="card-title"><b>TA</b></p>
            <a href="#" class="btn btn-primary">{{$consultation->ta}}</a>
          </div>
        </div>
        @endif
      </div>
    </div>
    <div class="col-12"><b>Date: </b>{{date('d/m/Y',strtotime($consultation->date))}} </h5>
    </div>
    <div class="col-12"><b> Observation: </b>{!!$consultation->observation!!} </h5>
    </div>
    @if($consultation->id_medecin==Auth::user()->id)
    <div class="col-12">
      <b>Observation privée: <small><b>( affiché pour vous uniquement )</b></small> </b>{!!$consultation->observation_prive!!} </h5>
    </div>
    @endif
    @if($consultation->effet_marquant_txt)
    <div class="col-12">
      <b>Antécédant: </b><small><b>( tout ce qui est affiché en antécédent sera répertorié dans l'historique du patient ) </b></small>{!!$consultation->effet_marquant_txt!!}
    </div>
    @endif
    <div class="col-12">
      @if($consultation->files->count()>0)
      <div class="card-header">
        <div class="card-title">Liste de téléchargements</div>
      </div>
      <div class="card-body row">
        @foreach($consultation->files as $f)
        <div class="col-12">
          <a href="{{ asset('uploads/consultation/'.$f->downloads) }}">
            <i data-feather="paperclip"></i> {{$f->downloads}}
          </a>
        </div>
        @endforeach
      </div>
    </div>
    @endif
    <div class="col-12">
      <b>Crée le: </b>{{date('d/m/Y',strtotime($consultation->created_at))}} / <b>Mis à jour le: </b>{{date('d/m/Y',strtotime($consultation->updated_at))}} </h5>
    </div>
  </div>
  @if($consultation->remarques == "saisie par le patient !")
  <div class="card-footer">
    <a href="{{ url('patient/consultations/edit/'.$consultation->id) }}" class="btn btn-block btn-primary">
      <i data-feather="edit"></i> Modifier consultation
    </a>
  </div>
  @endif
</div>
@endsection