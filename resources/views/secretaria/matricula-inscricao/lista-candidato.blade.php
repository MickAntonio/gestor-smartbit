@extends("secretaria.main")
@section("title","Formulário de Matricula")

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
                        <h5>Lista de Alunos</h5>
                        <div class="ibox-tools">                        

                            <a href="" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> </a>

                            <a href="/servicos/pdf" class="btn btn-info btn-sm a-color-white"><i class="fa fa-file-pdf-o"></i> </a>                        

                            <a href="#" data-toggle="modal" data-target="#adicionarModal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> </a>
                      
                        </div>

                    </div>
                    <div class="ibox-content">
                       
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover data-table-grid">
                                <thead>
                                <tr>

                                    <th>Nº</th>
                                    <th>Nome </th>
                                    <th>Sexo </th>
                                    <th>B.I</th>
                                    <th>Curso</th>
                                    <th>Telefone do pai</th>
                                    <th>Idade</th>
                                    <th>Acção</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($candidato as $candidatos)
                                    @if(!isset($candidato->find($candidatos->id)->aluno()->get()[0]->matricula()->get()[0]))
                                    <tr>
                                        <td>{{ $candidatos->id }}</td>
                                        <td>{{ $candidatos->nome }}</td>
                                        <td>{{ $candidatos->sexo }}</td>
                                        <td>{{ $candidatos->bi }}</td>
                                        <td>{{ $candidatos->find($candidatos->id)->aluno()->get()[0]->curso()->get()[0]->nome?? " Nothing" }}</td>
                                        <td>{{ $candidatos->telefone }}</td>
                                        <td>{{$candidatos->nascido}}</td>
                                        <td>
                                        <a  class="btn btn-success btn-sm show-modal"  ><i class="fa fa-eye"></i> </a>
                                        <a class=" adds btn btn-primary btn-sm show-modal" data-idaluno="{{ $candidatos->find($candidatos->id)->aluno()->get()[0]->id }}" data-idcandidato="{{ $candidatos->id }}" data-nome="{{ $candidatos->nome }}" data-idcurso="{{$candidatos->find($candidatos->id)->aluno()->get()[0]->curso()->get()[0]->id}}" data-curso="{{$candidatos->find($candidatos->id)->aluno()->get()[0]->curso()->get()[0]->nome}}"  ><i class="fa fa-plus"></i> </a>
                                        <a class="btn btn-primary btn-sm show-modal"  ><i class="fa fa-pencil"></i> </a>
                                        <a class="btn btn-danger btn-sm show-modal"  ><i class="fa fa-close"></i> </a>
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
                        <i class="fa fa-desktop modal-icon"></i>
    
                        <h4 class="modal-title">Matricula</h4>
                    </div>
                    
                    {!! Form::open(array('route' => 'MatriculaAnonima')) !!}   
                    
                    <div class="modal-body">
    
                        <div class="row">
    
                            <div class="col-md-12">
                                @include('components.messages')
                            </div>
                            <input id="idaluno" readonly type="hidden" name="idaluno" class="form-control">                                
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nome</label> 
                                    <input id="nome" readonly type="text" name="nome" class="form-control">                                
                                </div>                            
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Matricula-se no curso de:</label> 
                                    <select id="curso" readonly class="form-control"  tabindex="2" name="curso">
                                     
                                    </select>                             
                                </div>                            
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Classe</label> 
                                    <select id="classe" class="form-control"  tabindex="2" name="classe">
                                     @foreach($classe as $c) 
                                        <option value="{{ $c->id }}"> {{ $c->nome }}</option>
                                    @endforeach
                                    </select>
                                </div>                            
                            </div> 
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="IdPeriodo">
                                    <p>Periodo</p>
                                </label>
                                <select required class="form-control" name="periodo" id="IdPeriodo">
                                    <option disabled selected>Selecione:</option>
                                    <option value="Manhã">Manhã</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Noite">Noite</option>
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
                $("#idcandidato").val($(this).data("idcandidato"));
                $("#idaluno").val($(this).data("idaluno"));
                $("#nome").val($(this).data("nome"));
                $("#curso").html('<option value="'+$(this).data("idcurso")+'">'+$(this).data("curso")+'</option>');
                $("#MatricularModal").modal("show");
            })        


            $('.data-table-grid').DataTable({
                pageLength: 25,
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