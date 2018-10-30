@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('head')

    {!! Html::style('css/plugins/summernote/summernote.css') !!}
    {!! Html::style('css/plugins/summernote/summernote-bs3.css') !!}
    {!! Html::style('css/plugins/datapicker/datepicker3.css') !!}

    {!! Html::style('css/plugins/iCheck/custom.css') !!}
    {!! Html::style('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') !!}

    @component('components.ajax.select-one-on-change', 
        [
            'onStart'=>'true', 
            'funcao'=>'selecionaSubCategorias', 
            'url'=>'json/lista-de-sub-categorias', 
            'selected'=>'categoria', 
            'container'=>'subcategorias', 
            'selectShow'=>'nome', 
            'selectValue'=>'id'  
        ]
    )
    @endcomponent

@endsection



@section('page-heading')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Adicionar Produtos</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/">Admin</a>
                </li>
                <li>
                    <a href="/admin/produtos">Produtos</a>
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

@section('wrapper-class', 'animated fadeInRight ecommerce')

@section('content')


<div class="row">

    <div class="col-md-12">
        @include('components.messages')
    </div>
    <div class="col-lg-12">

        <div class="tabs-container">

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">Detahles do Produto</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2"> Preços </a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3"> Estoque </a></li>
                    <!-- <li class=""><a data-toggle="tab" href="#tab-4"> Estoque / Variações </a></li> -->
                    <li class=""><a data-toggle="tab" href="#tab-5"> Imagem </a></li>
                
                </ul>

            {!! Form::model($produto, ['route'=> ['produtos.update', $produto->id], 'method'=>'PUT', 'files'=>'true']) !!}

                <div class="tab-content">

                    <div id="tab-1" class="tab-pane active">
                    
                        <div class="panel-body">

                            <fieldset class="form-horizontal">
                                <div class="form-group"><label class="col-sm-2 control-label">Produto</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('nome', null, ['class'=>'form-control', 'placeholder'=>'Nome do Produto']) !!}
                                    </div>
                                </div>
                                
                                <div class="form-group"><label class="col-sm-2 control-label">Descrição</label>
                                  
                                    <div class="col-md-10">
                                        {!! Form::textarea('descricao', null, ['class'=>'form-control', 'rows'=>'3']) !!}
                                    </div>

                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Modelo</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('modelo', null, ['class'=>'form-control', 'placeholder'=>'Informe o modelo do Produto']) !!}
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Fornecedor</label>
                                    <div class="col-sm-10">
                                        
                                        {!! Form::select('fornecedor_id', $fornecedores, $produto->fornecedor->id, ['class'=>'form-control']) !!}
                                        
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Dimensões</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('dimensoes', null, ['class'=>'form-control', 'placeholder'=>'Informe as dimensões do Produto']) !!}
                                    </div>
                                    
                                    <label class="col-sm-2 control-label">Peso</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('peso', null, ['class'=>'form-control', 'placeholder'=>'Informe o peso do produto']) !!}
                                    </div>
                                </div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Categoria</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('categoria_id', $categorias, $produto->subcategoria->categoria->id, ['class'=>'form-control', 'onclick'=>'selecionaSubCategorias();', 'id'=>'categoria']) !!}
                                    </div>
                                    <label class="col-sm-2 control-label">Sub-Categoria</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('subcategoria_id', $subCategorias, $produto->subcategoria->id, ['class'=>'form-control', 'id'=>'subcategorias']) !!}
                                    </div>
                                </div>

                                @php
                                    $variacao  = collect( ['Sim'=>'Sim', 'Nao'=>'Nao'] );
                                    $comercial = collect( ['Sim'=>'Sim', 'Nao'=>'Nao'] );
                                @endphp

                                <div class="form-group"><label class="col-sm-2 control-label">Possui Variação</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('variacao', $variacao, $produto->variacao, ['class'=>'form-control']) !!}
                                    </div>

                                    <label class="col-sm-2 control-label">Comercial</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('comercial', $comercial, $produto->comercial, ['class'=>'form-control']) !!}
                                    </div>
                                </div>


                                
                            </fieldset>

                        </div>
                    </div>
                  
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label>Preço de custo</label> 
                                    {!! Form::number('valor_compra', null, ['class'=>'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    <label>Outras despesas</label> 
                                    {!! Form::number('despesas', null, ['class'=>'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    <label>Preço de Custo final</label> 
                                    {!! Form::number('custo_final', null, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                                </div>

                            </div>

                            <div class="col-md-8">

                                <button type="button" class="btn btn-primary mg-top-20 mg-bottom-20"><i class="fa fa-calculator"></i> Calcular de Venda</button>

                                <div class="table-responsive">
                                    <table class="table table-stripped table-bordered">

                                        <tr>
                                            <th>
                                                Lucro sugerido <i>(%)</i>
                                            </th>

                                            <th>
                                                Lucro utilizado <i>(%)</i>
                                            </th>
                                            
                                            <th>
                                                Valor de venda sugerido
                                            </th>

                                            <th>
                                                Valor de venda utilizado
                                            </th>

                                        </tr>
                                        <tbody>
                                            <tr>

                                                <td>
                                                    <input type="number" disabled  class="form-control" value="0.00">
                                                </td>

                                                <td>
                                                    <input type="number" class="form-control" value="0.00">
                                                </td>

                                                <td>
                                                    <input type="number" disabled class="form-control" value="0.00">
                                                </td>

                                                <td>
                                                    {!! Form::number('valor_venda', null, ['class'=>'form-control']) !!}
                                                </td>
                                                
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>

                            </div>

                            

                        </div>
                    </div>

                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">


                            <div class="table-responsive">
                                <table class="table table-stripped table-bordered">

                                    <tr>
                                        <th>
                                            Estoque mín.
                                        </th>

                                        <th>
                                            Estoque máx.
                                        </th>

                                        <th>
                                            Estoque actual
                                        </th>
                                    </tr>

                                    <tbody>

                                        <tr>

                                            <td>
                                                {!! Form::number('estoque_minimo', $produto->estoque->estoque_minimo, ['class'=>'form-control']) !!}
                                            </td>

                                            <td>
                                                {!! Form::number('estoque_maximo', $produto->estoque->estoque_maximo, ['class'=>'form-control']) !!}
                                            </td>

                                            <td>
                                                {!! Form::number('estoque_actual', $produto->estoque->estoque_actual, ['class'=>'form-control']) !!}
                                            </td>

                                            <!-- Id do Estoque -->
                                            {!! Form::hidden('estoque_id', $produto->estoque->id) !!}
                                            
                                        
                                        </tr>

                                    </tbody>

                                </table>
            
                                
                            </div>

                        </div>
                    </div>

                    <!-- <div id="tab-4" class="tab-pane">
                        <div class="panel-body">

                             <div class="alert alert-warning alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Informe a baixo quais são as variações que este produto pode ter. <a class="alert-link" href="#">Notificação de Ajuda</a>.
                            </div>

                            <div class="form-group mg-top-20 mg-bottom-20">
                                <label class="checkbox-inline"> <input type="checkbox" value="option1" id="inlineCheckbox1"> Cor </label> 
                                <label class="checkbox-inline"><input type="checkbox" value="option2" id="inlineCheckbox2"> Tamanho </label> 
                                <label class="checkbox-inline"><input type="checkbox" value="option3" id="inlineCheckbox3"> Genero </label>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-stripped table-bordered">

                                    <tr>
                                        <th>
                                            Referência
                                        </th>

                                        <th>
                                            Cor
                                        </th>
                                        
                                        <th>
                                            Estoque mín.
                                        </th>

                                        <th>
                                            Estoque máx.
                                        </th>

                                        <th>
                                            Estoque actual
                                        </th>
                                    </tr>

                                    <tbody>
                                    <tr>

                                        <td>
                                            <input type="text" disabled class="form-control" value="003">
                                        </td>
                                        <td>
                                            <select class="form-control width-200" name="categoria_id">
                                                <option value="">Verde</option>
                                            </select>
                                        </td>

                                         <td>
                                            <input type="number" name="estoque_minimo" class="form-control" value="0">
                                        </td>

                                        <td>
                                            <input type="number" name="estoque_maximo" class="form-control" value="0">
                                        </td>

                                        <td>
                                            <input type="number"  name="estoque_actual" class="form-control" value="0">
                                        </td>
                                        
                                    </tr>

                                    </tbody>

                                </table>

                                <button type="button" class="btn btn-default mg-top-20 mg-bottom-20"><i class="fa fa-plus"></i> Adicionar variação</button>
                                
                            </div>

                        </div>
                    </div> -->

                    <div id="tab-5" class="tab-pane">
                        
                        <div class="panel-body">

                            <div class="form-group"><label class="col-sm-2 control-label">Selecionar Imagem</label>
                                    <div class="col-sm-5">
                                        <input type="file" name="imagem" class="form-control">
                                    </div>
                                </div>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mg-top-20 mg-bottom-20 col-md-offset-10"><i class="fa fa-plus"></i> Actualizar Produto</button>
                   
                </div>

            {!! Form::close() !!}           
            
        </div>
    </div>
</div>

@endsection

@section('scripts')

<!-- SUMMERNOTE -->
{!! Html::script('js/plugins/summernote/summernote.min.js') !!}
<!-- Data picker -->
{!! Html::script('js/plugins/datapicker/bootstrap-datepicker.js') !!}

<!-- iCheck -->
{!! Html::script('js/plugins/iCheck/icheck.min.js') !!}

<script>

    $(document).ready(function(){

        $('.summernote').summernote();

        $('.input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

    });
</script>

@endsection