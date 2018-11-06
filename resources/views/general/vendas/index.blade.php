@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('head')
    {!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
    {!! Html::style('css/plugins/datapicker/datepicker3.css') !!}   
    
@endsection

@section('page-heading')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Vendas</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index-2.html">Admin</a>
            </li>
            <li>
                <a>Vendas</a>
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
                    <h5>Lista de Vendas</h5>
                    <div class="ibox-tools">

                        <a href="" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> </a>

                        <a href="#" data-toggle="modal" data-target="#relatorioModal" class="btn btn-info btn-sm a-color-white"><i class="fa fa-file-pdf-o"></i> </a>                                                
                       
                        <a href="/admin/vendas/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> </a>
                    </div>
                </div>

                <div class="ibox-content">

                <div class="table-responsive">
                    
                    <table class="table table-striped table-bordered table-hover dataTables-example" >

                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Preço Total</th>
                                <th>Desconto</th>
                                <th>Total Pago</th>
                                <th>Forma de Pagamento</th>
                                <th>Estado</th>
                                <th>Data de Compra</th>
                                <th>Acção</th>
                            </tr>
                        </thead>
                        
                        <tbody>

                         @php
                            $i=1
                        @endphp

                            @foreach($vendas as $venda)
                            <tr class="gradeX">

                                <td>{{ $i++ }}</td>
                            
                                <td>
                                <span class="label label-info">{{ $venda->total }}.00  kz</span>
                                </td>

                                <td>
                                    {{ $venda->desconto }}.00 kz
                                </td>

                                <td>
                                <span class="label label-success">{{ $venda->pagamento  }} kz</span>
                                    
                                </td>

                                <td>
                                    {{ $venda->forma_pagamento }}
                                </td>

                                <td>
                                <span class="label label-warning">{{ $venda->estado  }}</span>
                                    
                                </td>

                                <td>
                                    {{ $venda->created_at }}
                                </td>
                               
                                <td>
                                    <a href="/admin/vendas/{{$venda->id}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>

                        <tfoot>
                            <tr>
                            <th>Nº</th>
                                <th>Preço Total</th>
                                <th>Desconto</th>
                                <th>Total Pago</th>
                                <th>Forma de Pagamento</th>
                                <th>Estado</th>
                                <th>Data de Compra</th>
                                <th>Acção</th>
                            </tr>
                        </tfoot>

                    </table>

                </div>

                </div>
            </div>

        </div>
        
    </div>

    
     <!--Relatorio modal-->

     <div class="modal inmodal" id="relatorioModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
        {!! Form::open(array('route' => 'vendas.pdf')) !!}   
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-laptop modal-icon"></i>
                    <h4 class="modal-title">Gerar Relatório</h4>
                    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                </div>
                <div class="modal-body">
            
                    <div class="form-group" id="data_5">
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="form-control" name="start" value="2018-02-22"/>
                            <span class="input-group-addon">à</span>
                            <input type="text" class="form-control" name="end" value="2018-02-22" />
                        </div>
                    </div>
               
               
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Visualizar</button>
                </div>
        {!! Form::close() !!} 
            </div>
        </div>
    </div>

@endsection

@section('scripts')

{!! Html::script('js/plugins/dataTables/datatables.min.js') !!}
{!! Html::script('js/plugins/datapicker/bootstrap-datepicker.js') !!}   


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

          $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "yyyy-mm-dd"
            });

   </script>

@endsection