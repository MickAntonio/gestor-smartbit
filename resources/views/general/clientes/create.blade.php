@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('page-heading')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Clientes</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index-2.html">Admin</a>
                </li>
                <li>
                    <a>Clientes</a>
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
                    <h5>Formulário Para Adicionar Clientes</h5>
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

                    {!! Form::open(array('route' => 'cliente.store')) !!}   

                    <div class="row">

                        <div class="col-md-12">
                            @include('components.messages')
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nome do Cliente</label> 
                                <input type="text" name="nome" placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Numero B.I</label> 
                                <input type="text" name="bi" placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Data de Nascimento</label> 
                                <input type="text" name="data_nascimento" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Genero</label> 
                                <select class="form-control" name="genero">
                                    <option value="F">Femenino</option>
                                    <option value="M">Masculino</option>
                                </select>
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
