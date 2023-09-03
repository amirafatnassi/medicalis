@extends('layouat.layoutAdmin')
@section('contenu')
<form method="POST" action="{{url('administrateur/pays/ville/store')}}"> {{csrf_field()}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Nouvelle Ville</div>
        </div>
        <div class="card-body row">
            <div class="col-12">
                <label for="lib">Code</label>
                <input class="form-control" name="code" id="code" value="{{$id}}" readonly>
                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" hidden>
                    Le libelle est obligatoire !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="col-12">
                <label for="lib">Libelle:</label>
                <input class="form-control" name="lib" id="lib">
                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" hidden>
                    Le libelle est obligatoire !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                <i data-feather="save"></i>
                Enregistrer
            </button>
        </div>
    </div>
</form>
<script>
    var b_submit = document.getElementById("b_submit");
    var lib = document.getElementById("lib");
    var msg = document.getElementById("msg");
    b_submit.addEventListener('click', valider);
    function valider(e) {
        if (lib.value == '') {
        e.preventDefault();
        msg.hidden = false;
        } else {
        msg.hidden = true;
        }
    }
</script>
@endsection