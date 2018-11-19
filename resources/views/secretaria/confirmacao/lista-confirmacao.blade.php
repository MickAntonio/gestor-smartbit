@extends("secretaria.main")
@section("title","Lista de alunos que confirmaram a matricula ")

@section("head")
{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
{!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}
@endsection

@section("content")
  
<div class="row">
            <div class="col-md-12">
                @include('components.messages')
            </div>
    <div class="container">
        <div class="row">
        
            <div class="col-md-12">
                
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><strong>Lista de alunos com matricula confirmada</strong></h5>
                        <div class="ibox-tools">                        

                            <a href="" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> </a>
                            <a href="{{ route('PdfAllConfirmados',$date) }}" class="btn btn-white btn-sm"><i class="fa fa-print"></i> Imprimir lista </a>
                      
                        </div>

                    </div>
                    <div class="ibox-content">
                    </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover data-table-grid">
                                <thead>
                                <tr>

                                    <th>Nº pro.</th>
                                    <th>Nome </th>
                                    <th>classe</th>
                                    <th>Turma</th>
                                    <th>Curso</th>
                                    <th>Sexo</th>
                                    <th>Acção</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $validador = false; @endphp
                                @if(isset($matricula[0]))
                                    @foreach($matricula as $aluno)
                                        @if($aluno->tipo==="Confirmacao")

                                            @if($aluno->turma()->get()[0]->estado != "ANONIMA" and $aluno->turma->anolectivo == $date)
                                                @php $validador = true;
                                                $sexo = $aluno->aluno()->get()[0]->candidato()->get()[0]->sexo?? "";
                                                    if($sexo === "MASCULINO")
                                                        $sexo = "M";
                                                    elseif($sexo === "FEMENINO")
                                                        $sexo = "F";
                                                    else $sexo = "";
                                                    @endphp
                                            <tr>
                                                <td>{{ $aluno->aluno()->get()[0]->id?? "" }}</td>
                                                <td>{{ $aluno->aluno()->get()[0]->candidato()->get()[0]->nome?? "" }}</td>
                                                <td>{{ $aluno->turma()->get()[0]->classe()->get()[0]->nome?? "" }} </td>
                                                <td>{{ $aluno->turma()->get()[0]->nome?? "" }} - 
                                                    {{ $aluno->turma()->get()[0]->anolectivo?? "" }}  -
                                                    {{ $aluno->turma()->get()[0]->periodo?? "" }} </td>
                                                <td>{{ $aluno->turma()->get()[0]->curso()->get()[0]->nome?? "" }} </td>
                                                <td>{{ $sexo }} </td>
                                                <td><a class=" adds btn btn-success btn-sm show-modal">
                                                        <i class="fa fa-share"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                                
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

    </div>
 </div>

 <div data-backdrop="static" class="modal inmodal" id="TurmaAntiga" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content animated flipInY">

            
                <div class="modal-header">
                    @if (Session::has('failed') and $validador == false)
                        <div class="alert alert-danger margin-top-100" role="alert">
                            <h4><strong>Lamento:</strong> {{ Session::get('failed')??" " }} </h4>
                        </div>
                    @endif       
                </div>
                <div class="modal-body">

                    <div class="row">
                            <div class="col-md-12 margem" >
                                    <label for="processo">
                                        <p>Informe o ano lectivo</p>
                                    </label>
                                    <input required min="2010" max="{{date('Y')+1}}" value="{{date('Y')}}" type="number" id="processo" name="processo" class="form-control" />
                            </div>
                             <a  class="margem col-sm-12 btn btn-primary procurar"> <strong>Procurar</strong></a>

                        <button type="button" class="col-sm-12 btn btn-white mg-top-20 end"><strong>Cancelar</strong></button>
                        
                    </div>

                </div>
            
            </div>
        </div>

    </div> 
@endsection

@section("scripts")

    {!! Html::script('js/plugins/dataTables/datatables.min.js') !!}
  
    {!! Html::script('js/plugins/chosen/chosen.jquery.js') !!}

    <script>
    // Data table
        $(document).ready(function(){

             @if($validador == false)
                $("#TurmaAntiga").modal("show");
                $(".procurar").click(function()
                {
                    window.location.href=' {{url("/Secretaria/Lista-de-alunos-com-matricula-confirmada")}}/'+$("#processo").val();
                });
            @endif
            $(".end").click(function()
            {
                window.location.href=' {{url("/Secretaria")}}';
            });
          
            $(".adds").click(function ()
            {
                $("#idaluno").val($(this).data("idmatricula"));
                $("#nome").val($(this).data("nome"));
                $("#curso").html('<option value="'+$(this).data("idcurso")+'">'+$(this).data("curso")+'</option>');
                $("#Idperiodo").val($(this).data("periodo"));
                $("#classe").val($(this).data("classe"));

                $.get("{{url('Administrador/json-turma')}}/"+$(this).data("idclasse")+"/"+$(this).data("idcurso"),{"classe":$(this).data("idclasse")},function(done)
                {
                    var texto = '';
                   
                    if(done.length<1)
                        $(".alerta").html('<strong class="alert alert-danger" role="alert">Não há turmas disponiveis para está classe</strong>');
                    else
                        $(".alerta").text("");
                       
                    for(i=0; i<done.length; i++)
                        texto += '<option value="'+done[i].id+'">'+done[i].nome+' -> '+done[i].periodo+'</option>';
                    $("#turma").html(texto);

                },"Json")
                $("#MatricularModal").modal("show");
            })        


            $('.data-table-grid').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'excel', title: '@yield("title")'}
                   

                    
                ]

            });

        });
    </script>
@endsection