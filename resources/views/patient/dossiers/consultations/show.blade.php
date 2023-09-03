@extends('layouat.layaoutPatient')
@section('contenu')
<div class="card">
  <div class="card-header">
    <div class="card-title">Consultation n° {{$consultation->id}}</div>
  </div>
  <div class="card-body">
    <ul class="timeline">
      <li class="list-group-item">
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
      </li>
      <li class="list-group-item"><b>Motif: </b>{{$consultation->Motif->lib}}</li>
      <li class="list-group-item">
        <div class="card-group">
          @if($consultation->taille)
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <p class="card-title"><b>Taille</b></p>
              <a href="#" class="btn btn-primary">{{$consultation->taille}}</a>
            </div>
          </div>
          @endif
          @if($consultation->poids)
          <div class="card" style="width:18rem;">
            <div class="card-body">
              <p class="card-title"><b>Poids</b></p>
              <a href="#" class="btn btn-primary">{{$consultation->poids}}</a>
            </div>
          </div>
          @endif
          @if($consultation->ta)
          <div class="card" style="width:18rem;">
            <div class="card-body">
              <p class="card-title"><b>TA</b></p>
              <a href="#" class="btn btn-primary">{{$consultation->ta}}</a>
            </div>
          </div>
          @endif
        </div>
      </li>
      <li class="list-group-item"><b>Date: </b>{{date('d/m/Y',strtotime($consultation->date))}} </h5>
      </li>
      <li class="list-group-item"><b> Observation: </b>{!!$consultation->observation!!} </h5>
      </li>
      @if($consultation->id_medecin==Auth::user()->id)
      <li class="list-group-item"><b>Observation privée: <small><b>( affiché pour vous uniquement )</b></small> </b>{!!$consultation->observation_prive!!} </h5>
      </li>
      @endif
      @if($consultation->effet_marquant_txt)
      <li class="list-group-item"><b>Antécédant: </b><small><b>( tout ce qui est affiché en antécédent sera répertorié dans l'historique du patient ) </b></small>{!!$consultation->effet_marquant_txt!!}</li>
      @endif
      <li class="list-group-item"><b>Crée le: </b>{{date('d/m/Y',strtotime($consultation->created_at))}} / <b>Mis à jour le: </b>{{date('d/m/Y',strtotime($consultation->updated_at))}} </h5>
      </li>
    </ul>
    @if($consultation->files->count()!=0)
    <div class="card-header">
      <div class="card-title">Liste de téléchargements</div>
    </div>
    <div class="card-body">
      @foreach($consultation->files as $f)
      <div class="row">
        <a href="{{ asset('uploads/consultation/'.$f->downloads) }}">
          <i data-feather="paperclip"></i> {{$f->downloads}}
        </a>
      </div>
      @endforeach
    </div>
    @endif
  </div>
  <div class="card-footer">
    @if($consultation->remarques == "saisie par le patient !")
    <a href="{{ url('patient/consultations/edit/'.$consultation->id) }}" class="btn btn-block btn-primary">
      <i data-feather="edit"></i> Modifier consultation
    </a>
    @endif
  </div>
</div>
@endsection