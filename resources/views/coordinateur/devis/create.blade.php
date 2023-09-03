@extends('layouat.layoutCoordinateur')
@section('contenu')
<form method="post" action="{{url('coordinateur/devis/store')}}"> @csrf
    <div class="card">
        <div class="card-header">
            <div class="card-body invoice-padding pb-0">
                <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                    <div>
                        <div class="logo-wrapper">
                            <img src=" {{asset('uploads/dmp_logo.png')}}" alt="profile image" height="40" width="40">
                            <h3 class="text-primary invoice-logo">DMC</h3>
                        </div>
                        <p class="card-text mb-25">{{Auth()->user()->prenom}} {{Auth()->user()->nom}}</p>
                        <p class="card-text mb-25">{{Auth()->user()->rue}}</p>
                        <p class="card-text mb-25">{{Auth()->user()->cp}} {{Auth()->user()->country_id}}</p>
                        <p class="card-text mb-0">E-mail: {{Auth()->user()->email}}</p>
                        <p class="card-text mb-0">Tel: {{Auth()->user()->tel}}</p>
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
                                <input type="number" class="form-control invoice-edit-input" placeholder="53634" required name="id" />
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-1">
                            <span class="title">Date:</span>
                            <input type="date" name="date" class="form-control invoice-edit-input" value="{{old('date',now()->toDateString() ?? null)}}">
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="title">Due Date:</span>
                            <input type="date" name="due_date" class="form-control invoice-edit-input" value="{{old('date',now()->addMonth()->toDateString() ?? null)}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body row invoice-preview-card">


            <hr class="invoice-spacing" />

            <div class="card-body invoice-padding pt-0">
                <div class="row row-bill-to invoice-spacing">
                    <div class="col-8">
                        <h6 class="invoice-to-title">Devis pour:</h6>
                        <div class="invoice-customer">
                            <select class="form-control">
                                <option>{{$destinataire->prenom}} {{$destinataire->nom}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="file"><b>Taux TVA:</b></label>
                        <select name="tva" id="tva" class="form-control">
                            <option value="6">6%</option>
                            <option value="7">7%</option>
                            <option value="18">18%</option>
                            <option value="19">19%</option>
                            <option value="20">20%</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <label for="currency"><b>Currency:</b></label>
                        <select name="currency" id="currency" class="form-control">
                            <option value="DTN">Tunisian Dinar (DTN)</option>
                            <option value="USD">United States Dollar (USD)</option>
                            <option value="EUR">Euro (EUR)</option>
                            <option value="GBP">British Pound Sterling (GBP)</option>
                            <option value="JPY">Japanese Yen (JPY)</option>
                            <option value="AUD">Australian Dollar (AUD)</option>
                            <option value="CAD">Canadian Dollar (CAD)</option>
                            <option value="CHF">Swiss Franc (CHF)</option>
                            <option value="CNY">Chinese Yuan (CNY)</option>
                            <option value="SEK">Swedish Krona (SEK)</option>
                        </select>
                    </div>
                    <div class="col-12 mt-1">
                        <input class="form-control" value="{{$demandeCons->id}}" id="demande_cons_id" name="demande_cons_id" hidden />
                        <input class="form-control" id="receiver_id" name="receiver_id" value="{{$demandeCons->created_by}}" hidden />  
                        <button type="button" id="addDetailBtn" class="btn btn-secondary"><i data-feather="plus"></i> Add Invoice Detail</button>
                    </div>
                    <div class="col-12" id="invoiceDetails">
                        <div class="invoice-detail row">
                            <div class="form-group col-2">
                                <label for="act">Act:</label>
                                <input type="text" name="name[]" class="form-control" required>
                            </div>

                            <div class="form-group col-3">
                                <label for="description">Description:</label>
                                <textarea name="description[]" class="form-control" rows="1" required></textarea>
                            </div>

                            <div class="form-group col-1">
                                <label for="quantity">Quantity:</label>
                                <input type="number" name="quantity[]" class="form-control calculate-total" required>
                            </div>

                            <div class="form-group col-1">
                                <label for="prix_unitaire">prix unitaire:</label>
                                <div class="input-group">
                                    <input type="number" name="prix_unitaire[]" class="form-control calculate-total prix-unitaire-input" step="0.01" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text prix-unitaire-currency currency-symbol"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col">
                                <label for="discount">remise:</label>
                                <div class="input-group">
                                    <input type="number" name="discount[]" class="form-control" step="0.01" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col">
                                <label for="prix_ht">prix ht:</label>
                                <div class="input-group">
                                    <input type="number" name="prix_ht[]" class="form-control prix-ht" step="0.01" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text prix-ht-currency currency-symbol"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group col">
                                <label for="prix_ttc">prix ttc:</label>
                                <div class="input-group">
                                    <input type="number" name="prix_ttc[]" class="form-control prix-ttc" step="0.01" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text prix-ttc-currency currency-symbol"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col">
                        <label for="total">Total HT:</label>
                        <div class="input-group">
                            <input type="text" id="total_ht" name="total_ht" class="form-control" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text total_ht-currency currency-symbol"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col">
                        <label for="total">Total TTC:</label>
                        <div class="input-group">
                            <input type="text" id="total_ttc" name="total_ttc" class="form-control" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text total_ttc-currency currency-symbol"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="payment_info"><b>payment_info:</b></label>
                        <textarea class="form-control" id="payment_info" rows="2" name="payment_info" placeholder="payment_info" cols="30" rows="5">{{old('observation') }}</textarea>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="note" class="form-label font-weight-bold">Note:</label>
                    <textarea class="form-control" rows="2" id="note">
                            It was a pleasure working with you and your team.
                            We hope you will keep us in mind for future freelance projects.Thank You!
                        </textarea>
                </div>
            </div>
        </div>
        <div class="card-footer row">
            <button type="submit" class="btn btn-primary ml-2">Envoyer devis</button>
        </div>
    </div>
</form>

<script>
    document.getElementById('currency').addEventListener('change', function() {
        const selectedCurrency = this.value;
        const currencySymbol = getCurrencySymbol(selectedCurrency);

        document.querySelectorAll('.prix-unitaire-input').forEach(input => {
            const parentInputGroup = input.closest('.input-group');
            const currencySymbolSpan = parentInputGroup.querySelector('.input-group-append .currency-symbol');

            currencySymbolSpan.textContent = currencySymbol;
        });

        // Update prix_ht input symbols
        document.querySelectorAll('.prix-ht-currency').forEach(span => {
            span.textContent = currencySymbol;
        });

        // Update prix_ttc input symbols
        document.querySelectorAll('.prix-ttc-currency').forEach(span => {
            span.textContent = currencySymbol;
        });

        // Update total_ht input symbols
        document.querySelectorAll('.total_ttc-currency').forEach(span => {
            span.textContent = currencySymbol;
        });

        // Update total_ttc input symbols
        document.querySelectorAll('.total_ht-currency').forEach(span => {
            span.textContent = currencySymbol;
        });
    });

    function getCurrencySymbol(currencyCode) {
        switch (currencyCode) {
            case 'USD':
                return '$';
            case 'EUR':
                return '€';
            case 'GBP':
                return '£';
            case 'JPY':
                return '¥';
            case 'AUD':
            case 'CAD':
                return '$';
            case 'CHF':
                return 'Fr';
            case 'CNY':
                return '¥';
            case 'SEK':
                return 'kr';
            default:
                return '';
        }
    }

    function calculateRowTotal(row) {
        const quantity = parseFloat(row.querySelector('[name="quantity[]"]').value);
        const prixUnitaire = parseFloat(row.querySelector('[name="prix_unitaire[]"]').value);
        const discount = parseFloat(row.querySelector('[name="discount[]"]').value);

        const tvaValue = parseFloat(document.getElementById('tva').value) / 100;

        const prixHt = (quantity * prixUnitaire) * (1 - (discount / 100));
        const prixTtc = prixHt * (1 + tvaValue);

        row.querySelector('.prix-ht').value = prixHt.toFixed(2);
        row.querySelector('.prix-ttc').value = prixTtc.toFixed(2);

        calculateTotals();
    }

    function calculateTotals() {
        let totalHt = 0;
        let totalTtc = 0;

        document.querySelectorAll('.invoice-detail').forEach(row => {
            const prixHt = parseFloat(row.querySelector('.prix-ht').value);
            const prixTtc = parseFloat(row.querySelector('.prix-ttc').value);

            if (!isNaN(prixHt)) {
                totalHt += prixHt;
            }

            if (!isNaN(prixTtc)) {
                totalTtc += prixTtc;
            }
        });

        document.getElementById('total_ht').value = totalHt.toFixed(2);
        document.getElementById('total_ttc').value = totalTtc.toFixed(2);
    }

    document.getElementById('addDetailBtn').addEventListener('click', function() {
        const invoiceDetails = document.getElementById('invoiceDetails');
        const newDetail = document.querySelector('.invoice-detail').cloneNode(true);

        newDetail.querySelectorAll('input').forEach(input => {
            input.value = '';
        });

        invoiceDetails.appendChild(newDetail);

        newDetail.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', function() {
                calculateRowTotal(newDetail);
            });
        });
    });

    document.querySelectorAll('.invoice-detail input').forEach(input => {
        input.addEventListener('input', function() {
            const row = input.closest('.invoice-detail');
            calculateRowTotal(row);
        });
    });

    // event listener to update calculations when tva value changes
    document.getElementById('tva').addEventListener('input', function() {
        document.querySelectorAll('.invoice-detail').forEach(row => {
            calculateRowTotal(row);
        });
    });
</script>
@endsection