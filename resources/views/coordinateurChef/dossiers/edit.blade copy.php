@extends('menus.layoutCoordinateurChef')
@section('contenu')


<form method="post" action="{{url('coordinateurChef/dossiers/update/'.$dossier->id)}}" enctype="multipart/form-data"> @csrf
    <div class="row">
        <div class="col-4">
            <label for="nom"><b>Nom:</b></label>
            <input class="form-control" name="nom" id="nom" type="text" value="{{old('nom',$dossier->nom ?? null)}}">
        </div>
        <div class="col-4">
            <label for="prenom"><b>Prénom:</b></label>
            <input class="form-control" name="prenom" id="prenom" type="text" value="{{old('prenom',$dossier->prenom ?? null)}}">
        </div>
        <div class="col-4">
            <label for="sexe"><b>Sexe:</b></label>
            <select class="form-control" name="sexe" id="" disabled>
                <option value="{{$dossier->sexe_id}}">{{$dossier->sexe_lib}}</option>
            </select>
        </div>
        <div class="col-6">
            <label for="profession"><b>Profession:</b></label>
            <select class="form-control" name="profession" id="profession">
                <option value="{{$dossier->profession}}">{{$dossier->profession_lib}}</option>
                @foreach ($liste_professions as $list_prof)
                <option value="{{$list_prof->id}}">{{$list_prof->lib}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <label for="convention"><b>convention:</b></label>
            <select class="form-control" name="convention" id="convention">
                <option value="{{$dossier->convention}}">{{$dossier->convention_lib}}</option>
                @foreach ($liste_conventions as $convention)
                <option value="{{$convention->id}}">{{$convention->lib}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <label for="datenaissance"><b>Date de naissance:</b></label>
            <input class="form-control" name="datenaissance" id="datenaissance" type="date" disabled value="{{old('datenaissance',$dossier->datenaissance ?? null)}}">
        </div>
        <div class="col-6">
            <label for="lieunaissance"><b>Lieu de naissance:</b></label>
            <input class="form-control" name="lieunaissance" id="lieunaissance" type="text" value="{{old('lieunaissance',$dossier->lieunaissance ?? null)}}">
        </div>
        <div class="col-6">
            <label for="tel"><b>Tel:</b></label>
            <input class="form-control" name="tel" id="tel" type="text" value="{{old('tel',$dossier->tel ?? null)}}">
        </div>
        <div class="col-6">
            <label for="email"><b>E-mail:</b></label>
            <input class="form-control" name="email" id="email" type="email" value="{{old('email',$dossier->email ?? null)}}">
        </div>
        <div class="col-12">
            <label for="image">Avatar:</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input">
                    <label class="custom-file-label" id="filename1" >{{old('image',$dossier->image ?? null)}}</label>
                </div>
            </div>
        </div>
        <script>
            $.each(this.files, function(key, value) {
                alert(key + ": " + value);
            });
            $("#image").change(function() {
                var chaine = "";
                $.each(this.files, function(key, value) {
                    chaine = chaine + value.name + ',';
                });
                $("#filename1").text(chaine);
            });
        </script>
        <div class="col-12">
            <label for="contactdurgence"><b>Contact d'urgence:</b></label>
            <input class="form-control" name="contactdurgence" id="contactdurgence" type="text" value="{{old('contactdurgence',$dossier->contactdurgence ?? null)}}">
        </div>
        <div class="col-4">
            <label for="pays"><b>pays:</b></label>
            <select id="pays" name="pays" class="form-control">
                <option value="{{$dossier->pays}}">{{$dossier->pays_lib}}</option>
                @foreach($liste_countries as $key=>$country)
                <option value="{{$country->code}}">{{$country->lib}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="title"><b>ville:</b></label>
                <select name="state" id="state" class="form-control">
                    <option value="{{$dossier->ville}}">{{$dossier->ville_lib}}</option>
                </select>
            </div>
        </div>
        <div class="col-4">
            <label for="cp"><b>Zip:</b></label>
            <input type="text" class="form-control" id="cp" name="cp" value="{{old('cp',$dossier->cp ?? null)}}">
        </div>
        <div class="col-4">
            <label for="groupe_sanguin"><b>Groupe Sanguin:</b></label>
            <select class="form-control" name="groupe_sanguin" id="groupe_sanguin">
                <option value="{{$dossier->groupe_sanguin}}">{{$dossier->groupe_sanguin_lib}}</option>
                @foreach ($liste_groupesanguins as $liste_gsang)
                <option value="{{$liste_gsang->id}}"> {{$liste_gsang->lib}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4">
            <label for="taille"><b>Taille:</b></label>
            <input class="form-control" name="taille" id="taille" type="text" value="{{old('taille',$dossier->taille ?? null)}}">
        </div>
        <div class="col-4">
            <label for="poids"><b>Poids:</b></label>
            <input class="form-control" name="poids" id="poids" type="text" value="{{old('poids',$dossier->poids ?? null)}}">
        </div>
        <div class="col-12">
            <label for="antecedants_med"><b>Antécédants medicaux:</b></label>
            <textarea class="CKEDITOR form-control" name="antecedants_med" id="antecedants_med" type="text">{{old('antecedants_chirg',$dossier->antecedants_chirg ?? null)}}</textarea>
        </div>
        <div class="col-12">
            <label for="antecedants_chirg"><b>Antécédants chirurgicaux: </b></label>
            <textarea class="CKEDITOR form-control" name="antecedants_chirg" id="antecedants_chirg" type="text">{{old('antecedants_chirg',$dossier->antecedants_chirg ?? null)}}</textarea>
        </div>
        <div class="col-12">
            <label for="antecedants_fam"><b>Antécédants familials:</b></label>
            <textarea class="CKEDITOR form-control" name="antecedants_fam" id="antecedants_fam" type="text">{{old('antecedants_fam',$dossier->antecedants_fam ?? null)}}</textarea>
        </div>
        <div class="col-12">
            <label for="allergies"><b>Allergies: </b></label>
            <textarea class="CKEDITOR form-control" name="allergies" id="allergies" type="text">{{old('allergies',$dossier->allergies ?? null)}}</textarea>
        </div>
        <div class="col-12">
            <label for="indicateur_bio"><b>Indicateurs biologiques:</b></label>
            <textarea class="CKEDITOR form-control" name="indicateur_bio" id="indicateur_bio" type="text">{{old('indicateur_bio',$dossier->indicateur_bio ?? null)}}</textarea>
        </div>
        <div class="col-12">
            <label for="traitement_chr"><b>Traitements chroniques:</b></label>
            <textarea class="CKEDITOR form-control" name="traitement_chr" id="traitement_chr" type="text">{{old('traitement_chr',$dossier->traitement_chr ?? null)}}</textarea>
        </div>
        <div class="col-12">
            <label for="file"><b>Pièce jointe (complément d'informations):</b></label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                    <label class="custom-file-label" id="filename">Choisir fichier</label>
                </div>
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

        @if(!empty($files))
        <p>Compléments d'informations:</p>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fichier</th>
                    <th>Télécharger</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                @foreach($files as $f)
                <tr>
                    <td>{{$f->id}}</td>
                    <td>{{$f->downloads}}</td>
                    <td><a href="{{url('/uploads/dossier/'.$f->downloads)}}" class="btn btn-primary"><i data-feather="eye" class="mr-1"></i></a></td>
                    <td><a href="javascript:;" data-toggle="modal" onclick="deleteData({{$f->id}})" data-target="#DeleteModal" class="btn btn-danger"><i data-feather="trash"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @endif
        <div class=" d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
        </div>
    </div>
</form>
<div id="DeleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="" id="deleteForm" method="post">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Confirmation de suppression</h4>
                </div>
                <div class="modal-body">{{csrf_field()}} {{method_field('DELETE')}}
                    <p class="text-center">Vous avez demandez de supprimer un fichier parmi vos téléchargement,<br>voulez-vous confirmez ?</p>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Oui, supprimer!</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    $('#pays').change(function() {
        var countryID = $(this).val();
        if (countryID) {
            $.ajax({
                type: "GET",
                url: "{{url('get-ville-list')}}?pays=" + countryID,
                success: function(res) {
                    if (res) {
                        $("#state").empty();
                        $("#state").append('<option>Select</option>');
                        $.each(res, function(key, value) {
                            $("#state").append('<option value="' + key + '">' + value + '</option>');
                        });
                    } else {
                        $("#state").empty();
                    }
                }
            });
        } else {
            $("#state").empty();
        }
    });
</script>
<script>
    CKEDITOR.replace('antecedants_med');
    CKEDITOR.replace('antecedants_chirg');
    CKEDITOR.replace('antecedants_fam');
    CKEDITOR.replace('allergies');
    CKEDITOR.replace('indicateur_bio');
    CKEDITOR.replace('traitement_chr');
</script>
<script>
    $(document).ready(function() {
        $('#myTable').dataTable();
    });

    function deleteData(id) {
        var id = id;
        var url = '{{route("coordinateurChef.dossier.deleteFile",":id")}}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit() {
        $("#deleteForm").submit();
    }
</script>
</section>
</div>
</div>
</div>
@endsection