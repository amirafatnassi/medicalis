@extends('menus.layoutCoordinateur')
@section('contenu')

    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="invoice-print p-3">
                <div class="d-flex justify-content-between flex-md-row flex-column pb-2">
                    <div>
                        <div class="d-flex mb-1">
                            <h3 class="text-primary font-weight-bold ml-1">DMP</h3>
                        </div>
                        <p class="mb-25">Adresse: Tunisie</p>
                        <p class="mb-25">E-mail: contact@dmp.com</p>
                        <p class="mb-0">Tel (+216) 11 11 11 11 </p>
                    </div>
                    <div class="mt-md-0 mt-2">
                        <h4 class="font-weight-bold text-right mb-1">INVOICE #3492</h4>
                        <div class="invoice-date-wrapper">
                            <span class="invoice-date-title">Date:</span>
                            <span class="font-weight-bold">{{$date}}</span>
                        </div>
                    </div>
                </div>

                <hr class="my-2" />
                @foreach($data as $dossier)


                <div class="row pb-2">
                    <div class="col-sm-4">
                        <img src="{{asset('/uploads/dossier/'.$dossier->image)}}" height="104" width="104" alt="User avatar" />
                    </div>
                    <div class="col-sm-4">
                        <h6 class="mb-1">Dossier Médical:</h6>
                        <p class="mb-25">ID: {{$dossier->id}}</p>
                        <p class="mb-25">{{$dossier->id_patient}}</p>
                        <p class="mb-25">Sexe: {{$dossier->sexe}}</p>
                        <p class="mb-0">E-mail: {{$dossier->email}}</p>
                        <p class="mb-0">Tel: {{$dossier->tel}}</p>

                    </div>
                    <div class="col-sm-4 mt-sm-0 mt-2">
                        <p class="mb-25">Date et lieu de naissance: {{date('d/m/Y',strtotime($dossier->datenaissance))}} , {{$dossier->lieunaissance}}</p>
                        <p class="mb-25">Groupe sanguin: </b></h5>{{$dossier->groupe_sanguin}}</p>
                        <p class="mb-25">Taille: {{$dossier->taille}}</p>
                        <p class="mb-25">Poids: {{$dossier->poids}}</p>
                        <p class="mb-0">Profession: {{$dossier->profession}}</p>
                        <p class="mb-0">Adresse: {{$dossier->ville}} {{$dossier->pays}}</p>
                    </div>
                </div>

                <div class="table-responsive mt-2">
                    <table class="table m-0">
                        <tbody>
                            @foreach($resultats as $c)
                            <tr>
                                <td class="py-1 pl-4">
                                    <p class="font-weight-semibold mb-25">ID de consultation: {{$c->id}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1 pl-4">
                                    <p class="font-weight-semibold mb-25">Date: {{date('d/m/Y',strtotime($c->date))}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1 pl-4">
                                    <p class="font-weight-semibold mb-25">Motif: {{$c->motif}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1 pl-4">
                                    <p class="font-weight-semibold mb-25">Taille: {{$c->taille}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1 pl-4">
                                    <p class="font-weight-semibold mb-25">Poids: {{$c->poids}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1 pl-4">
                                    <p class="font-weight-semibold mb-25">TA: {{$c->ta}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1 pl-4">
                                    <p class="font-weight-semibold mb-25">Observation: {{$c->observation}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1 pl-4">
                                    <p class="font-weight-semibold mb-25">Antécédant: {!!$c->effet_marquant_txt!!}</p>
                                </td>
                            </tr>
                            @if(!is_null($c->remarques))
                            <tr>
                                <td class="py-1 pl-4">
                                    <p class="font-weight-semibold mb-25"> Observation privée: {!!$c->observation_prive!!}</p>
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td class="py-1 pl-4">
                                    <p class="font-weight-semibold mb-25">Médecin: {!!$c->med!!}
                                        @if(!is_null($c->remarques))
                                        <a href="#" class="badge badge-danger">{{$c->remarques}}</a>
                                        @endif
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1 pl-4">
                                    <p class="font-weight-semibold mb-25">Crée le: {{date('d/m/Y',strtotime($c->created_at))}}</p>
                                </td>
                            </tr>
                            @if(!empty($files))
                            <p>Compléments d'informations:</p>
                            @foreach($files as $f)
                            <li class="list-group-item"><img src="{{public_path('uploads/consultation/'.$f->downloads)}}" width="400px;" height="400px;"></li>
                            @endforeach
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row invoice-sales-total-wrapper mt-3">
                    <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                        <p class="card-text mb-0">
                            <span class="font-weight-bold">Crée le :</span> <span class="ml-75">{{date('d/m/Y',strtotime($dossier->created_at))}}</span>
                            <span class="font-weight-bold">Mis à jour le :</span> <span class="ml-75">{{date('d/m/Y',strtotime($dossier->updated_at))}}</span>
                    </div>
                </div>
                @endforeach
                <hr class="my-2" />

                <div class="row">
                    <div class="col-12">
                        <span class="font-weight-bold">Note:</span>
                        <span>Merci pour votre visite !</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/pages/app-invoice-print.js"></script>
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
@endsection