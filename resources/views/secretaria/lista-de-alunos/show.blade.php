@extends('secretaria.main')

@section('title', 'GE-Smartbit')

@section('head')
    
    {!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
    {!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}

@endsection

@section('content')

    <div class="container">

        @include('components.messages')
    
        <div class="row">
        
            <div class="col-md-12">
                
            <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li>
                    <a data-toggle="tab" href="#tab-01">
                        Dados Pessoais
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#tab-10">
                        Dados Acadêmicos
                    </a>
                </li>

                 <li class="active">
                    <a data-toggle="tab" href="#tab-02">
                        Propinas
                        <span class="label label-warning">Anolectivo 2018</span>
                    </a>
                </li>

            </ul>
            <div class="tab-content">

                <div id="tab-01" class="tab-pane">
                    <div class="panel-body">

                        <table class="table table-bordered table-th-200">

                            <tr>
                                <th>Nome</th>
                                <td>{{ $aluno->candidato->nome }}</td>
                            </tr>

                            <tr>
                                <th>Bilhete de Identidade</th>
                                <td>{{ $aluno->candidato->bi }}</td>
                            </tr>

                            <tr>
                                <th>Genero</th>
                                <td>{{ $aluno->candidato->sexo }}</td>
                            </tr>


                            <tr>
                                <th>Data de Nascimento</th>
                                <td>{{ $aluno->candidato->nascido }}</td>
                            </tr>

                            <tr>
                                <th>Telefone</th>
                                <td>{{ $aluno->candidato->telefone }}</td>
                            </tr>

                            <tr>
                                <th>Filho de</th>
                                <td>{{ $aluno->candidato->pai }} e {{ $aluno->candidato->mae }}</td>
                            </tr>


                            <tr>
                                <th>Acção</th>
                                <td>
                                </td>
                            </tr>

                        </table>
                    
                    </div>
                </div>

                 <div id="tab-02" class="tab-pane active">
                    <div class="panel-body">

                        <table class="table table-bordered table-th-200">
   
                            
                           <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Meses</th>
                                    <th>Multas</th>
                                    <th>Subtotal</th>
                                    <th>Forma de Pagamento</th>
                                    <th>Total das Multas</th>
                                    <th>Total a Pagar</th>                                    
                                    <th>Total Pago</th>                                    
                                    <th>Descrição</th>                                    
                                </tr>
                            </thead>

                             <tbody>
                              
                              @php
                                  $i=1
                              @endphp                              
                              @foreach($pagamentos as $pagamento)

                              <tr>
                                <td rowspan="2" class="td-bg-gray">{{ $i++ }}</td>
                                <th colspan="7" class="td-bg-green">Pagamento Efectuado aos {{ $pagamento->created_at }}</th>
                                <td class="td-bg-green">
                                    <a href="" class="btn btn-info btn-sm a-color-white"><i class="fa fa-file-pdf-o"></i> </a>                                                            
                                </td>
                              
                              </tr>

                              <tr>
                              
                                  

                                <td>
                                  @foreach($pagamento->propinas as $propina)
                                  
                                    <div class="form-group">
                                        <input type="text" value="{{ $propina->mes->mes }}" disabled class="form-control">                                
                                    </div>                            

                                  @endforeach
                                  </td>

                                <td>
                                @php
                                  $multas=0
                              @endphp  
                                @foreach($pagamento->propinas as $propina)

                                    @if($propina->multa>0)

                                    @php $multas=$multas+$propina->multa @endphp 

                                        <div class="form-group">
                                            <input type="text" value="{{ $propina->multa }} kz" disabled class="form-control">                                
                                        </div> 
                                        
                                    @endif                           

                                  @endforeach
                                </td>

                                <td>
                                  @foreach($pagamento->propinas as $propina)
                                  
                                    <div class="form-group">
                                        <input type="text" value="{!! $propina->preco->preco->preco + $propina->multa !!}.00 kz" disabled class="form-control">                                
                                    </div>                            

                                  @endforeach
                                </td>

                                  <td>
                                      <div class="form-group">
                                            <input type="text" value="{{ $pagamento->forma }}" disabled class="form-control">                                
                                        </div> 
                                  </td>
                                  <td>

                                    @if($multas>0)
                                  
                                       <div class="form-group">
                                            <input type="text" value="{{ $multas }}.00 kz" disabled class="form-control">                                
                                        </div> 

                                    @endif                           
                                        
                                  </td>
                                  <td>
                                      <div class="form-group">
                                            <input type="text" value="{{ $pagamento->total }} kz" disabled class="form-control">                                
                                        </div> 
                                  </td>
                                  <td>
                                      <div class="form-group">
                                            <input type="text" value="{{ $pagamento->valor_pago }} kz" disabled class="form-control">                                
                                        </div> 
                                  </td>
                                  <td>
                                      <div class="form-group">
                                            <input type="text" value="{{ $pagamento->descricao }}" disabled class="form-control">                                
                                        </div> 
                                  </td>
                                  

                              </tr>
                              
                              @endforeach
                              
                              </tbody>


                        </table>
                    
                    </div>
                </div>

            </div>
        </div>

            </div>

    </div>






@endsection

@section('scripts')

    <!-- Flot -->
    {!! Html::script('js/plugins/flot/jquery.flot.js') !!}
    {!! Html::script('js/plugins/flot/jquery.flot.tooltip.min.js') !!}   
    {!! Html::script('js/plugins/flot/jquery.flot.resize.js') !!}   

    <!-- ChartJS-->
    {!! Html::script('js/plugins/chartJs/Chart.min.js') !!}   
        
    <!-- Peity -->
    {!! Html::script('js/plugins/peity/jquery.peity.min.js') !!}   
        
    <!-- Peity demo -->
    {!! Html::script('js/demo/peity-demo.js') !!} 

    {!! Html::script('js/plugins/dataTables/datatables.min.js') !!}

    {!! Html::script('js/plugins/chosen/chosen.jquery.js') !!}



    <script>

        $('.chosen-select').chosen({width: "100%"});

        $(document).ready(function() {


            var d1 = [[1262304000000, 6], [1264982400000, 3057], [1267401600000, 20434], [1270080000000, 31982], [1272672000000, 26602], [1275350400000, 27826], [1277942400000, 24302], [1280620800000, 24237], [1283299200000, 21004], [1285891200000, 12144], [1288569600000, 10577], [1291161600000, 10295]];
            var d2 = [[1262304000000, 5], [1264982400000, 200], [1267401600000, 1605], [1270080000000, 6129], [1272672000000, 11643], [1275350400000, 19055], [1277942400000, 30062], [1280620800000, 39197], [1283299200000, 37000], [1285891200000, 27000], [1288569600000, 21000], [1291161600000, 17000]];

            var data1 = [
                { label: "Data 1", data: d1, color: '#17a084'},
                { label: "Data 2", data: d2, color: '#127e68' }
            ];
            $.plot($("#flot-chart1"), data1, {
                xaxis: {
                    tickDecimals: 0
                },
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 1
                            }, {
                                opacity: 1
                            }]
                        },
                    },
                    points: {
                        width: 0.1,
                        show: false
                    },
                },
                grid: {
                    show: false,
                    borderWidth: 0
                },
                legend: {
                    show: false,
                }
            });

            var lineData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Example dataset",
                        backgroundColor: "rgba(26,179,148,0.5)",
                        borderColor: "rgba(26,179,148,0.7)",
                        pointBackgroundColor: "rgba(26,179,148,1)",
                        pointBorderColor: "#fff",
                        data: [48, 48, 60, 39, 56, 37, 30]
                    },
                    {
                        label: "Example dataset",
                        backgroundColor: "rgba(220,220,220,0.5)",
                        borderColor: "rgba(220,220,220,1)",
                        pointBackgroundColor: "rgba(220,220,220,1)",
                        pointBorderColor: "#fff",
                        data: [65, 59, 40, 51, 36, 25, 40]
                    }
                ]
            };

            var lineOptions = {
                responsive: true
            };


            var ctx = document.getElementById("lineChart").getContext("2d");
            new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

        });

        // Data table
        $(document).ready(function(){
            
            $('.data-table-grid').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'}
                   

                    
                ]

            });

        });
    </script>


@endsection