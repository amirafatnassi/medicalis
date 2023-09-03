<input class="form-control" type="text" id="name" name="name">
<input class="form-control" type="text" id="description" name="description">
<input class="form-control" type="text" id="quantity" name="quantity">
<input class="form-control" type="text" id="prix_unitaire" name="prix_unitaire">
<input class="form-control" type="text" id="discount" name="discount">
<input class="form-control" type="text" id="prix_ht" name="prix_ht">
<div class="row">
    <div class="col-8">
        <input class="form-control" type="text" id="tva" name="tva" value="{{$devis->tva}}">
    </div>
    <div class="col-4">%</div>
</div>

<input class="form-control" type="text" id="prix_ttc" name="name">
<button class="btn btn-primary">Add</button>