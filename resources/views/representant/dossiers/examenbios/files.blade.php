@extends('menus.layoutRepresentant')
@section('contenu')
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier[0]->image)}}" height="104" width="104" alt="User avatar" />
                        <div class="d-flex flex-column ml-1">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">Dossier médical n°: {{$dossier[0]->id}}: {{$dossier[0]->nom}} {{$dossier[0]->prenom}}</h4>
                                <span class="card-text">{{$dossier[0]->email}}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                    </svg></a>
                                <a class="btn btn-outline-primary ml-1" href="">
                                    <i data-feather="printer" class="mr-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                <div class="user-info-wrapper">
                    <div class="d-flex flex-wrap my-50">
                        <div class="user-info-title">
                            <i data-feather="flag" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Pays: </span>
                        </div>
                        <p class="card-text mb-0">{{$dossier[0]->pays}}</p>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="user-info-title">
                            <i data-feather="phone" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Tel: </span>
                        </div>
                        <p class="card-text mb-0">{{$dossier[0]->tel}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<h3>Liste de téléchargement:</h3>
@foreach($files as $f)
<div class="row">
    <a href="{{url('/uploads/exbio/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
</div>
@endforeach
</section>
</div>
</div>
</div>
@endsection