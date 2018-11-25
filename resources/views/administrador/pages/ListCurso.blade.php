@extends("Administrador.main")
@section("title"," Lista de cursos")

@section("head")
{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
{!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}
@endsection

@section("content")

<div class="row">
<div class="col-md-8 col-md-offset-2">
                @include('components.messages')
    </div>
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
                                        <th>Acção </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   <?php for ($i=0; $i <count($Curso) ; $i++) { ?>
                                    <tr>
                                        <td><?=$Curso[$i]->nome?></td>
                                        <td><?=$Curso[$i]->abreviacao?></td>
                                        <td> 
                                            <a class="btn btn-danger drop-curso"  data-id="{{$Curso[$i]->id}}"  data-nome="{{$Curso[$i]->nome}}">
                                                <i class="fa fa-close"></i>  Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
        </div>
    </div>
                        
</div>

<div data-backdrop="static" class="modal inmodal" id="drop-curso" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content animated bounceInRight">

            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h5 class="modal-title">Tens certeza do que Queres Excluir?</h5>
                    <small class="font-bold">
                        Ao eliminares este curso de <strong id="drop-span">dd</strong> todos os dados associados a 
                        ela serão excluídos (incluí turmas/alunos, e outros dados associados a
                        matricula/confirmação como  as propinas dos alunos desse curso).
                    </small>
                </div>
                <div class="modal-body">

                    <div class="row">

                        {!! Form::open(['method'=>'DELETE']) !!}
                        <button type="submit" class="col-sm-12 btn btn-danger margem"> <strong>Sim tenho</strong></button>
                        {!! Form::close() !!}

                        <button type="button" class="col-sm-12 btn btn-white mg-top-20" data-dismiss="modal"><strong>Não tenho</strong></button>
                        
                    </div>

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
      $(".drop-curso").click(function()
      {
        var url = "{{ url('/Administrador/cadastrar-curso') }}/"+$(this).data('id');
        $("#drop-curso form").attr("action", url);
        $("#drop-span").text($(this).data("nome"));
        
        $("#drop-curso").modal("show");
          
      })
      
      $('.data-table-grid').DataTable({
          pageLength: 5,
          responsive: true,
          dom: '<"html5buttons"B>lTfgitp',
          buttons: [
              {extend: 'excel', title: 'ExampleFile'}
             

              
          ]

      });

  });
</script>

@endsection