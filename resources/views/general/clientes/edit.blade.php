@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('page-heading')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Actualizar Cliente</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/">Admin</a>
                </li>
                <li>
                    <a>Clientes</a>
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
                    <h5>Formulário Para Actualizar Clientes</h5>
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

                    {!! Form::model($cliente, ['route'=> ['cliente.update', $cliente->id], 'method'=>'PUT']) !!}
                     
                    <div class="row">

                        <div class="col-md-12">
                            @include('components.messages')
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('nome', 'Informe o Nome do Cliente') !!}
                                {!! Form::text('nome', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('bi', 'Numero B.I') !!}
                                {!! Form::text('bi', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                            <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('data_nascimento', 'Data de Nascimento') !!}
                                {!! Form::text('data_nascimento', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        @php
                            $genero = collect( ['M'=>'Masculino', 'F'=>'Femenino'] );
                        @endphp
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('genero', 'Genero') !!}
                                {!! Form::select('genero', $genero, $cliente->genero, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('telefone', 'Telefone') !!}
                                {!! Form::text('telefone',  $cliente->contacto->telefone, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('email', 'Email') !!}
                                {!! Form::text('email',  $cliente->contacto->email, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('redes_sociais', 'Redes Sócias') !!}
                                {!! Form::text('redes_sociais',  $cliente->contacto->redes_sociais, ['class'=>'form-control']) !!}
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
