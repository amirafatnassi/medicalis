<html>
<head>
 <link href="{{asset('app-assets/datatable/datatables.min.css')}}" rel="stylesheet" />
 <link href="{{asset('app-assets/datatable/dataTables.checkboxes.css')}}" rel="stylesheet" />
</head>
<body>
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>Nom & Prenom</th>
                <th>Specialite</th>
                <th>Pays</th>
                <th>Ville</th>
                <th>Pays</th>
            </tr>
        </thead>
        <tbody>
        @foreach($listmedecins as $a)
            <tr>
                <td></td>
                <td>{{$a->nom}} {{$a->prenom}}</td>
                <td>{{$a->specialite}}</td>
                <td>{{$a->pays}}</td>
                <td>{{$a->ville}}</td>
                <td>{{$a->email}}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Nom & Prenom</th>
                <th>Specialite</th>
                <th>Pays</th>
                <th>Ville</th>
                <th>Pays</th>
            </tr>
        </tfoot>
    </table>

	<script src="{{asset('app-assets/datatable/datatables.min.js')}}"></script>
	<script src="{{asset('app-assets/datatable/dataTables.checkboxes.min.js')}}"></script>
	 
	 

<script type="text/javascript">
   $(document).ready(function() {
   var table = $('#example').DataTable({
      'columnDefs': [
         {
            'targets': 0,
            'checkboxes': true
         }
      ],
      'order': [[1, 'asc']]
   });
});
</script>
	</body>
	
</html>