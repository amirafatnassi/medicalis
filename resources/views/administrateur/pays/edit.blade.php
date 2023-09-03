@extends('layouat.layoutAdmin')
@section('contenu')
<form method="post" action="{{url('administrateur/pays/update/'.$pays->code)}}" enctype="multipart/form-data"> {{csrf_field()}}
    <div class="card">
        <div class="card-body row">
            <div class="col-12">
                <label for="lib"><b>Code: </b></label>
                <input class="form-control" name="code" id="code" type="text" value="{{$pays->code}}" disabled>
            </div>
            <div class="col-12">
                <label for="lib"><b>Libelle: </b></label>
                <input class="form-control" name="lib" id="lib" type="text" placeholder="" value="{{old('lib',$pays->lib ?? null)}}">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save"></i>Enregistrer les modifications</button>
        </div>
    </div>
</form>
@endsection