@extends("secretaria.main")
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
                                            <a href="{{route('ReciboMatricula',$aluno->aluno->candidato_id)}}"  class="btn btn-primary btn-sm"  ><i class="fa fa-eye"></i> Recibo de inscrição </a>
                                            <a href="{{route('FichaAluno',$aluno->aluno()->get()[0]->candidato()->get()[0]->id?? '')}}"  class="btn btn-success btn-sm show-modal"  ><i class="fa fa-eye"></i> Ficha </a>
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

 
@endsection

@section("scripts")

    {!! Html::script('js/plugins/dataTables/datatables.min.js') !!}
  
    {!! Html::script('js/plugins/chosen/chosen.jquery.js') !!}

    <script>
    // Data table
        $(document).ready(function(){
            $('.data-table-grid').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'excel', title: 'alunos-matriculados-sem-turma'}
                   

                    
                ]

            });

        });
    </script>
@endsection