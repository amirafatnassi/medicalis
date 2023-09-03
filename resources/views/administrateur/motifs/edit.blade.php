@extends('layouat.layoutAdmin')
@section('contenu')
<form method="post" action="{{url('administrateur/motifs/update/'.$motif->id)}}" enctype="multipart/form-data"> {{csrf_field()}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Modifier motif</div>
        </div>
        <div class="card-body row">
            <div class="col-12">
                <label for="id"><b>ID: </b></label>
                <input class="form-control" name="id" id="id" type="text" value="{{old('id',$motif->id ?? null)}}" readonly>
            </div>
            <div class="col-12">
                <label for="lib"><b>Libelle: </b></label>
                <input class="form-control" name="lib" id="lib" type="text" value="{{old('lib',$motif->lib ?? null)}}">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
        </div>
    </div>
</form>
@endsection