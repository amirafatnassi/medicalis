@extends('layouat.layoutAdmin')

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
            <section id="dashboard-ecommerce">
                <ul class="timeline">
                    <li class="list-group-item"><b>ID: </b>{{$specialite[0]->id}}</li>
                    <li class="list-group-item"><b>Libelle: </b>{{$specialite[0]->lib}}</li>
                </ul>
            </section>
            <!-- Dashboard Ecommerce ends -->
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection