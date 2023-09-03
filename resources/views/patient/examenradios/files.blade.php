@extends('layouat.layaoutPatient')
@section('contenu')

<div class="card">
    <div class="card-header"><div class="card-title">Liste de téléchargements</div></div>
    <div class="card-body">
        @foreach($files as $f)
        <div class="row">
            <a href="{{url('uploads/exradio/'.$f->downloads)}}"><i data-feather="paperclip"></i>{{$f->downloads}}</a>
        </div>
        @endforeach
    </div>
</div>
@endsection