@extends('layouat.layaoutPatient')

@section('contenu')

<div class="card">
  <div class="card-header">
    <div class="card-title">Examen radio n° {{$examenradio->id}}</div>
  </div>
  <div class="card-body">
    <li class="list-group-item"><b>Médecin: </b>
      @if($examenradio->id_medecin)
      {{$examenradio->medecin->prenom}} {{$examenradio->medecin->nom}}
      @endif

      @if($examenradio->id_medecin && $examenradio->medecin->specialite_id)
      <b>Spécialité: </b> {{$examenradio->medecin->Specialite->lib}}
      @endif
      @if(!is_null($examenradio->remarques))
      <a href="#" class="badge badge-danger">{{$examenradio->remarques}}</a>
      @endif
    </li>
    <li class="list-group-item"><b>Date: </b>{{date('d/m/Y',strtotime($examenradio->date))}}</li>
    @if(!is_null($examenradio->url_radio))
    <li class="list-group-item"><b>URL Radio :</b><a href="{{$examenradio->url_radio}}" target="_blank">{{$examenradio->url_radio}}</a></li>
    @endif
    <li class="list-group-item"><b>Modalité: </b>{{$examenradio->typeradio->lib}}</li>
    <li class="list-group-item"><b>Radio: </b>{{$examenradio->Radio->lib}} @if(!is_null($examenradio->radio2)) &nbsp; {{$examenradio->radio2}} @endif</li>
    <li class="list-group-item"><b>Observation: </b>{!!$examenradio->lettre!!}</li>
    <li class="list-group-item"><b>Crée le: </b>{{date('d/m/Y',strtotime($examenradio->created_at))}} <b>Mis à jour le: </b>{{date('d/m/Y',strtotime($examenradio->updated_at))}}</li>
  </div>

  @if($examenradio->files->count()!=0)
  <div class="card-header">
    <div class="card-title">Liste de téléchargements:</div>
  </div>
  <div class="card-body">
    @foreach($examenradio->files as $f)
    <div class="row">
      <a href="{{url('/uploads/exradio/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}} </a>
    </div>
    @endforeach
  </div>
  @endif

  @if($examenradio->remarques = "saisie par le patient !")
  <div class="card-footer">
    <a href="{{url('patient/examenradios/edit/'.$examenradio->id)}}" class="btn  btn-block btn-primary">
      <i data-feather="edit"></i> Modifier examen radio
    </a>
  </div>
  @endif
</div>
@endsection