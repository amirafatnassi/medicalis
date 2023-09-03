@extends('menus.layoutCoordinateurChef')
@section('contenu')


<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Account Settings</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Pages</a>
                            </li>
                            <li class="breadcrumb-item active"> Account Settings
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- account setting page -->
        <section id="page-account-settings">
            <div class="row">
                <!-- left menu section -->
                <div class="col-md-3 mb-2 mb-md-0">
                    <ul class="nav nav-pills flex-column nav-left">
                        <!-- general -->
                        <li class="nav-item">
                            <a class="nav-link active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                <i data-feather="user" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">Convention</span>
                            </a>
                        </li>
                        <!-- change password -->
                        <li class="nav-item">
                            <a class="nav-link" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                <i data-feather="lock" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">General</span>
                            </a>
                        </li>
                        <!-- information -->
                        <li class="nav-item">
                            <a class="nav-link" id="account-pill-info" data-toggle="pill" href="#account-vertical-info" aria-expanded="false">
                                <i data-feather="info" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">Détails patient</span>
                            </a>
                        </li>
                        <!-- social -->
                        <li class="nav-item">
                            <a class="nav-link" id="account-pill-social" data-toggle="pill" href="#account-vertical-social" aria-expanded="false">
                                <i data-feather="link" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">Social</span>
                            </a>
                        </li>
                        <!-- notification -->
                        <li class="nav-item">
                            <a class="nav-link" id="account-pill-notifications" data-toggle="pill" href="#account-vertical-notifications" aria-expanded="false">
                                <i data-feather="bell" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">Notifications</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!--/ left menu section -->

                <!-- right content section -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- general tab -->
                                <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                    <!-- header media -->
                                   
                                    <!--/ header media -->

                                    <!-- form -->
                                   
                                    <!--/ form -->
                                </div>
                                <!--/ general tab -->

                                <!-- change password -->
                                <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                    <!-- form -->
                                  
                                    <!--/ form -->
                                </div>
                                <!--/ change password -->

                                <!-- information -->
                                <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                    <!-- form -->
                                   
                                    <!--/ form -->
                                </div>
                                <!--/ information -->

                                <!-- social -->
                                <div class="tab-pane fade" id="account-vertical-social" role="tabpanel" aria-labelledby="account-pill-social" aria-expanded="false">
                                    <!-- form -->
                                    <form class="validate-form">
                                      
                                    </form>
                                    <!--/ form -->
                                </div>
                                <!--/ social -->

                                <!-- notifications -->
                                <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel" aria-labelledby="account-pill-notifications" aria-expanded="false">
                                    <div class="row">
                                        <h6 class="section-label mx-1 mb-2">Activity</h6>
                                        <div class="col-12 mb-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" checked id="accountSwitch1" />
                                                <label class="custom-control-label" for="accountSwitch1">
                                                    Email me when someone comments onmy article
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" checked id="accountSwitch2" />
                                                <label class="custom-control-label" for="accountSwitch2">
                                                    Email me when someone answers on my form
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="accountSwitch3" />
                                                <label class="custom-control-label" for="accountSwitch3">Email me hen someone follows me</label>
                                            </div>
                                        </div>
                                        <h6 class="section-label mx-1 mt-2">Application</h6>
                                        <div class="col-12 mt-1 mb-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" checked id="accountSwitch4" />
                                                <label class="custom-control-label" for="accountSwitch4">News and announcements</label>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" checked id="accountSwitch6" />
                                                <label class="custom-control-label" for="accountSwitch6">Weekly product updates</label>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-75">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="accountSwitch5" />
                                                <label class="custom-control-label" for="accountSwitch5">Weekly blog digest</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                                <!--/ notifications -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ right content section -->
            </div>
        </section>
        <!-- / account setting page -->

    </div>
</div>
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
                        $("#state").append('<option value="">Selectionnez votre ville</option>');
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

@endsection