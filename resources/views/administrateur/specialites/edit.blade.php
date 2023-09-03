@extends('layouat.layoutAdmin')
@section('contenu')
<form method="post" action="{{url('administrateur/specialites/update/'.$specialite->id)}}" enctype="multipart/form-data"> {{csrf_field()}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Modifier spécialité</div>
        </div>
        <div class="card-body row">
            <div class="col-12">
                <label for="id">ID</label>
                <input class="form-control" name="id" id="id" type="text" value="{{old('id',$specialite->id ?? null)}}" readonly>
            </div>
            <div class="col-12">
                <label for="lib">Libelle</label>
                <input class="form-control" name="lib" id="lib" type="text" value="{{old('lib',$specialite->lib ?? null)}}">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
        </div>
    </div>
</form>
@endsection