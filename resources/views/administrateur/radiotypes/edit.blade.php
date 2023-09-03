@extends('menus.layoutAdmin')

@section('contenu')

<!-- BEGIN: Content-->

<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Ecommerce Starts -->
            <section lib="dashboard-ecommerce">
                <form method="post" action="{{url('administrateur/radiotypes/update/'.$radiotypes[0]->id)}}" enctype="multipart/form-data"> {{csrf_field()}}
                    <div class="col-12">
                        <label for="id"><b>ID: </b></label>
                        <input class="form-control" name="id" id="id" type="text" placeholder="" value="{{old('id',$radiotypes[0]->id ?? null)}}">
                    </div>
                    <div class="col-12">
                        <label for="lib"><b>Libelle: </b></label>
                        <input class="form-control" name="lib" id="lib" type="text" placeholder="" value="{{old('lib',$radiotypes[0]->lib ?? null)}}">
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