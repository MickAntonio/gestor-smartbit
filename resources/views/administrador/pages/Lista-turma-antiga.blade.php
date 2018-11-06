@extends("Administrador.main")
@section("title"," Lista de Turmas")

@section("head")
{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
{!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}
@endsection

@section("content")

<div class="row">
    <div class="col-md-12">
                @include('components.messages')
    </div>
<div class="ibox float-e-margins col-md-10 col-md-offset-1">
                        <div class="ibox-title">
                            <h5>LISTA DAS TURMAS</h5>
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
    <div class="row">
        <div class="col-sm-9 m-b-xs">
            <div data-toggle="" class="btn-group">
            <label class="btn btn-sm btn-white"> <a href="{{ route('ListClass') }}" class="">Turmais actuais</a> </label>
            </div>
                                </div>
                            </div>
                                 <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover data-table-grid">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Quantidade </th>
                                        <th>Periodo</th>
                                        <th>Classe </th>
                                        <th>Curso</th>
                                        <th>Ano Lectivo </th>
                                        <th>Acção</th>
                                        <th>Acção</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   <?php for ($i=0; $i <count($Turma) ; $i++) { ?>
                                    <tr>
                                        <td>{{ $Turma[$i]->nome }}</td>
                                        <td>{{ $Turma[$i]->Quantidade }}</td>
                                        <td>{{ $Turma[$i]->periodo }}</td>
                                        <td>{{ $Turma[$i]->classe()->get()[0]->nome }}</td>
                                        <td>{{ $Turma[$i]->curso()->get()[0]->nome }}</td>
                                        <td>{{ $Turma[$i]->anolectivo }}</td>
                                        <td><a href="#" class="btn btn-success" >Editar</a></td>
                                        <td>
                                        <a data-id="{{ $Turma[$i]->id }}" class="btn btn-danger Eliminar" >  Eliminar</a></td>

                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
        </div>
    </div>

    <div class="modal inmodal" id="ExcluirModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content animated bounceInRight">

            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h5 class="modal-title">Tens certeza que Pretendes Excluir?</h5>
                    <small class="font-bold">
                        Ao Excluíres está turma todos os dados associados a 
                        ela serão excluídos (incluí matriculas/confirmações, e outros dados associados a
                        matricula/confirmação como  a propinas dos alunos dessa turma).
                    </small>
                </div>
                <div class="modal-body">

                    <div class="row">

                        {!! Form::open(['method'=>'DELETE']) !!}
                        <button type="submit" class="col-sm-12 btn btn-primary"> <strong>Sim Tenho</strong></button>
                        {!! Form::close() !!}

                        <button type="button" class="col-sm-12 btn btn-white mg-top-20" data-dismiss="modal"><strong>Cancelar</strong></button>
                        
                    </div>

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

$(function()
{
    $(".Eliminar").click(function()
    {
        $("#ExcluirModal").modal("show");
        var url = "{{ url('/Administrador/criar-turma') }}/"+$(this).data('id');

        $("#ExcluirModal form").attr("action", url);
    });
})

</script>

@endsection