@extends('layouat.layaoutPatient')
@section('contenu')
<div class="card">
  <div class="card-header">
    <div class="card-title">
      Liste de téléchargement
    </div>
  </div>
  <div class="card-body">
    @foreach($files as $f)
    <div class="row">
      <a href="{{asset('uploads/consultation/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
    </div>
    @endforeach
  </div>
</div>
@endsection