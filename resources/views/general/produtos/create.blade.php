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
                    <li class="active"><a data-toggle="tab" href="#tab-1">Detalhes do Produto</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2"> Preços </a></li>
                    <li class="tab-estoque"><a data-toggle="tab" href="#tab-3"> Estoque </a></li>
                    <li class="tab-variacao display-none"><a data-toggle="tab" href="#tab-4"> Estoque / Variações </a></li>
                    <li class=""><a data-toggle="tab" href="#tab-5"> Imagem </a></li>
                
                </ul>

            {!! Form::open(array('route' => 'produtos.store', 'files'=>'true')) !!}   

                <div class="tab-content">

                    <div id="tab-1" class="tab-pane active">
                    
                        <div class="panel-body">

                            <fieldset class="form-horizontal">
                                <div class="form-group"><label class="col-sm-2 control-label">Produto</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nome" class="form-control" placeholder="Nome do Produto">
                                    </div>
                                </div>
                                
                                <div class="form-group"><label class="col-sm-2 control-label">Descrição</label>
                                  
                                    <!--<div class="col-sm-10">
                                        <div class="summernote">
                                            <p>Informe algumas descrições do Produto</p>
                                            <br/>
                                        </div>
                                    </div>-->

                                    <div class="col-md-10">
                                        <textarea name="descricao" id="" cols="10" rows="3" class="form-control">Informe algumas descrições do Produto</textarea>
                                    </div>

                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Modelo</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="modelo" class="form-control" placeholder="Informe o modelo do Produto">
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Fornecedor</label>
                                    <div class="col-sm-10">
                                        <select name="fornecedor_id" id="" class="form-control">
                                            @foreach($fornecedores as $fornecedor)
                                            <option value="{{ $fornecedor->id }}">{{ $fornecedor->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Dimensões</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="dimensoes" placeholder="Informe as dimensões do Produto">
                                    </div>
                                    
                                    <label class="col-sm-2 control-label">Peso</label>
                                    <div class="col-sm-4"><input type="text" name="peso" class="form-control" placeholder="Informe o peso do produto"></div>
                                </div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Categoria</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="categoria_id" id="categoria" onclick="selecionaSubCategorias();">
                                            @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Sub-Categoria</label>
                                    <div class="col-sm-4">
                                        <select name="subcategoria_id" id="subcategorias" class="form-control">
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group"><label class="col-sm-2 control-label">Possui Variação</label>
                                    <div class="col-sm-4">
                                        <select name="variacao" class="form-control variacao">
                                            <option value="Nao">Não</option>
                                            <option value="Sim">Sim</option>
                                            
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Comercial</label>
                                    <div class="col-sm-4">
                                        <select name="comercial" id="" class="form-control comercial">
                                            <option value="Nao">Não</option>
                                            <option value="Sim">Sim</option>
                                            
                                        </select>
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
                                    <input type="number" name="valor_compra" placeholder="" value="0.00" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Outras despesas</label> 
                                    <input type="number" name="despesas" placeholder="" value="0.00" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Preço de Custo final</label> 
                                    <input type="number" name="custo_final" disabled placeholder="" value="0.00" class="form-control">
                                </div>

                            </div>

                            <div class="col-md-8 preco-venda display-none">

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
                                                    <input type="number" name="valor_venda" class="form-control" value="0.00">
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
                                                <input type="number" name="estoque_minimo_sem_variacao" class="form-control" value="0">
                                            </td>

                                            <td>
                                                <input type="number" name="estoque_maximo_sem_variacao" class="form-control" value="0">
                                            </td>

                                            <td>
                                                <input type="number"  name="estoque_actual_sem_variacao" class="form-control" value="0">
                                            </td>
                                        
                                        </tr>

                                    </tbody>

                                </table>

                                
                            </div>

                        </div>
                    </div>

                    <div id="tab-4" class="tab-pane tab-variacao display-none">
                        <div class="panel-body">

                             <div class="alert alert-warning alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Informe a baixo quais são as variações que este produto pode ter. <a class="alert-link" href="#">Notificação de Ajuda</a>.
                            </div>

                            <div class="form-group mg-top-20 mg-bottom-20">
                                
                                @foreach($tipoAtributos as $tipo)
                                <label class="checkbox-inline"> 
                                    <input type="checkbox" data-id="{{ $tipo->id }}"  data-nome="{{ $tipo->nome }} " class="tipo" id="inlineCheckbox{{ $tipo->id }}  "> {{ $tipo->nome }}  
                                </label> 
                                @endforeach
                            
                            </div>

                            <div class="table-responsive">
                                <table class="table table-stripped table-bordered table-variacao">

                                    <tr>
                                        <th class="thead-td-referencia">
                                            Referência
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

                                        <th>
                                            Acção
                                        </th>
                                    </tr>

                                    <tbody id="tbody-variacao">

                                        <tr id="tr-variacao-main">

                                            <td  class="tbody-td-referencia">
                                                <input type="text" disabled class="form-control" class="referencia_count" value="001">
                                            </td>
                                        
                                            <td>
                                                <input type="number" name="estoque_minimo[]" class="form-control" value="0">
                                            </td>

                                            <td>
                                                <input type="number" name="estoque_maximo[]" class="form-control" value="0">
                                            </td>

                                            <td>
                                                <input type="number"  name="estoque_actual[]" class="form-control" value="0">
                                            </td>

                                            <td class="">
                                                <a class="btn btn-danger btn-sm btn-remove-variacao"><i class="fa fa-trash"></i> </a>
                                            </td>
                                            
                                        </tr>

                                    </tbody>

                                </table>

                                <button type="button" class="btn btn-default mg-top-20 mg-bottom-20 btn-adicionar-variacao"><i class="fa fa-plus"></i> Adicionar variação</button>
                                
                            </div>

                        </div>
                    </div>

                    <div id="tab-5" class="tab-pane">
                        
                        <div class="panel-body">

                            <div class="form-group"><label class="col-sm-2 control-label">Selecionar Imagem</label>
                                    <div class="col-sm-5">
                                        <input type="file" name="imagem" class="form-control">
                                    </div>
                                </div>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mg-top-20 mg-bottom-20 col-md-offset-10"><i class="fa fa-plus"></i> Adicionar Produto</button>
                   
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

    $(document).on('change', '.variacao', function(){
        if($(this).val()=='Sim'){
            $('.tab-variacao').removeClass('display-none')
            $('.tab-estoque').addClass('display-none')
        }else{
            $('.tab-variacao').addClass('display-none')
            $('.tab-estoque').removeClass('display-none')
        }
    });

    $(document).on('change', '.comercial', function(){
        if($(this).val()=='Sim'){
            $('.preco-venda').removeClass('display-none')
        }else{
            $('.preco-venda').addClass('display-none')
        }
    });

     $(document).on('click', '.tipo', function(){

        if($(this).is(':checked')){

            var th_referencia = '<th id='+'th-'+$(this).data('id')+' class='+'th-'+$(this).data('id')+'>'+$(this).data('nome')+'</th>';
            var td_referencia = '<td id='+'td-'+$(this).data('id')+' class='+'td-'+$(this).data('id')+'>'+'<select name="atributos[variacao-'+$(this).data('id')+'][]" id='+'variacao-'+$(this).data('id')+' class="form-control width-150 '+'variacao-'+$(this).data('id')+'"></select>'+'</td>';
            
            $('.thead-td-referencia').after(th_referencia);
            $('.tbody-td-referencia').after(td_referencia);

            var idvar = $(this).data('id');
            var id = '.variacao-'+idvar;

             $(function(){
                $.get('http://localhost:8000/json/lista-de-atributos/'+idvar+'', function(o){
                   
                     for(var i=0; i<o.length; i++){
                         $(".variacao-"+idvar).append('<option value="'+o[i].id+'">'+o[i].nome+'</option>');
                     }

                    return false;

                }, 'json');
             });

        }else{

            var th_remove = '.th-'+$(this).data('id');
            var td_remove = '.td-'+$(this).data('id');

            $(th_remove).remove()
            $(td_remove).remove()

        }
    
    });

    var variacaoDelete = 1

    $(document).on('click', '.btn-adicionar-variacao', function(){

        if(variacaoDelete<=20){
            $('#tbody-variacao').append($('#tr-variacao-main').clone());
            variacaoDelete++
        }else{
            alert('Antigiu o Limite De Adição de Variação');
        }

    });

    $(document).on('click', '.btn-remove-variacao', function(){

        if(variacaoDelete>1){
            $(this).parents('tr').remove();
            variacaoDelete--
        }else{
            alert('Antigiu o Limite De Remoção de Variação');
        }

    });

</script>

@endsection