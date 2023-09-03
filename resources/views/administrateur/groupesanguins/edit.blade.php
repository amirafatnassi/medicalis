@extends('layouat.layoutAdmin')
@section('contenu')
<form method="post" action="{{url('administrateur/groupesanguins/update/'.$groupesanguin->id)}}"> {{csrf_field()}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Modifier motif</div>
        </div>
        <div class="card-body row">
            <div class="col-12">
                <label for="id">ID</label>
                <input class="form-control" name="id" id="id" type="text" value="{{old('id',$groupesanguin->id ?? null)}}" readonly>
            </div>
            <div class="col-12">
                <label for="lib">Libelle</label>
                <input class="form-control" name="lib" id="lib" type="text" value="{{old('lib',$groupesanguin->lib ?? null)}}">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save"></i>Enregistrer les modifications</button>
        </div>
    </div>
</form>
@endsection