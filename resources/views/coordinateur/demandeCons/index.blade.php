@extends('layouat.layoutCoordinateur')
@section('contenu')
<div class="card">
    <div class="card-body table-responsive">
        <table class="table align-middle mb-0 bg-white">
            <thead>
                <tr>
                    <th scope="col">Patient</th>
                    <th scope="col">Convention</th>
                    <th scope="col">Demandes de consultations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dossiers as $dossier)
                <tr class="fw-normal">
                    <th>
                        <img src="{{asset('uploads/users/'.($dossier->user->image??'user.png'))}}" class="shadow-1-strong rounded-circle" alt="avatar 1" style="width: 55px; height: 55px;">
                        <span class="ms-2">{{$dossier->id}}: {{$dossier->user->prenom}} {{$dossier->user->nom}}</span>
                    </th>
                    <td class=" align-middle">
                        @if($dossier->convention_id)
                        {{$dossier->Convention->lib}}
                        @endif
                    </td>
                    <td class="align-middle">
                        @if($dossier->demandesConsultations->count()>0)
                        <a href="{{ url('coordinateur/demandeCons/'.$dossier->id.'/show')}}" class="btn btn-link" role="button">
                            Demandes de consultations
                            <span class="badge bg-danger ms-2">{{$dossier->demandesConsultations->count()}}</span>
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection