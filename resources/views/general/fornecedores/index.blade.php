@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('head')
    {!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
@endsection

@section('page-heading')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Fornecedores</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index-2.html">Admin</a>
            </li>
            <li>
                <a>Fornecedor</a>
            </li>
            <li class="active">
                <strong>Lista</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">
            @include('components.messages')
        </div>
        
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lista de Fornecedores Cadastradas</h5>
                    <div class="ibox-tools">

                        <a href="instituicao/1" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> </a>

                        <a href="/fornecedores/pdf" class="btn btn-info btn-sm a-color-white"><i class="fa fa-file-pdf-o"></i> </a>                                                
                       
                        <a href="/admin/fornecedor/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> </a>
                    </div>
                </div>

                <div class="ibox-content">

                <div class="table-responsive">
                    
                     <table class="table table-striped table-bordered table-hover dataTables-example" >

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Contactos</th>
                                <th>Província/Munícipio</th>
                                <th>Bairro/Rua</th>
                                <th>Acção</th>
                            </tr>
                        </thead>

                        @php
                            $i=1
                        @endphp
                        
                        <tbody>
                            @foreach($fornecedores as $fornecedor)
                            <tr class="gradeX">
                                
                                <td>{{ $i++ }}</td>

                                <td>
                                <span class="label label-info">{{ $fornecedor->nome }}</span>
                                </td>
                                <td>
                                {{ $fornecedor->descricao }}
                                </td>

                                <td>
                                    {{ $fornecedor->contacto->telefone }} 
                                    {{ $fornecedor->contacto->email }} 
                                    {{ $fornecedor->contacto->redes_sociais }}
                                </td>
                                <td>
                                {{ $fornecedor->endereco->municipio->provincia->nome }} -
                                {{ $fornecedor->endereco->municipio->nome }} 
                                </td>  
                                <td>
                                {{ $fornecedor->endereco->bairro }}
                                {{ $fornecedor->endereco->rua }}
                                </td>
                                <td>
                               
                                    <a href="{{ route('fornecedor.show', $fornecedor->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> </a>
                               
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Contactos</th>
                                <th>Província/Munícipio</th>
                                <th>Bairro/Rua</th>
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