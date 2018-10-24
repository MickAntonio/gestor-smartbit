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
            <h2>Actualizar Fornecedor</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index-2.html">Admin</a>
                </li>
                <li>
                    <a>Fornecedores</a>
                </li>
                <li class="active">
                    <strong>Actualizar</strong>
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
                <h5>Formulário Para Actualizar Fornecedor</h5>
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

                {!! Form::model($fornecedor, ['route'=> ['fornecedor.update', $fornecedor->id], 'method'=>'PUT']) !!}

                <div class="row">

                    <div class="col-md-12">
                        @include('components.messages')
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('nome', 'Informe o Nome do Fornecedor') !!}
                            {!! Form::text('nome', null, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('descricao', 'Descrição') !!}
                            {!! Form::text('descricao', null, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                </div>

                <div class="hr-line-dashed"></div>

                <div class="row">

                     <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('provincia', 'Províncias') !!}
                            {!! Form::select('provincia', $provincias, $fornecedor->endereco->municipio->provincia->id, ['class'=>'form-control', 'onclick'=>'selecionaMunicipios();']) !!}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('municipio_id', 'Município') !!}
                            {!! Form::select('municipio_id', $municipios, $fornecedor->endereco->municipio->id, ['class'=>'form-control', 'id'=>'municipios']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('bairro', 'Bairro') !!}
                            {!! Form::text('bairro',  $fornecedor->endereco->bairro, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('rua', 'Rua') !!}
                            {!! Form::text('rua',  $fornecedor->endereco->rua, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                </div>

                <div class="hr-line-dashed"></div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('telefone', 'Telefone') !!}
                            {!! Form::text('telefone',  $fornecedor->contacto->telefone, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::text('email',  $fornecedor->contacto->email, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('redes_sociais', 'Redes SóciaS') !!}
                            {!! Form::text('redes_sociais',  $fornecedor->contacto->redes_sociais, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="col-md-4 mg-top-20">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                        </div>
                    </div>
                    

                </div>

                {!! Form::close() !!}           





            </div>
        </div>

    </div>
        
</div>

@endsection
