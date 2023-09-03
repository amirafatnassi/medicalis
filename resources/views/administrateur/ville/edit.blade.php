@extends('layouat.layoutAdmin')
@section('contenu')
<form method="post" action="{{url('administrateur/pays/ville/update/'.$ville->id_ville)}}" enctype="multipart/form-data"> {{csrf_field()}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Modifier ville</div>
        </div>     
        <div class="card-body row">
            <div class="col-12">
                <label for="id"><b>Code: </b></label>
                <input class="form-control" name="code" id="code" type="text" value="{{$ville->code}}" disabled>
            </div>
            <div class="col-12">
                <label for="lib"><b>Libelle: </b></label>
                <input class="form-control" name="lib" id="lib" type="text" value="{{old('lib',$ville->name ?? null)}}">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
        </div>
    </div>
</form>
@endsection