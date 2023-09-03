@extends('layouat.layoutCoordinateur')
@section('contenu')
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="105" width="105" alt="avatar" />
                        <div class="d-flex flex-column ml-1">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                                <span class="card-text">{{$dossier->email}}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="" class="btn btn-primary">
                                    <i data-feather="edit-2"></i>
                                </a>
                                <a class="btn btn-outline-primary ml-1" href="">
                                    <i data-feather="printer"></i>
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
                        <p class="card-text mb-0">{{$dossier->pays}}</p>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="user-info-title">
                            <i data-feather="phone" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Tel: </span>
                        </div>
                        <p class="card-text mb-0">{{$dossier->tel}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($invoices as $invoice)
<div class="card invoice-preview-card">
    <div class="card-body invoice-padding pb-0">
        <div class="row">
            <div class="col-4">
                <p class="card-text mb-25">{{$invoice->sender}}</p>
                <a href="{{ url('coordinateur/demandeDevis/show_detail_invoice/'.$invoice->id)}}" class="btn btn-link"><i data-feather="more-horizontal"></i> Plus de détails</a>
            </div>
            <div class="col-4">
                <div class="d-flex align-items-center mb-1">
                    <h4 class="invoice-title">Devis n°: {{$invoice->id}}</h4>
                </div>
                <div class="d-flex align-items-center mb-1">
                    <span class="title">Date:  {{date('d/m/Y',strtotime($invoice->date))}}</span>
                </div>
                <div class="d-flex align-items-center">
                    <span class="title">Due Date:  {{date('d/m/Y',strtotime($invoice->due_date))}}</span>
                </div>
            </div>
            <div class="col-4">
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
    </div>

    <div class="card-body invoice-padding">
        <div class="row invoice-sales-total-wrapper">
            <div class="col-md-3 order-md-1 order-2 mt-md-0 mt-3"></div>
            <div class="col-md-9 d-flex justify-content-end order-md-2 order-1">

            </div>
        </div>
    </div>
</div>
@endforeach
@endsection