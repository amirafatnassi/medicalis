@extends('layouat.layaoutMedecin')
@section('contenu')

<div class="card">
    <div class="card-header">
        <div class="col-3 card-title">Antécédants</div>
        <div class="col-3"><a href="{{url('medecin/'.$dossier->id.'/listeSupprimer')}}" class="btn btn-primary">Liste des antécédants Supprimé</a>&nbsp;</div>
        <div class="col-6">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                </div>
                <input type="text" class="form-control" id="myInput1" onkeyup="myFunction1()" placeholder="Rechercher effet marquant selon date.." title="Type in a name">
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Motif</th>
                    <th>Médecin</th>
                    <th>Date</th>
                    <th>Antécédant</th>
                    <th>Pièces jointes</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consultations as $consultation)
                <tr>
                    <td><a href="{{url('medecin/consultation/'.$consultation->id.'/show')}}" class="btn btn-primary">ID:{{$consultation->id}}</a></td>
                    <td>{{$consultation->Motif->lib}}</td>
                    <td>@if($consultation->medecin){{$consultation->medecin->prenom}} {{$consultation->medecin->nom}}@endif</td>
                    <td>{{date('d/m/Y',strtotime($consultation->date))}}</td>
                    <td>{{$consultation->effet_marquant_txt}}</td>
                    <td>
                        @if($consultation->files->count()!=0)
                        <a href="{{url('medecin/consultation/showExamenfiles/'.$consultation->id)}}">
                            <i data-feather="paperclip"></i>
                        </a>
                        @endif
                    </td>
                    <td>
                        <form style="display:inline" method="post" action="{{url('medecin/'.$consultation->id.'/effetsmarquants/delete')}}">{{csrf_field()}} {{method_field('DELETE')}}
                            <button class="btn btn-danger" type="submit">
                                <i data-feather="trash-2"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
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
@endsection