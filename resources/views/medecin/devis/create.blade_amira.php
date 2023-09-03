@extends('layouat.layaoutMedecin')
@section('contenu')
<form method="post" action="{{url('medecin/devis/store')}}"> @csrf
    <div class="row invoice-add">
        <!-- Invoice Add Left starts -->
        <div class="col-12">
            <div class="card invoice-preview-card">
                <!-- Header starts -->
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

                <hr class="invoice-spacing" />

                <!-- Address and Contact starts -->
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
                                <option>DTN</option>
                                <option>Euro</option>
                                <option>USD</option>
                                <option>Yen</option>
                                <option>AUD</option>
                                <option>GBP</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <input class="form-control" value="{{$demande_devis->id}}" id="demande_devis_id" name="demande_devis_id" hidden />
                            <input class="form-control" id="receiver_id" name="receiver_id" value="{{$demande_devis->created_by}}" hidden />
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
                <!-- Address and Contact ends -->
                <div class="card-body">
                    <button type="submit" class="btn btn-outline-primary btn-block" id="b_submit">Save</button>
                </div>
            </div>

        </div>
    </div>
</form>


@endsection
</section>
</div>
</div>
</div>