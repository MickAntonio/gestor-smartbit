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
            </div>
            <div class="col-lg-12">
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
                        <h2>
                            Preencha todos os passos para fazer a confirmção de matricula
                        </h2>
                        <p>
                            * todos os campos são de caracter obrigatorio...
                        </p>
                        {{ Form::open(["url" => "/Secretaria/inscricao-pela-primeira-vez","class" => "wizard-big","id" => "form"])}}
                       <!-- <form id="form" action="#" class="wizard-big"> -->
                        <!--<input type="hidden" name="_token" value="" /> -->
                            <h1>Informe o nº de processo</h1>
                            <fieldset>
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <label for="processo">
                                            <p>Número de processo</p>
                                        </label>
                                        <input required type="number" id="processo" name="processo" class="form-control" />
                                    </div>
                                </div>  
                                <div class="col-md-12"> <br/> 
                                     <input type="button" id="search" name="search" value="Encontrar" class="btn btn-primary col-md-offset-1 col-md-2" />
                                </div>
                            </fieldset>
                            <h1>Ano lectivo Anterior</h1>
                            <fieldset>
                                <div class="col-md-12">
                                    <br>
                                    <div class="col-md-4">
                                        <label for="residencia">
                                            <p>Residência actual:</p>
                                        </label>
                                        <input required type="text" id="residencia" name="residencia" class="form-control" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cellphoneFuther">
                                            <p>Telefone do pai:</p>
                                        </label>
                                        <input required type="number" id="cellphoneFuther" name="cellphoneFuther" class="form-control" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cellphoneMother">
                                            <p>Telefone da mãe:</p>
                                        </label>
                                        <input required type="number" id="cellphoneMother" name="cellphoneMother" class="form-control" />
                                    </div>           
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <div class="col-md-4">
                                        <label for="cellphone">
                                            <p>Seu telefone:</p>
                                        </label>
                                        <input required type="text" id="cellphone" name="cellphone" class="form-control" />
                                    </div>
                                    <div class="col-md-8">
                                        <label for="email">
                                            <p>Seu Email:</p>
                                        </label>
                                        <input required type="email" id="email" name="email" class="form-control" />
                                    </div>          
                                </div> 
                            </fieldset>

                            <h1>DADOS ACADEMICOS</h1>
                            <fieldset>
                                 <div class="col-md-12">
                                    <br>
                                    <div class="col-md-4">
                                        <label for="escolaAnterior">
                                            <p>Escola Anterior:</p>
                                        </label>
                                        <input required type="text" id="escolaAnterior" name="escolaAnterior" class="form-control" />
                                    </div>
                                    <div class="col-md-8">
                                        <label for="anoAnterior">
                                            <p>Ano que estudou:</p>
                                        </label>
                                        <input required type="number" min="2010" max="<?=date("Y")-1?>" id="anoAnterior" name="anoAnterior" class="form-control" />
                                    </div>          
                                </div>  
                            </fieldset>

                            <h1>FINALIZAR</h1>
                            <fieldset>
                                <h4>Atenção: Apresentação de falsas informações pode implicar o cancelamento da matricula.</h4>                                
                                <label for="acceptTerms">Você concorda que todas informações prestas estão correctas?</label>
                                <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> 
                            </fieldset>
                        <!--</form>--> {{ Form::close() }}
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
                    if (currentIndex === 3 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 3 && priorIndex === 4)
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