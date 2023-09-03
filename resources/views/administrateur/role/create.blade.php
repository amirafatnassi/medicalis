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
            <section id="dashboard-ecommerce">

                <form method="POST" action="{{url('administrateur/role/store')}}"> {{csrf_field()}}
                    <div class="row">
                        <div class="col-12">
                            <h5 class="blueLabel">
                                <center><u>Nouveau Role</center></u>
                            </h5>
                        </div>

                        <div class="col-12">
                            <label for="lib"><b class="blueLabel">Libelle:</b></label>
                            <input class="form-control" name="lib" id="lib">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" hidden>
                                Le libelle est obligatoire !
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-block btn-primary" type="submit" id="b_submit">
                                <i data-feather="save" class="mr-1"></i>
                                Enregistrer
                            </button>
                        </div>
                    </div>
                </form>
                <script>
                    var b_submit = document.getElementById("b_submit");
                    var lib = document.getElementById("lib");
                    var msg = document.getElementById("msg");
                    b_submit.addEventListener('click', valider);

                    function valider(e) {
                        if (lib.value == '') {
                            e.preventDefault();
                            msg.hidden = false;
                        } else {
                            msg.hidden = true;
                        }
                    }
                </script>
            </section>
            <!-- Dashboard Ecommerce ends -->
@endsection