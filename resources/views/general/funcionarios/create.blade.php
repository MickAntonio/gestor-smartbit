@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('head')

@component('components.ajax.select-one-on-change', 
    [
        'onStart'=>'true', 
        'funcao'=>'selecionaMunicipios', 
        'url'=>'json/lista-de-municipios', 
        'selected'=>'provincia', 
        'container'=>'municipios', 
        'selectShow'=>'nome', 
        'selectValue'=>'id'  
    ]
)
@endcomponent

@endsection

@section('page-heading')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Adicionar Funcionário</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index-2.html">Admin</a>
                </li>
                <li>
                    <a>funcionarios</a>
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
                <h5>Formulário Para Adicionar Funcionário</h5>
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

                {!! Form::open(array('route' => 'funcionario.store', 'files'=>'true')) !!}   

                <div class="row">

                    <div class="col-md-12">
                        @include('components.messages')
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Informe o Nome Completo do Funcionário</label> 
                            <input type="text" name="nome" placeholder="" required class="form-control">
                        </div>
                    </div>

                        <div class="col-md-4">
                        <div class="form-group">
                            <label>Numero B.I</label> 
                            <input type="text" name="bi" placeholder="" required class="form-control">
                        </div>
                    </div>

                        <div class="col-md-4">
                        <div class="form-group">
                            <label>Data de Nascimento</label> 
                            <input type="text" name="data_nascimento" placeholder="" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Genero</label> 
                            <select class="form-control" name="genero">
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Fotografia</label> 
                            <input type="file" name="foto" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Cargo</label> 
                            <input type="text" name="cargo" required placeholder="" class="form-control">
                        </div>
                    </div>

                    
                </div>

                <div class="hr-line-dashed"></div>

                <div class="row">

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Província</label> 
                            <select class="form-control" id="provincia" name="provincia" onclick="selecionaMunicipios();">
                                @foreach($provincias as $provincia)
                                <option value="{{$provincia->id}}">{{$provincia->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Munícipio</label> 
                            <select class="form-control" id="municipios" name="municipio_id">
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Bairro</label> 
                            <input type="text" name="bairro" placeholder="" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Rua</label> 
                            <input type="text" name="rua" placeholder="" class="form-control">
                        </div>
                    </div>
                    

                </div>

                <div class="hr-line-dashed"></div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Telefones</label> 
                            <input type="text" name="telefone" placeholder="" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label> 
                            <input type="text" name="email" placeholder="" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Redes Sócias</label> 
                            <input type="text" name="redes_sociais" placeholder="" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-md-4 mg-top-20">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Adicionar</button>
                        </div>
                    </div>
                    

                </div>

                {!! Form::close() !!}           





            </div>
        </div>

    </div>
        
</div>

@endsection
