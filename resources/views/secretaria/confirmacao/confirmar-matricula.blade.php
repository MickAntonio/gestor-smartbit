@extends("secretaria.main")
@section("title","Formulário de Confirmação Matricula")

@section("head")
{!! Html::style('css/plugins/iCheck/custom.css') !!}
{!! Html::style('css/plugins/steps/jquery.steps.css') !!}
@endsection

@section("content")
 
        <div class="row">
            <div class="col-md-12">
                @include('components.messages')
                @if (Session::has('faileds'))
                        <div class="alert alert-danger margin-top-100" role="alert">
                            <h4> <strong>Lamento:</strong> {{ Session::get('faileds')?? "" }} </h4>
                        </div>
                    @endif   
            </div>
            <div class="col-lg-8 col-md-offset-2">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5> FOMULÁRIO DE CONFIRMAÇÃO DA MATRICULA</h5>
                        <div class="ibox-tools">
                            <a class="btn btn-success btn-sm" onclick="bringTurma();">
                                <i style="color: #fff" class="fa fa-refresh "></i>
                            </a>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                        </div>
                    </div>
                    <div class="ibox-content">
                        <h2 class="">
                            Preencha todos os passos para fazer a confirmção de matricula
                        </h2>
                        <p>
                            * todos os campos são de caracter obrigatorio...
                        </p>
                        @if(isset($matricula))
                        {{ Form::open(["url" => "/Secretaria/confirmar-matricula","class" => "wizard-big","id" => "form","method" => "POST"])}}
                            
                            <h1>Ano lectivo Anterior</h1>
                                <fieldset>
                                    <div class="col-md-12">
                                        <br>
                                        <div class="col-md-12">
                                            <label for="cellphoneMother">
                                                <p>nome:</p>
                                            </label>
                                            <input  disabled type="text" value="{{ $matricula->aluno()->get()[0]->candidato()->get()[0]->nome?? ''}}" id="cellphoneMother" name="nome" class="form-control" />
                                        </div>     
                                        <div class="col-md-12">
                                            <label for="cursoR">
                                                <p>Curso que frequenta:</p>
                                            </label>
                                            <input readonly  type="hidden" value="{{ $matricula->aluno()->get()[0]->curso()->get()[0]->id??''}}" id="idcurso" class="form-control" />
                                            <input  disabled type="text" value="{{ $matricula->aluno()->get()[0]->curso()->get()[0]->nome??''}}" id="cursoR" name="curso" class="form-control" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="residencia">
                                                <p>Classe anterior:</p>
                                            </label> 
                                            <input  disabled type="text" value="{{$classeAnterior = $matricula->turma()->get()[0]->classe()->get()[0]->nome??''}}" id="residencia" name="oldclass" class="form-control" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cellphoneFuther">
                                                <p>ano lectivo anterior:</p>
                                            </label>
                                            <input type="hidden" value="{{$matricula->aluno()->get()[0]->id?? ''}}"  name="idaluno" class="form-control" />
                                            <input readonly value="{{$matricula->turma()->get()[0]->anolectivo?? ''}}" name="AnoAnterior" id="cellphoneFuther" class="form-control" />
                                        </div>
                                            
                                    </div>
                                
                                </fieldset>

                                <h1>Proximo ano lectivo</h1>
                                <fieldset>
                                <h4 class="alerta col-md-12"></h4>
                                    <div class="col-md-12">                                  
                                    <br>
                                        <div class="col-md-6">
                                            <label for="escolaAnterior">
                                                <p>Classe:</p>
                                            </label>
                                            <select required class="form-control" name="Classe" onchange="bringTurma();" id="IdClasse">
                                                <option selected disabled >Selecione:</option>
                                                <?php $true = false;
                                                for ($i=0; $i < count($classe) ; $i++)
                                                {
                                        
                                                    if($true === true)
                                                    { 
                                                ?>
                                                        <option class="idclasses"  value="<?= $classe[$i]->id?>"><?= $classe[$i]->nome?></option>
                                                <?php   $true = false; 
                                                    }
                                                    if($classeAnterior  === $classe[$i]->nome)
                                                        $true = true;
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><p>Turmas Disponiveis:</p></label> 
                                                <select required id="turma" class="form-control"  tabindex="2" name="turma">
                                                
                                                </select>
                                            </div>
                                        </div>          
                                    </div>  
                                </fieldset>
                        <!--</form>--> {{ Form::close() }}
                        @endif
                    </div>
                </div>
                </div>

            </div>

 </div>
 
 <div data-backdrop="static" class="modal inmodal" id="ExcluirModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content animated flipInY">

            
                <div class="modal-header">
                    @if ( (Session::has('failed') or !isset($matricula)) and $processo!=0 )
                        <div class="alert alert-danger margin-top-100" role="alert">
                            <strong>Lamento:</strong> {{ Session::get('failed')??" " }}
                        </div>
                    @endif       
                </div>
                <div class="modal-body">

                    <div class="row">
                            <div class="col-md-12 margem" >
                                    <label for="processo">
                                        <p>Informe o Número de processo</p>
                                    </label>
                                    <input required type="number" id="processo" name="processo" class="form-control" />
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

{!! Html::script('js/plugins/steps/jquery.steps.min.js') !!}
{!! Html::script('js/plugins/validate/jquery.validate.min.js') !!}

 <script>
 function bringTurma ()
 {
                $.get("{{url('Administrador/json-turma')}}/"+$(".idclasses").val()+"/"+$("#idcurso").val(),{"classe":1},function(done)
                {
                    var texto = '';
                   
                    if(done.length<1)
                        $(".alerta").html('<strong class="alert " role="alert" style="color:red">*Não há turmas disponiveis para está classe</strong>');
                    else
                        $(".alerta").text("");
                       
                    for(i=0; i<done.length; i++)
                        texto += '<option value="'+done[i].id+'">'+done[i].nome+' > '+done[i].periodo+' > '+done[i].anolectivo+'</option>';
                    $("#turma").html(texto);

                },"Json")   
 }
        $(document).ready(function(){

                 

            @if(!isset($matricula))
                $("#ExcluirModal").modal("show");
                $(".procurar").click(function()
                {
                    window.location.href=' {{url("/Secretaria/confirmar-matricula")}}/'+$("#processo").val();
                });
            @endif
            $(".end").click(function()
            {
                //window.history.back();
                window.location.href=' {{url("/Secretaria")}}';
            });
        
           

            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 1 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 1 && priorIndex === 2)
                    {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                }
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            element.before(error);
                        },
                        rules: {
                            confirm: {
                                equalTo: "#password"
                            }
                        }
                    });

            $(".actions a[href='#previous']").html("Anterior");
            $(".actions a[href='#next']").html("Seguinte");
            $(".actions a[href='#finish']").html("Concluir");
       });
    </script>
@endsection