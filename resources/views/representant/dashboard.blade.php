@extends('menus.layoutRepresentant')
@section('contenu')
<div class="card">
    <div class="card-header p-3">
        <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Liste de notifications:</h5>
    </div>
    <table class="table mb-0">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Notification</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($user->unreadNotifications as $notification)
            <tr class="fw-normal">
                <th class="border-0">
                    <p> {{ $notification->created_at->format('d/m/Y')  }} </p>
                    <p> {{ $notification->created_at->format('H:m')  }}</p>
                </th>
                <td class="border-0 align-middle">
                    {{ $notification->data['message'] }}
                </td>
                <td class="border-0 align-middle">
                    <a href="#!" data-mdb-toggle="tooltip" title="Done"><i class="fas fa-check text-success me-3"></i></a>
                    <a href="#!" data-mdb-toggle="tooltip" title="Remove"><i class="fas fa-trash-alt text-warning"></i></a>
                    <div class="row">
                        <form method="POST" action="{{url('coordinateurChef/mark-as-read/'.$notification->id)}}" enctype="multipart/form-data"> {{csrf_field()}}
                            <button class="me-2 btn btn-link" type="submit">Marquez comme lu</button>
                        </form>
                        @if($notification->type==="App\Notifications\DemandeInfosNotification")
                            <a class="me-2 btn btn-link" type="submit" href="{{url('representant/demandeInfos/repondre/'.$notification->data['demande'])}}">
                                <i data-feather="corner-down-right"></i>
                                Répondre
                            </a>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection