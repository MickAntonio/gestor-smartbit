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
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Matricula <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="<?=route("Inscription")?>">Matricular candidato</a></li>
                            <li><a href="#">Ver candidato matriculado</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Confirmação de matricula <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="#">Confirmar</a></li>
                            <li><a href="#">Alunos confirmados</a></li>
                            <li><a href="#">Alunos não confirmados</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Curso <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="<?=route("CourseList")?>">Lista de cursos</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Turma <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="<?=route("ClassList")?>">Lista de turmas</a></li>
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

        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div>

        </div>
        </div>


 @include('includes/scripts')

   
</body>


</html>
