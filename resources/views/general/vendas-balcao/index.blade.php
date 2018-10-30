@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('head')
    {!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
    {!! Html::style('css/plugins/chosen/bootstrap-chosen-2.css') !!}
    
@endsection

@section('page-heading')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Vendas de Produtos</h2>
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
        
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lista de Retirados</h5>
                    <div class="ibox-tools">

                        <a href="" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> </a>
                       
                        <a class="btn btn-primary btn-sm adicionar-venda-modal"><i class="fa fa-plus"></i> </a>
                    </div>
                </div>

                <div class="ibox-content">

                <div class="table-responsive">
                    
                    <table class="table table-striped table-bordered table-hover dataTables-example" >

                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Produto</th>
                                <th>Variação/Qtde</th>
                                <th>Total</th>
                                <th>Desconto</th>
                                <th>Pagamento</th>
                                <th>Forma Pagamento</th>
                                <th>Data</th>
                                <th>Acção</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr class="gradeX">
                                <td>
                                    1
                                </td>
                                <td>
                                    Luvas de Cargo
                                </td>

                                <td>
                                    <span class="label label-primary">5</span>
                                </td>

                                <td>
                                    1500.00 kz
                                </td>

                                <td>
                                    230.0kz
                                </td>

                                <td>
                                    1270.0kz
                                </td>

                                <td>
                                   Dinheiro
                                </td>

                                <td>
                                   20-03-2018
                                </td>
                                
                                <td>
                                    <a href="#" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> </a>
                                </td>
                            </tr>
                            
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>Nº</th>
                                <th>Produto</th>
                                <th>Variação/Qtde</th>
                                <th>Total</th>
                                <th>Desconto</th>
                                <th>Pagamento</th>
                                <th>Forma Pagamento</th>
                                <th>Data</th>
                                <th>Acção</th>
                            </tr>
                        </tfoot>

                    </table>

                </div>

                </div>
            </div>

        </div>
        
    </div>

     <div class="modal inmodal" id="adicionarVendaModal" tabindex="-1" role="dialog" aria-hidden="true">
            
            <div class="modal-dialog modal-super-lg">
                <div class="modal-content animated bounceInRight">
                    
    
                        <div class="row">
    
                            <div class="col-md-12">
                                @include('components.messages')

                            <div class="col-md-7">

                                <div class="col-md-12 form-horizontal">
                                
                                    <div class="form-group" style="padding:12px;">
                                        <h2>LOCALIZE O PRODUTO INFORMANDO O NOME</h2> 
                                        <select class="chosen-select2 form-control produto"  tabindex="2" name="produto">
                                                                                            
                                        @foreach($produtos as $produto)
                                            <option value="{{ $produto->id }}">{{$produto->nome }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                </div>
                                

                                <div class="col-md-3">

                                </div>

                                <div class="col-md-9 form-horizontal">

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">CÓDIGO</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="codigo" disabled value="00" class="form-control-costum">
                                        </div>
                                    </div>

                                    <input type="hidden" name="prodId" value="" >
                                    <input type="hidden" name="prodNome" value="" >
                                    

                                    <div class="form-group"><label class="col-sm-4 control-label">QUANTIDADE</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="qtd" value="00" class="form-control-costum">
                                        </div>
                                    </div>

                                     <div class="form-group"><label class="col-sm-4 control-label">VALOR UNITÁRIO</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="preco_unitario" value="00.00" disabled class="form-control-costum">
                                        </div>
                                    </div>

                                     <div class="form-group"><label class="col-sm-4 control-label">DESCONTO</label>
                                        <div class="col-sm-8">
                                            <input type="number" value="00.00" name="desconto" class="form-control-costum">
                                        </div>
                                    </div>

                                     <div class="form-group"><label class="col-sm-4 control-label">VALOR TOTAL</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="total" value="00.00" disabled class="form-control-costum">
                                        </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-4 control-label"></label>
                                        <div class="col-sm-8">
                                            
                                            <button type="button" class="btn btn-primary btn-adicionar-produto btn-block" style="font-size:20px!important;"><i class="fa fa-plus"></i> <strong>ADICIONAR PRODUTO </strong></button>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>

                            <div class="col-md-5">
                                <div class="alert alert-warning mg-top-30" role="alert">
                                    <strong>CLIENTE: <u>AO CONSUMIDOR</u></strong> 
                                    <br>
                                    <strong>VENDEDOR: <u>USUARIO ADMIN</u></strong> 
                                </div>

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Qtd.</th>
                                            <th>Preço</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-produto">

                            
                                    
                                    </tbody>
                                </table>

                                <h3>TOTAL DA VENDA</h3>

                                <button type="button" class="btn btn-default btn-adicionar-variacao btn-block" style="font-size:24px!important; padding:30px!important;">00.00 KZ</button>
                               
                                <button type="button" class="btn btn-info btn-adicionar-variacao btn-block" style="font-size:20px!important; margin-top:20px;">FINALIZAR</button>
                                <button type="button" class="btn btn-danger btn-adicionar-variacao btn-block" style="font-size:20px!important;">CANCELAR</button>
                                

                            </div>

                            </div>
                            

                        </div>

                        <div class="modal-footer">
                            <p style="text-align:center">Formulário Para Realizar Vendas de Produtos</p>
                        </div>
                        
                    
                </div>
            </div>
        
        </div>

@endsection

@section('scripts')

{!! Html::script('js/plugins/dataTables/datatables.min.js') !!}
{!! Html::script('js/plugins/chosen/chosen.jquery.js') !!}


<!-- Page-Level Scripts -->
<script>

 setInterval(calculatePrice, 1000)

function calculatePrice(){

    $("#adicionarVendaModal input[name=total]").val(
        (($("#adicionarVendaModal input[name=preco_unitario]").val()*$("#adicionarVendaModal input[name=qtd]").val())-$("#adicionarVendaModal input[name=desconto]").val())+'.00'
    );

     
 }


$(document).on('click', '.produto', function(){

    var id = $(this).val()
    
    $(function(){

        $.get('http://localhost:8000/json/produto/'+id+'', function(data){

            $("#adicionarVendaModal input[name=codigo]").val(data.codigo);
            $("#adicionarVendaModal input[name=preco_unitario]").val(data.valor_venda);
            $("#adicionarVendaModal input[name=qtd]").val(1);
            $("#adicionarVendaModal input[name=prodNome]").val(data.nome);
            $("#adicionarVendaModal input[name=prodId]").val(data.id);
        

        }, 'json');


    });

});



    $(document).ready(function(){
              $('.chosen-select').chosen({width: "100%"});
    });
    // Show Categoria Function
    $(document).on('click', '.adicionar-venda-modal', function(){

        // mostrar a modal
        $("#adicionarVendaModal").modal("show");


    });

   
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


       $(document).on('click', '.btn-adicionar-produto', function(){
   
            var tr = $("<tr/>")
                            .append($("<td/>").append($("#adicionarVendaModal input[name=prodNome]").val()))           
                            .append($("<td/>").append($("#adicionarVendaModal input[name=qtd]").val()))
                            .append($("<td/>").append($("#adicionarVendaModal input[name=preco_unitario]").val()))
                            .append($("<td/>").append($("#adicionarVendaModal input[name=total]").val()))
                            .append($("<td/>").append($("<a/>", {href:"", class:"btn btn-danger btn-sm"})
                                    .append($("<i/>", {class:"fa fa-trash"} ))
                                ))

                            .append($("<input/>", {type:"hidden", name:"produto[]", value:$("#adicionarVendaModal input[name=prodId]").val()}))

                            
            
            $('#tbody-produto').append(tr);


        });

   </script>

@endsection