<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Invoice Print - DMC - session: {{auth()->user()->prenom}} {{auth()->user()->nom}}</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/bordered-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-invoice-print.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

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
                                <img src=" {{asset('uploads/dmp_logo.png')}}" class="" alt="profile image" height="50" width="50">
                                <h3 class="text-primary font-weight-bold ml-1">DMC</h3>
                            </div>
                            <p class="mb-25">{{Auth()->user()->prenom}} {{Auth()->user()->nom}}</p>
                            <p class="mb-25">{{Auth()->user()->rue}} {{Auth()->user()->cp}} {{Auth()->user()->country_id}}</p>
                            <p class="mb-0">E-mail: {{Auth()->user()->email}}</p>
                            <p class="mb-0">Tel: {{Auth()->user()->tel}}</p>
                        </div>
                        <div class="mt-md-0 mt-2">
                            <h4 class="font-weight-bold text-right mb-1">INVOICE #{{$invoice->id}}</h4>
                            <div class="invoice-date-wrapper mb-50">
                                <span class="invoice-date-title">Date:</span>
                                <span class="font-weight-bold">{{date('d/m/Y',strtotime($invoice->date))}}</span>
                            </div>
                            <div class="invoice-date-wrapper">
                                <span class="invoice-date-title">Valide au:</span>
                                <span class="font-weight-bold">{{date('d/m/Y',strtotime($invoice->due_date))}}</span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-2" />

                    <div class="row pb-2">
                        <div class="col-sm-6">
                            <h6 class="mb-1">Invoice To:</h6>
                            <p class="mb-25">{{$invoice->receiver}}</p>
                        </div>
                        <div class="col-sm-6 mt-sm-0 mt-2">
                            <h6 class="mb-1">Payment Details:</h6>
                            <p class="mb-25">{{$invoice->payment_info}}</p>
                        </div>
                    </div>

                    <div class="table-responsive mt-2">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th class="py-1">#</th>
                                    <th class="py-1">Description</th>
                                    <th class="py-1">Prix unitaire</th>
                                    <th class="py-1">Quantité</th>
                                    <th class="py-1">Remise</th>
                                    <th class="py-1">Total HT</th>
                                    <th class="py-1">Total TTC</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoice_lines as $line)
                                <tr class="border-bottom">
                                    <td>{{$line->acte}}</td>
                                    <td>{{$line->description}}</td>
                                    <td>{{$line->quantity}}</td>
                                    <td>{{$line->prix_unitaire}}</td>
                                    <td>{{$line->discount}}</td>
                                    <td>{{$line->Prix_ht}}</td>
                                    <td>{{$line->Prix_ttc}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row invoice-sales-total-wrapper mt-3">
                        <div class="col-md-3 order-md-1 order-2 mt-md-0 mt-3"></div>
                        <div class="col-md-9 d-flex justify-content-end order-md-2 order-1">
                            <div class="invoice-total-wrapper">
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Total HT: {{$invoice->total_ht}} {{$invoice->currency}}</p>
                                </div>
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Tva: {{$invoice->tva}}%</p>
                                </div>
                                <hr class="my-50" />
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Total TTC: {{$invoice->total_ttc}} {{$invoice->currency}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-2" />

                    <div class="row">
                        <div class="col-12">
                            <span class="font-weight-bold">Note:</span>
                            <span>{{$invoice->note}}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
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
<!-- END: Body-->

</html>