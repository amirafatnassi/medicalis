@extends('menus.layoutAdmin')
@section('contenu')
    <div class="row">
        <div class="col-6">
            <h5></h5>
        </div>
        <div class="col-6">
            <div class="input-group input-group-merge">  
            </div>
        </div>
    </div>
            <!-- Dashboard Ecommerce Starts -->
            <section lib="dashboard-ecommerce">
                <form method="post" action="{{url('administrateur/role/update/'.$liste_Role->id)}}" enctype="multipart/form-data"> @csrf
                    <div class="col-12">
                        <label for="id"><b>ID: </b></label>
                        <input class="form-control" name="id" id="id" type="text" placeholder="" value="{{old('id',$liste_Role->id ?? null)}}">
                    </div>
                    <div class="col-12">
                        <label for="lib"><b>Libelle: </b></label>
                        <input class="form-control" name="lib" id="lib" type="text" placeholder="" value="{{old('lib',$liste_Role->lib ?? null)}}">
                    </div>
                    <div class=" d-grid gap-2 col-12 mx-auto">
                        <button class="btn btn-block btn-primary" type="submit"> <i data-feather="save" class="mr-1"></i>Enregistrer les modifications</button>
                    </div>
                </form>
            </section>
            <!-- Dashboard Ecommerce ends -->

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection