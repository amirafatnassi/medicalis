@extends('layouat.layoutCoordinateur')
@section('contenu')
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
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
            <div class="col-6">
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
<div class="card invoice-preview-card">
    <div class="card-body invoice-padding pb-0">
        <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
            <div>
                <div class="logo-wrapper">
                    <img src=" {{asset('uploads/dmp_logo.png')}}" alt="profile image" height="40" width="40">
                    <h3 class="text-primary invoice-logo">DMC</h3>
                </div>
                <p class="card-text mb-25">{{$invoice->sender}}</p>
                <p class="card-text mb-25">{{$invoice->rue}} {{$invoice->ville_id}}</p>
                <p class="card-text mb-25">{{$invoice->cp}} {{$invoice->country_id}}</p>
                <p class="card-text mb-0">E-mail: {{$invoice->email}}</p>
                <p class="card-text mb-0">Tel: {{$invoice->tel}}</p>
            </div>
            <div class="invoice-number-date mt-md-0 mt-2">
                <div class="d-flex align-items-center justify-content-md-end mb-1">
                    <h4 class="invoice-title">Devis</h4>
                    <div class="input-group input-group-merge invoice-edit-input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i data-feather="hash"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control invoice-edit-input" value="{{$invoice->id}}" disabled />
                    </div>
                </div>
                <div class="d-flex align-items-center mb-1">
                    <span class="title">Date:</span>
                    <input type="date" class="form-control invoice-edit-input" value="{{$invoice->date}}" disabled />
                </div>
                <div class="d-flex align-items-center">
                    <span class="title">Due Date:</span>
                    <input type="date" class="form-control invoice-edit-input" value="{{$invoice->due_date}}" disabled />
                </div>
            </div>
        </div>
    </div>
     <hr class="invoice-spacing" />
    <div class="card-body invoice-padding pt-0">
        @if($count>0)
        <div class="card mt-1">
            <div class="card-datatable table-responsive">
                <table class="invoice-list-table table">
                    <thead>
                        <tr>
                            <th>Acte</th>
                            <th>Description</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Remise %</th>
                            <th>Total HT</th>
                            <th>Total TTC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice_lines as $line)
                        <tr>
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
        </div>
        @endif
    </div>
    <div class="card-body invoice-padding">
        <div class="row invoice-sales-total-wrapper">
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

        <br>
        @if(!is_null($invoice->note))
        <h5><u>Notes: </u> </h5>
        <div class="row invoice-sales-total-wrapper">
            <p> {{$invoice->note}}</p>
        </div>
        @endif
        @if(!is_null($invoice->payment_info))
        <h5><u>Info de paiement: </u> </h5>
        <div class="row invoice-sales-total-wrapper">
            <p> {{$invoice->payment_info}}</p>
        </div>
        @endif
    </div>
</div>
@endsection