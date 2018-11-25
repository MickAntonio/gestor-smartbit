@extends("Administrador.main")
@section("title","Lista de alunos com turma")

@section("head")
{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
{!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}
@endsection

@section("content")
  
<div class="row">
            <div class="col-md-12 col-md.offset-1">
                @include('components.messages')
            </div>
    <div class="container">
        <div class="row">
        
            <div class="col-md-12">
                
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>LISTA DE ALUNOS DA TURMA - {{ strtoupper($turma) }}</h5>
                        <div class="ibox-tools">                        

                            <a href="" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> </a>
                            <a href="{{ route('ListaDosAlunos',$idturma) }}" class=" btn btn-primary btn-sm"   ><i class="fa fa-print"></i> Imprimir Lista </a>
                        </div>

                    </div>
                    <div class="ibox-content">
                       
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover data-table-grid">
                                <thead>
                                <tr>

                                    <th>Nº ordem</th>
                                    <th>Nº Proc. </th>
                                    <th>Nome </th>
                                    <th>classe</th>
                                    <th>periodo</th>
                                    <th>Curso</th>
                                    <th>Sexo</th>
                                    <th>Acção</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php  $conta = 0 ;?>
                               
                                    @foreach($matricula as $text)
                                        @if(isset($matriculado->where("aluno_id",$text->aluno->id)->where("turma_id",$idturma)->get()[0]))
                                            @php  
                                                $aluno = $matriculado->where("aluno_id",$text->aluno->id)->where("turma_id",$idturma)->get()[0];
                                            @endphp
                                                <tr>
                                                    <td>{{ $conta = $conta + 1 }}</td>
                                                    <td>{{ $text->aluno->processo }} </td>
                                                    <td>{{ $text->nome }}</td>
                                                    <td>{{ $aluno->turma->classe->nome }} </td>
                                                    <td>{{ $aluno->turma->periodo }} </td>
                                                    <td>{{ $aluno->turma->curso->nome }} </td>
                                                    <td>{{$text->sexo=="MASCULINO"? "M" : "F" }} </td>
                                                    <td>
                                                    <a  class="btn btn-success btn-sm change-class" data-ano="{{ $aluno->turma->anolectivo }}" data-nome="{{ $text->nome }}" data-id="{{$aluno->id}}" data-idcurso="{{ $aluno->turma->curso->id }}" data-idclasse="{{ $aluno->turma->classe->id }}" data-idturma="{{ $aluno->turma->id }}">
                                                    <i class="fa fa-share"></i> Trocar a turma</a>
                                                    </td>
                                                </tr>
                                        @endif
                                    @endforeach
                                
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

    </div>
 </div>

 <div data-backdrop="static" class="modal inmodal" id="change-class" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content animated bounceInRight">

            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h5 class="modal-title">Tens a certeza do que Queres trocar?</h5>
                    <small class="font-bold">
                        O aluno <strong class="change-span">,</strong> será movido para uma outra turma...  todos os dados associados a 
                        ele nessa turma serão apagados.
                    </small>
                </div>
                <div class="modal-body">

                    <div class="row">

                        {!! Form::open(['method'=>'PUT']) !!}
                        <div class="col-md-12">
                            <label for="turma">
                                <p>Selecione a turma</p>
                            </label>
                            <select required class="margem form-control" name="turma" id="turma">
                                <option disabled selected>Selecione:</option>
                            </select>
                        </div>
                        <button type="submit" class="col-sm-12 btn btn-success margem"> <strong> <i class="fa fa-share"></i> Mover</strong></button>
                        {!! Form::close() !!}

                        <button type="button" class="col-sm-12 btn btn-white mg-top-20" data-dismiss="modal"><strong>Cancelar</strong></button>
                        
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
            $('.data-table-grid').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'excel', title: 'ExampleFile'}    
                ]
            });
        });
$(function()
{
    $("#turma").change(function()
    {
        var url = "{{ url('/Administrador/trocar-a-turma-do-aluno') }}/"+$(".change-class").data("id")+"/"+$(this).val()+"/"+$(".change-class").data("idturma");
        $("#change-class form").attr("action", url);
    });
    $(".change-class").click(function()
    {
        bringTurma ($(this).data("idclasse"),$(this).data("idcurso"),$(this).data("idturma"));

        $("#change-class").modal("show");
        $(".change-span").text($(this).data("nome"));
    });
})
function bringTurma (cl,cu,tu)
 {
                $.get("{{url('Administrador/JsonTurmaShare')}}/"+cl+"/"+cu+"/"+tu+"/"+$(".change-class").data("ano"),{"classe":1},function(done)
                {
                    var texto = '<option disabled selected>Selecione:</option>';
                   
                    if(done.length<1)
                        $(".alerta").html('<strong class="alert " role="alert" style="color:red">*Não há turmas disponiveis para está classe</strong>');
                    else
                        $(".alerta").text("");
                       
                    for(i=0; i<done.length; i++)
                        texto += '<option value="'+done[i].id+'">'+done[i].nome+' > '+done[i].periodo+' > '+done[i].anolectivo+'</option>';
                    $("#turma").html(texto);

                },"Json")   
 }
    </script>
@endsection