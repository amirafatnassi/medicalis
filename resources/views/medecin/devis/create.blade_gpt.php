@extends('layouat.layaoutMedecin')
@section('contenu')
<form method="POST" action="{{url('medecin/devis/store')}}">
    @csrf

    <div class="form-group">
        <label for="invoice_reference">Invoice Reference:</label>
        <input type="text" name="invoice_reference" id="invoice_reference" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="invoice_date">Invoice Date:</label>
        <input type="date" name="invoice_date" id="invoice_date" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="sender_id">Sender ID:</label>
        <input type="number" name="sender_id" id="sender_id" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="recipient_id">Recipient ID:</label>
        <input type="number" name="recipient_id" id="recipient_id" class="form-control" required>
    </div>

    <hr>

    <div id="invoiceDetails">
        <div class="invoice-detail row">
            <div class="form-group">
                <label for="act">Act:</label>
                <input type="text" name="act[]" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description[]" class="form-control" rows="2" required></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price[]" class="form-control" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity[]" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tva">TVA:</label>
                <input type="number" name="tva[]" class="form-control" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="total">Total:</label>
                <input type="number" name="total[]" class="form-control" step="0.01" required>
            </div>
        </div>
    </div>

    <button type="button" id="addDetailBtn" class="btn btn-secondary">Add Invoice Detail</button>

    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">Add Invoice</button>
    </div>
</form>

<script>
    document.getElementById('addDetailBtn').addEventListener('click', function () {
        const invoiceDetails = document.getElementById('invoiceDetails');
        const newDetail = document.querySelector('.invoice-detail').cloneNode(true);
        invoiceDetails.appendChild(newDetail);
    });
</script>
@endsection