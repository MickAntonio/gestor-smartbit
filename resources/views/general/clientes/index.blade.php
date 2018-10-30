@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('head')
    {!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
@endsection

@section('page-heading')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Clientes</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Admin</a>
            </li>
            <li>
                <a>cliente</a>
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
                    <h5>Lista de Clientes Cadastrados</h5>
                    <div class="ibox-tools">

                        <a href="" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> </a>

                        <a href="/clientes/pdf" class="btn btn-info btn-sm a-color-white"><i class="fa fa-file-pdf-o"></i> </a>                        
                         
                        <a href="/admin/cliente/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> </a>
                    </div>
                </div>

                <div class="ibox-content">

                <div class="table-responsive">
                    
                    <table class="table table-striped table-bordered table-hover dataTables-example" >

                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Nome</th>
                                <th>B.I</th>
                                <th>Data Nascimento</th>
                                <th>Genero</th>
                                <th>Contactos</th>
                                <th>Acção</th>
                            </tr>
                        </thead>

                        @php
                            $i=1
                        @endphp
                        
                        <tbody>
                            @foreach($clientes as $cliente)
                            <tr class="gradeX">
                              
                                <td>{{ $i++ }}</td>
                              
                                <td>
                                {{ $cliente->nome }}
                                </td>
                                <td>
                                {{ $cliente->bi }}
                                </td>

                                <td>
                                {{ $cliente->data_nascimento }}
                                </td>

                                <td><span class="label label-info">{{ $cliente->genero }}</span></td>

                                <td>
                                    {{ $cliente->contacto->telefone }} 
                                    {{ $cliente->contacto->email }} 
                                    {{ $cliente->contacto->redes_sociais }}
                                </td>
                               
                                <td>
                               
                                    <a href="{{ route('cliente.show', $cliente->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> </a>
                               
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>Nº</th>
                                <th>Nome</th>
                                <th>B.I</th>
                                <th>Data Nascimento</th>
                                <th>Contactos</th>
                                <th>Genero</th>
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
                   {extend: 'excel', title: 'Clientes'},
                   {extend: 'pdf', title: 'Clientes'},

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