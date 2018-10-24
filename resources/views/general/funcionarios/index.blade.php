@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('head')
    {!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">
            @include('components.messages')
        </div>
        
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lista de Funcionários Cadastradas</h5>
                    <div class="ibox-tools">

                        <a href="instituicao/1" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> </a>

                        <a href="/funcionarios/pdf" class="btn btn-info btn-sm a-color-white"><i class="fa fa-file-pdf-o"></i> </a>                                                
                       
                        <a href="/admin/funcionario/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> </a>
                    </div>
                </div>

                <div class="ibox-content">

                <div class="table-responsive">
                    
                    <table class="table table-striped table-bordered table-hover dataTables-example" >

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>B.I</th>
                                <th>Genero</th>
                                <th>Função</th>
                                <th>Contactos</th>
                                <th>Endereco</th>
                                <th>Acção</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($funcionarios as $funcionario)
                            <tr class="gradeX">
                                <td>
                                    <a href="#">
                                        <img alt="image" class="img-square img-td" src="/img/funcionarios/{{ $funcionario->foto }}">
                                    </a>
                                </td>
                                <td>
                                {{ $funcionario->nome }}
                                </td>
                                <td>
                                {{ $funcionario->bi }}
                                </td>

                                <td><span class="label label-info">{{ $funcionario->genero }}</span></td>

                                <td><span class="label label-primary">{{ $funcionario->cargo }}</span></td>
                                
                                <td>
                                    {{ $funcionario->contacto->telefone }} 
                                    {{ $funcionario->contacto->email }} 
                                    {{ $funcionario->contacto->redes_sociais }}</td>
                                <td>
                                {{ $funcionario->endereco->municipio->provincia->nome }} -
                                {{ $funcionario->endereco->municipio->nome }} |
                                {{ $funcionario->endereco->bairro }}
                                 {{ $funcionario->endereco->rua }}
                                </td>
                                <td>
                               
                                    <a href="{{ route('funcionario.show', $funcionario->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> </a>
                               
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>B.I</th>
                                <th>Genero</th>
                                <th>Função</th>
                                <th>Contactos</th>
                                <th>Endereco</th>
                                <th>Acção</th>
                            </tr>
                        </tfoot>

                    </table>

                </div>

                </div>
            </div>

        </div>
        
    </div>

@endsection

@section('scripts')

{!! Html::script('js/plugins/dataTables/datatables.min.js') !!}

<!-- Page-Level Scripts -->
<script>
       $(document).ready(function(){
           $('.dataTables-example').DataTable({
               pageLength: 25,
               responsive: true,
               dom: '<"html5buttons"B>lTfgitp',
               buttons: [
                   { extend: 'copy'},
                   {extend: 'csv'},
                   {extend: 'excel', title: 'ExampleFile'},
                   {extend: 'pdf', title: 'ExampleFile'},

                   {extend: 'print',
                    customize: function (win){
                           $(win.document.body).addClass('white-bg');
                           $(win.document.body).css('font-size', '10px');

                           $(win.document.body).find('table')
                                   .addClass('compact')
                                   .css('font-size', 'inherit');
                   }
                   }
               ]

           });

       });

   </script>

@endsection