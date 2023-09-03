@extends('menus.layoutPatient')
@section('contenu')

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