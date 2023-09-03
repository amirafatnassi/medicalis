@extends('layouat.layaoutPatient')
@section('contenu')
<div class="card">
    <div class="card-header row">
        <div class="card-title col-3">Liste d'examens bio</div>
        <div class="col-3"><a href="{{url('patient/examenbios/create')}}" class="btn btn-outline-primary">Nouveau Examen Bio</a></div>
        <div class="col-6">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                </div>
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher examen bio" aria-label="Search..." aria-describedby="email-search" />
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Médecin</th>
                    <th>Spécialité</th>
                    <th>Pièces jointes <i data-feather="paperclip"></i></th>
                    <th>Remarques</th>
                </tr>
            </thead>
            <tbody>
                @foreach($liste_examenbios as $examenbio)
                <tr>
                    <td><a href="{{url('patient/examenbios/'.$examenbio->id.'/show')}}" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true">{{$examenbio->id}}</a></td>
                    <td>{{date('d/m/Y',strtotime($examenbio->date))}}</td>
                    <td>
                        @if($examenbio->id_medecin)
                        {{$examenbio->medecin->prenom}} {{$examenbio->medecin->nom}}
                        @endif
                    </td>
                    <td>
                        @if($examenbio->id_medecin && $examenbio->medecin->Specialite)
                        {{$examenbio->medecin->Specialite->lib}}
                        @endif
                    </td>
                    <td>
                        @if($examenbio->files->count()>0)
                        <a href="{{url('patient/examenbios/showExamenbioFiles/'.$examenbio->id)}}"> <i data-feather="paperclip"></i></a>
                        @endif
                    </td>
                    <td>
                        @if(!is_null($examenbio->remarques))
                        <h5><a href="#" class="badge badge-danger">{{$examenbio->remarques}}</a></h5>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>