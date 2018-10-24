<!DOCTYPE html>
<html>

    <head>
        @include('includes.head')
    </head>

<body>

    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img alt="image" class="img-circle" src="/img/profile_small.jpg" />
                                </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Manuel Silva</strong>
                                </span> <span class="text-muted text-xs block">Administrador<b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.html">Perfil</a></li>
                                <li><a href="contacts.html">Contactos</a></li>
                                <li><a href="mailbox.html">Mensagens</a></li>
                                <li class="divider"></li>
                                <li><a href="login.html">Sair</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    
                    <li class="active">
                        <a href="index-2.html"><i class="fa fa-th-large"></i> <span class="nav-label">Painel de Control</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="index-2.html">Clintes</a></li>
                            <li class="active"><a href="dashboard_2.html">Estoque</a></li>
                            <li><a href="dashboard_3.html">Funcionarios</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">Serviços e Marcações</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="/admin/marcacoes">Marcações</a></li>
                            <li><a href="/admin/pagamentos">Pagamentos</a></li>
                            <li><a href="/admin/servicos">Serviços</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">Gerenciar Produtos</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="/admin/produtos">Produtos</a></li>
                            <li><a href="/admin/categoria">Categoria</a></li>
                            <li><a href="/admin/sub-categoria">Sub-categoria</a></li>
                            <li><a href="/admin/tipo-de-atributo">Tipo de Atributo</a></li>
                            <li><a href="/admin/atributo">Atributo</a></li>
                            <li><a href="/admin/produtos-danificados">Produtos Danificados</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="mailbox.html"><i class="fa fa-database"></i> <span class="nav-label">Movimentar Produtos </span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="/admin/usos">Uso de Produtos</a></li>
                        </ul>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="/admin/vendas">Venda de Produtos</a></li>
                        </ul>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="/admin/vendas-balcao">Venda Balcão</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">Gerenciar Compras </span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="/admin/compras">Lista de Compras</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/admin/cliente"><i class="fa fa-user"></i> <span class="nav-label">Clientes <span class="label label-warning pull-right">12</span></span></a>
                    </li>
                    <li>
                        <a href="/admin/fornecedor"><i class="fa fa-pie-chart"></i> <span class="nav-label">Fornecedores</span>  </a>
                    </li>
                    <li>
                        <a href="/admin/funcionario"><i class="fa fa-users"></i> <span class="nav-label">Funcionários</span></a>
                    </li>
                    <li>
                        <a href="widgets.html"><i class="fa fa-flask"></i> <span class="nav-label">Relatórios</span></a>
                    </li>
                 
                    <li class="special_link">
                        <a href="package.html"><i class="fa fa-cogs"></i> <span class="nav-label">Configurações</span></a>
                    </li>
                </ul>

            </div>

        </nav>

        <div id="page-wrapper" class="gray-bg">
        
            <div class="row border-bottom">
              
                <nav class="navbar navbar-static-top @yield('white-bg') " role="navigation" style="margin-bottom: 0">
                
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" action="http://webapplayers.com/inspinia_admin-v2.7.1/search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Sistema de Gestão de Estoque</span>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="img/a7.jpg">
                                        </a>
                                        <div>
                                            <small class="pull-right">46h ago</small>
                                            <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                            <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="img/a4.jpg">
                                        </a>
                                        <div>
                                            <small class="pull-right text-navy">5h ago</small>
                                            <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                            <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="img/profile.jpg">
                                        </a>
                                        <div>
                                            <small class="pull-right">23h ago</small>
                                            <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                            <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="mailbox.html">
                                            <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="mailbox.html">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                            <span class="pull-right text-muted small">4 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="profile.html">
                                        <div>
                                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                            <span class="pull-right text-muted small">12 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="grid_options.html">
                                        <div>
                                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                            <span class="pull-right text-muted small">4 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="notifications.html">
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>


                        <li>
                            <a href="login.html">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                        <li>
                            <a class="right-sidebar-toggle">
                                <i class="fa fa-tasks"></i>
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>

            @yield('page-heading')

            <div class="wrapper wrapper-content @yield('wrapper-class')">
                
               @yield('content')
                
            </div>

       </div> 

    </div>

    @include('includes/scripts')

    
</body>

</html>
