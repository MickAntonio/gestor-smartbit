@extends("Administrador.main")
@section("title"," Lista de cursos")

@section("head")
{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
{!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}
@endsection

@section("content")

<div class="row">
<div class="ibox float-e-margins col-md-8 col-md-offset-2">
                        <div class="ibox-title">
                            <h5>LISTA DOS CURSOS</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                              
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
<div class="ibox-content">

                    <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover data-table-grid"">
                                    <thead>
                                    <tr>
                                        <th>Curso</th>
                                        <th>Abreviação </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   <?php for ($i=0; $i <count($Curso) ; $i++) { ?>
                                    <tr>
                                        <td><?=$Curso[$i]->nome?></td>
                                        <td><?=$Curso[$i]->Abreviacao?></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
        </div>
    </div>
                        
</div>
@endsection

@section("scripts")

{!! Html::script('js/plugins/dataTables/datatables.min.js') !!}

{!! Html::script('js/plugins/chosen/chosen.jquery.js') !!}

<script>
// Data table
  $(document).ready(function(){
      
      $('.data-table-grid').DataTable({
          pageLength: 5,
          responsive: true,
          dom: '<"html5buttons"B>lTfgitp',
          buttons: [
              { extend: 'copy'},
              {extend: 'csv'},
              {extend: 'excel', title: 'ExampleFile'}
             

              
          ]

      });

  });
</script>

@endsection