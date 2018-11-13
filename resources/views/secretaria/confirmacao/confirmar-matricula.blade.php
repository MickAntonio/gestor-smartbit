@extends("secretaria.main")
@section("title","Formulário de Confirmação Matricula")

@section("head")
{!! Html::style('css/plugins/iCheck/custom.css') !!}
{!! Html::style('css/plugins/steps/jquery.steps.css') !!}
@endsection

@section("content")
  <style>
  .margem 
  {
      margin-bottom: 20px;
  }</style>
        <div class="row">
            <div class="col-md-12">
                @include('components.messages')
            </div>
            <div class="col-lg-6 col-md-offset-3">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5> FOMULÁRIO DE CONFIRMAÇÃO DA MATRICULA</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <h2 class="alerta">
                            Preencha todos os passos para fazer a confirmção de matricula
                        </h2>
                        <p>
                            * todos os campos são de caracter obrigatorio...
                        </p>
                        {{ Form::open(["url" => "/Secretaria/inscricao-pela-primeira-vez","class" => "wizard-big","id" => "form"])}}
                            <h1>Ano lectivo Anterior</h1>
                            <fieldset>
                                <div class="col-md-12">
                                    <br>
                                    <div class="col-md-12">
                                        <label for="cellphoneMother">
                                            <p>nome:</p>
                                        </label>
                                        <input readonly type="text" value="{{ $aluno[0]->candidato()->get()[0]->nome?? ''}}" id="cellphoneMother" name="nome" class="form-control" />
                                    </div>     
                                    <div class="col-md-12">
                                        <label for="residencia">
                                            <p>Classe anterior:</p>
                                        </label>
                                        <input readonly type="hidden" value="{{ $aluno[0]->curso()->get()[0]->id??''}}" id="idcurso" class="form-control" />
                                        <input readonly type="text" value="{{$classeAnterior = $aluno[0]->matricula()->get()[0]->turma()->get()[0]->classe()->get()[0]->nome??''}}" id="residencia" name="oldclass" class="form-control" />
                                    </div>
                                    <div class="col-md-12">
                                        <label for="cellphoneFuther">
                                            <p>ano lectivo:</p>
                                        </label>
                                        <input readonly value="{{$aluno[0]->matricula()->get()[0]->turma()->get()[0]->anolectivo?? ''}}" id="cellphoneFuther" name="cellphoneFuther" class="form-control" />
                                    </div>
                                         
                                </div>
                               
                            </fieldset>

                            <h1>Proximo ano lectivo</h1>
                            <fieldset>
                                 <div class="col-md-12">
                                    <br>
                                    <div class="col-md-12">
                                        <label for="escolaAnterior">
                                            <p>Classe:</p>
                                        </label>
                                        <select required class="form-control" name="Classe" id="IdClasse">
                                            <option disabled >Selecione:</option>
                                            <?php $true = false;
                                            for ($i=0; $i < count($classe) ; $i++) {
                                                if($true == false)
                                                {
                                            ?>
                                                 <option value="<?= $classe[$i]->id?>"><?= $classe[$i]->nome?></option>
                                            <?php } 
                                                if($true === true)
                                                { 
                                            ?>
                                                <option selected value="<?= $classe[$i]->id?>"><?= $classe[$i]->nome?></option>
                                            <?php $true = false; 
                                                }
                                                if($classeAnterior  === $classe[$i]->nome)
                                                    $true = true;   } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><p>Turmas Disponiveis:</p></label> 
                                            <select required id="turma" class="form-control"  tabindex="2" name="turma">
                                            
                                            </select>
                                        </div>
                                    </div>          
                                </div>  
                            </fieldset>
                        <!--</form>--> {{ Form::close() }}
                    </div>
                </div>
                </div>

            </div>

 </div>
 
 <div class="modal inmodal" id="ExcluirModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content animated bounceInRight">

            
                <div class="modal-header">
                                     
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
        $(document).ready(function(){

             $("#next").click(function ()
            {
              
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

            @if(!isset($processo) or $processo==0)
                $("#ExcluirModal").modal("show");
                $(".procurar").click(function()
                {
                    window.location.href=' {{url("/Secretaria/confirmar-matricula")}}/'+$("#processo").val();
                });
            @endif
            $(".end").click(function()
            {
                window.history.back();
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