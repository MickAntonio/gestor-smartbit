<!DOCTYPE html>
<html>

<head>
    @include('includes.head')
</head>

<body class="top-navigation">

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom white-bg">
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-header">
                    <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <i class="fa fa-reorder"></i>
                    </button>
                    <a href="" class="navbar-brand">GESB</a>
                </div>
                <div class="navbar-collapse collapse" id="navbar">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a aria-expanded="false" role="button" href=""> SECRETÁRIA</a>
                        </li>
                        <li class="dropdown">
                            <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Inscricao Matricula <span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="/Secretaria/inscricao-pela-primeira-vez">Inscrever</a></li>
                                <li><a href="/Secretaria/lista-de-candidatos-inscritos">Lista de inscritos</a></li>
                                <li><a href="/Secretaria/confirmar-matricula">Confirmar Matricula</a></li>
                                <li><a href="/Secretaria/inscricao">Lista de Confirmados</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Estatísticas <span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="/Secretaria/inscricao">Matricular candidato</a></li>
                                <li><a href="#">Ver candidato matriculado</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">Pagamentos dos Alunos<span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="/secretaria/lista-de-alunos">Lista de Alunos</a></li>
                                <li><a href="/secretaria/alunos-propinas-pagamentos">Propinas</a></li>
                                <li><a href="/secretaria/alunos-outros-pagamentos">Outros</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">Outros Pagamentos <span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="/secretaria/entradas-pagamentos">Entradas</a></li>
                                <li><a href="/secretaria/saidas-pagamentos">Saidas</a></li>
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Configurações de Dados <span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="/secretaria/tipos-de-pagamentos">Tipos de Pagamentos</a></li>
                                <li><a href="/secretaria/preco-das-propinas">Preços das Propinas</a></li>
                                <li><a href="/secretaria/precos">Preços</a></li>
                            </ul>
                        </li>
                    

                    </ul>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="wrapper wrapper-content">
            
            @yield('content')

        </div>
       <!-- <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div> -->
    </div>
   



 @include('includes/scripts')

   
</body>


</html>
