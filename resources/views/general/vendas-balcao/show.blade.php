@extends('principal.main')

@section('title', 'CNS-Principal')

@section('content')

<div class="row">
    <div class="col-lg-10 col-lg-offset-1">

        <div class="ibox product-detail">
            <div class="ibox-content">

                <div class="row">
                    
                    <div class="col-md-12">

                        <h2 class="font-bold m-b-xs">
                            Dados da Instituição
                        </h2>
                        <small>Many desktop publishing packages and web page editors now.</small>
                        <hr>
                        <div>
                            <a class="btn btn-primary pull-right"  data-toggle="modal" data-target="#usuariosModal">Adicionar Usuário</a>
                            <h1 class="product-main-price">Hospital Jeorgina Paulo<small class="text-muted"></small> </h1>
                        </div>
                        <hr>
                        <h4>Descrição</h4>

                        <div class="small text-muted">
                            It is a long established fact that a reader will be distracted by the readable
                            content of a page when looking at its layout. The point of using Lorem Ipsum is
                            that it has a more-or-less normal distribution of letters, as opposed to using
                            'Content here, content here', making it look like readable English.
                            <br/>
                            
                        </div>
                        <dl class="dl-horizontal m-t-md small">
                            <dt>Director</dt>
                            <dd>Manuel Silva Guva</dd>
                            <dt>Responsavel de Hemoterapia</dt>
                            <dd>Dudas Sauro Manuel.</dd>
                            <dt>Províincia.</dt>
                            <dd>Luanda</dd>
                            <dt>Munícipio</dt>
                            <dd>Cartarbur</dd>
                            <dt>Bairro e Rua.</dt>
                            <dd>Madeira rua dos 20 passos</dd>

                            <dt>Adicionada aos</dt>
                            <dd>20/01/02</dd>

                            <dt>Actulizada aos</dt>
                            <dd>20/01/02</dd>
                            
                        </dl>
                        <div class="text-right">
                            <div class="btn-group">
                                <button class="btn btn-white btn-sm"><i class="fa fa-phone"></i>  224 938 2883 8282 e 244 938 3828 388  </button>
                                <button class="btn btn-white btn-sm"><i class="fa fa-envelope"></i>  ajadsr2018992@gmail.com </button>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <div class="ibox-footer">
                <span class="pull-right">
                    Full stock - <i class="fa fa-clock-o"></i> 14.04.2016 10:04 pm
                </span>
                The generated Lorem Ipsum is therefore always free
            </div>
        </div>

    </div>
</div>

<div class="row">
        
        <div class="col-lg-10 col-lg-offset-1">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lista de Usuários Cadastradas</h5>
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

                <div class="table-responsive">
                    
                        <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Estado</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>excluir</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <span class="label label-success"><i class="fa fa-check"></i> activo</span>
                                    </td>
                                    <td>
                                        Manuel Guva
                                    </td>
                                    <td>
                                        manuel@gmail.com
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                    </td>
                                    

                                </tr>
                                
                                

                                </tbody>
                            </table>

                </div>

                </div>
            </div>

        </div>
        
</div>

<div class="modal inmodal" id="usuariosModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Adicionar Novo Usuário</h4>
                <small class="font-bold">Este é o formulario para adicionar usuários que teram accesso a essa instituição.</small>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nome</label> 
                            <input type="text" placeholder="" class="form-control">
                        </div>
                    </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label> 
                            <input type="text" placeholder="" class="form-control">
                        </div>
                    </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Palavra-passe</label> 
                            <input type="text" placeholder="" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Confirmação da Palavra-passe</label> 
                            <input type="text" placeholder="" class="form-control">
                        </div>
                    </div>


                </div>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Adicionar</button>
            </div>
        </div>
    </div>

</div>

@endsection
