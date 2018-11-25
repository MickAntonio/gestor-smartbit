@extends("Administrador.main")
@section("title","Lista de alunos sem turma")

@section("head")
{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
{!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}
@endsection

@section("content")
  
<div class="row">
            <div class="col-md-12">
                @include('components.messages')
            </div>
    <div class="container">
        <div class="row">
        
            <div class="col-md-12">
                
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><strong>LISTAS DE ALUNOS SEM TURMAS</strong></h5>
                        <div class="ibox-tools">                        

                            <a href="" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> </a>
                      
                        </div>

                    </div>
                    <div class="ibox-content">
                       
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover data-table-grid">
                                <thead>
                                <tr>

                                    <th>Nome </th>
                                    <th>classe</th>
                                    <th>periodo</th>
                                    <th>Curso</th>
                                    <th>Sexo</th>
                                    <th>Acção</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($matricula as $aluno)
                                    @if($aluno->turma()->get()[0]->estado =="ANONIMA")
                                    <tr>
                                        <td>{{ $aluno->aluno()->get()[0]->candidato()->get()[0]->nome?? "" }}</td>
                                        <td>{{ $aluno->turma()->get()[0]->classe()->get()[0]->nome?? "" }} </td>
                                        <td>{{ $aluno->turma()->get()[0]->periodo?? "" }} </td>
                                        <td>{{ $aluno->turma()->get()[0]->curso()->get()[0]->nome?? "" }} </td>
                                        <td>{{$aluno->aluno()->get()[0]->candidato()->get()[0]->sexo?? "" }} </td>
                                        <td>
                                            <a href="{{route('FichaAluno',$aluno->aluno()->get()[0]->candidato()->get()[0]->id?? '')}}"  class="btn btn-success btn-sm show-modal"  ><i class="fa fa-eye"></i> Ficha </a>
                                            <a class=" adds btn btn-primary btn-sm show-modal" data-processo="" data-periodo="{{ $aluno->turma()->get()[0]->periodo }}" data-idclasse="{{ $aluno->turma()->get()[0]->classe()->get()[0]->id }}" data-classe="{{ $aluno->turma()->get()[0]->classe()->get()[0]->nome }}" data-curso="{{ $aluno->turma()->get()[0]->curso()->get()[0]->nome }}" data-idcurso="{{ $aluno->turma()->get()[0]->curso()->get()[0]->id }}" data-idmatricula="{{ $aluno->id }}" data-nome="{{ $aluno->aluno()->get()[0]->candidato()->get()[0]->nome }}"  >
                                                <i class="fa fa-plus"></i> Adicionar
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

    </div>
 </div>

 <div class="modal inmodal" id="MatricularModal" tabindex="-1" role="dialog" aria-hidden="true">
            
            <div class="modal-dialog">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-desktop"></i>
                        <h4 class="modal-title">Matricula</h4><br>
                        <h4 class="alerta col-md-12"></h4>
                    </div>
                    
                    {!! Form::open(array('route' => 'AtribuirTurmaAluno')) !!}   
                    
                    <div class="modal-body">
    
                        <div class="row">
                            <input id="idaluno" readonly type="hidden" name="idaluno" class="form-control">                                
                          
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label><p>Nome</p></label> 
                                    <input id="nome" readonly type="text" name="nome" class="form-control">                                
                                </div>                            
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><p>Classe: </p></label> 
                                    <input  id="classe" readonly type="text" name="classe" class="form-control">                                
                                </div>                            
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label><p>Matricula-se no curso de:</p></label> 
                                    <select id="curso" readonly class="form-control"  tabindex="2" name="curso">
                                    </select>                       
                                </div>                            
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="Idperiodo">
                                    <p>Periodo escolhido:</p>
                                </label>
                                <input readonly class="form-control" name="periodo" id="Idperiodo">
                                               
                                </div>                            
                            </div>   
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><p>Turmas Disponiveis:</p></label> 
                                    <select required id="turma" class="form-control"  tabindex="2" name="turma">
                                     
                                    </select>
                                </div>                            
                            </div> 
                            
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Matricular</button>
                    </div>
    
                    {!! Form::close() !!} 
                    
                </div>
            </div>
@endsection

@section("scripts")

    {!! Html::script('js/plugins/dataTables/datatables.min.js') !!}
  
    {!! Html::script('js/plugins/chosen/chosen.jquery.js') !!}

    <script>
    // Data table
        $(document).ready(function(){
            $(".adds").click(function ()
            {
                $("#idaluno").val($(this).data("idmatricula"));
                $("#nome").val($(this).data("nome"));
                $("#curso").html('<option value="'+$(this).data("idcurso")+'">'+$(this).data("curso")+'</option>');
                $("#Idperiodo").val($(this).data("periodo"));
                $("#classe").val($(this).data("classe"));

                $.get("{{url('Administrador/json-turma')}}/"+$(this).data("idclasse")+"/"+$(this).data("idcurso"),{"classe":$(this).data("idclasse")},function(done)
                {
                    var texto = '';
                   
                    if(done.length<1)
                        $(".alerta").html('<strong class="alert alert-danger" role="alert">Não há turmas disponiveis para está classe</strong>');
                    else
                        $(".alerta").text("");
                       
                    for(i=0; i<done.length; i++)
                        texto += '<option value="'+done[i].id+'">'+done[i].nome+' -> '+done[i].periodo+' -> '+done[i].anolectivo+'</option>';
                    $("#turma").html(texto);

                },"Json")
                $("#MatricularModal").modal("show");
            })        


            $('.data-table-grid').DataTable({
                pageLength: 10,
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