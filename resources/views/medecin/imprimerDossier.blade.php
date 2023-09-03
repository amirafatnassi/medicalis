@extends('layouat.layaoutMedecin')

@section('contenu')

<body class="horizontal-layout horizontal-menu blank-page navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
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
                            <p class="mb-25">ID: {{$dossier->idD}}</p>
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
                                <tr>
                                    <td class="py-1 pl-4">
                                        <p class="font-weight-semibold mb-25">Antécédents médicaux:</p>
                                        <p class="text-muted text-nowrap">
                                         {!!$dossier->antecedants_med!!}
                                        </p>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td class="py-1 pl-4">
                                        <p class="font-weight-semibold mb-25">Antécédents chirurgicaux:</p>
                                        <p class="text-muted text-nowrap">
                                        {!!$dossier->antecedants_chirg!!}
                                        </p>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td class="py-1 pl-4">
                                        <p class="font-weight-semibold mb-25">Antécédents familiaux:</p>
                                        <p class="text-muted text-nowrap">
                                        {!!$dossier->antecedants_fam!!}
                                        </p>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td class="py-1 pl-4">
                                        <p class="font-weight-semibold mb-25"> Allergies:</p>
                                        <p class="text-muted text-nowrap">
                                         {!!$dossier->allergies!!}
                                        </p>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td class="py-1 pl-4">
                                        <p class="font-weight-semibold mb-25">Indicateur biologiques:</p>
                                        <p class="text-muted text-nowrap">
                                         {!!$dossier->indicateur_bio!!}
                                        </p>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td class="py-1 pl-4">
                                        <p class="font-weight-semibold mb-25">Traitements chroniques:</p>
                                        <p class="text-muted text-nowrap">
                                         {!!$dossier->traitement_chr!!}
                                        </p>
                                    </td>
                                    
                                </tr>

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
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <!--<script src="../../../app-assets/vendors/js/vendors.min.js"></script>-->
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!--<script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-invoice-print.js"></script>
    <!-- END: Page JS-->

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