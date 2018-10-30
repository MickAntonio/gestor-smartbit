@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('head')

    {!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}

@endsection

@section('page-heading')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Produtos Movimentados Para Uso</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index-2.html">Admin</a>
                </li>
                <li>
                    <a>Movimentação de Produtos</a>
                </li>
                <li class="active">
                    <strong>Usos</strong>
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
                    <h5>Formulário Para Realizar Movimentação</h5>
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

                         <div class="col-md-12 table-responsive">

                         <h2>Produtos</h2>
                    
                            <table class="table table-bordered table-hover" >

                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Preço Total</th>
                                        <th>Acção</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr class="gradeX">

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control"  tabindex="2" name="">
                                                    <option value="F">Luva Dotri</option>
                                                    <option value="M">Vernizes Utenli</option>
                                                </select>
                                            </div>
                                        </td>
                                      
                                        <td class="width-320">
                                            <div class="input-group m-b col-md-12">
                                                <span class="input-group-addon">Ver e Azul (3)</span> 
                                                <input type="number" max="3" min="1" placeholder="Qtde" class="form-control">
                                            </div>
                                        </td>

                                        <td class="width-150">
                                            <input type="number" disabled value="00.00" class="form-control">
                                        </td>
                                        
                                       
                                        <td class="width-80">
                                            <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                    
                                </tbody>

                            </table>

                            <button type="button" class="btn btn-default btn-adicionar-variacao"><i class="fa fa-plus"></i> Adicionar Produto</button>
                            

                        </div>

                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="row">

                         <div class="col-md-12 table-responsive">

                         <h2>Total dos Produtos Movimentados</h2>
                    
                            <table class="table table-bordered table-hover" >

                                <thead>
                                    <tr>
                                        <th>Total dos Produtos</th>
                                        <th>Total Em Dinheiro</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr class="gradeX">

                                        <td class="width-150">
                                            <input type="number" disabled value="00" class="form-control">
                                        </td>

                                        <td class="width-150">
                                            <input type="number" disabled value="00.00" class="form-control">
                                        </td>
                                        
                                    </tr>
                                    
                                </tbody>

                            </table>

                            <button type="button" class="btn btn-primary btn-adicionar-variacao"><i class="fa fa-plus"></i> Finalizar Movimentação</button>
                            

                        </div>

                    </div>

                </div>
            </div>

        </div>
        
</div>

@endsection


@section('scripts')

{!! Html::script('js/plugins/chosen/chosen.jquery.js') !!}

<script>
    $(document).ready(function(){

              $('.chosen-select').chosen({width: "100%"});


    });
</script>

@endsection