@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('head')

    {!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}

@endsection

@section('page-heading')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Gerenciar Compras</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index-2.html">Admin</a>
                </li>
                <li>
                    <a>Compras</a>
                </li>
                <li class="active">
                    <strong>Adicionar</strong>
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
                    <h5>Formulário Para Adicionar Compra</h5>
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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fornecedor</label> 
                                <select class="chosen-select form-control"  tabindex="2" name="">
                                    <option value="F">ATTS</option>
                                    <option value="M">PEP</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Produto</label> 
                                <select class="chosen-select form-control"  tabindex="2" name="">
                                    <option value="F">Luva Dotri</option>
                                    <option value="M">Vernizes Utenli</option>
                                </select>
                            </div>
                        </div>

                        
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="row">

                         <div class="col-md-12 table-responsive">
                    
                            <table class="table table-bordered table-hover" >

                                <thead>
                                    <tr>
                                        <th>Imagem</th>
                                        <th>Produto</th>
                                        <th>Modelo</th>
                                        <th>Fornecedor</th>
                                        <th>Atributos</th>
                                        <th>Preço Unitário</th>
                                        <th>Total</th>
                                        <th>Acção</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr class="gradeX">
                                      
                                        <td style="text-align:center;">
                                            <a href="#">
                                                <img alt="image" class="img-square img-td-2" src="/img/a1.jpg">
                                            </a>
                                        </td>
                                        <td>
                                           Verniz EDD
                                        </td>
                                        <td>
                                          <span class="label label-warning">Light Seco</span>
                                        </td>
                                        <td>
                                        AST
                                        </td>
                                        <td>
                                            <div class="input-group m-b col-md-12">
                                                <span class="input-group-addon">Verde (21)</span> 
                                                <input type="number" placeholder="Qtde" class="form-control">
                                            </div>

                                            <div class="input-group m-b col-md-12">
                                                <span class="input-group-addon">Azul (1)</span> 
                                                <input type="number" placeholder="Qtde" class="form-control">
                                            </div>

                                            <div class="input-group m-b col-md-12">
                                                <span class="input-group-addon">Preta (3)</span> 
                                                <input type="number" placeholder="Qtde" class="form-control">
                                            </div>

                                        </td>

                                        <td>
                                             <input type="number" value="2000" class="form-control">
                                        </td>

                                        <td>
                                                 <input type="number" value="2000" disabled class="form-control">
                                        </td>
                                       
                                        <td>
                                            <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                    
                                </tbody>

                            </table>

                        </div>

                      
                        <div class="col-md-4 mg-top-20">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-block">Salvar Compra</button>
                            </div>
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