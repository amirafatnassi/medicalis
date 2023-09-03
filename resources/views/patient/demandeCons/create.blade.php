@extends('layouat.layaoutPatient')
@section('contenu')

<div class="card">
    <div class="card-header">
        <h5 class="card-title">
            <center>Nouvelle demande de consultation:</center>
        </h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{url('patient/demandeCons/store')}}" enctype="multipart/form-data"> {{csrf_field()}}
            <div class="card-body">
                <div class="col-6" hidden>
                    <input type="text" value="{{$dossier->id}}" id="dossier_id" name="dossier_id" hidden />
                </div>
                <div class="col-6">
                    <label for="type_demande_id"><b>Type de demande:</b></label>
                    <select class="form-control" name="type_demande_id" id="type_demande_id">
                        @foreach ($TypeDemandes as $typeDemande)
                        <option value="{{$typeDemande->id}}">{{$typeDemande->lib}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label for="file"><b>Objet:</b></label>
                    <input type="text" name="objet" class="form-control" id="objet">
                </div>
                <div class="col-12">
                    <label for="observation"><b>Rapport:</b></label>
                    <textarea class="form-control" id="observation" name="observation" placeholder="observation" cols="30" rows="30">{{old('observation') }}</textarea>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" hidden>
                        Le rapport est obligatoire !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
                <div class="col-12">
                    <label for="file"><b>Pièce jointe:</b></label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                            <label class="custom-file-label" id="filename">Choisir fichier</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                    <i data-feather="save" class="mr-1"></i>
                    Enregistrer demande de consultation
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    $.each(this.files, function(key, value) {
        alert(key + ": " + value);
    });
    $("#fileup").change(function() {
        var chaine = "";
        $.each(this.files, function(key, value) {
            chaine = chaine + value.name + ',';
        });
        $("#filename").text(chaine);
    });
</script>
<script>
    CKEDITOR.replace('observation');
</script>
</section>
</div>
</div>
</div>
@endsection