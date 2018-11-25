@extends("secretaria.main")
@section("title","Formulário de Matricula")

@section("head")
{!! Html::style('css/plugins/iCheck/custom.css') !!}
{!! Html::style('css/plugins/steps/jquery.steps.css') !!}
{!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}
@endsection

@section("content")
  
        <div class="row">
            <div class="col-md-12">
                @include('components.messages')
            </div>
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5> FOMULÁRIO DE INSCRIÇÃO</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <h2>
                            Preencha todos os passos para fazer a inscrição
                        </h2>
                        <p>
                            * Alguns campos são de caracter obrigatorio...
                        </p>
                        {{ Form::open(["url" => "/Secretaria/inscricao-pela-primeira-vez","class" => "wizard-big","id" => "form"])}}
                            <h1>DADOS BIOGRAFICOS</h1>
                            <fieldset>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label for="firstName">
                                            <p>Primeiro Nome</p>
                                        </label>
                                        <input required minlength="3" type="text" id="firstName" name="firstName" class="form-control" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastName">
                                            <p>Ultimo Nome</p>
                                        </label>
                                        <input required minlength="3" type="text" id="lastName" name="lastName" class="form-control" />
                                    </div>
                                </div>   
                                <div class="col-md-12">
                                    <br>   
                                    <div class="col-md-4">
                                        <label for="Naturalidade">
                                            <p>Naturalidade:</p>
                                        </label>
                                        <select required min="1"  id="Naturalidade" name="Naturalidade" class="form-control chosen-select">
                                        <option selected disabled>Selecione:</option>
                                            <?php for ($i=0; $i <count($municipio) ; $i++) { ?>
                                                <option value="<?= $municipio[$i]->id?>"><?= $municipio[$i]->nome?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="futher">
                                            <p>Nome do Pai:</p>
                                        </label>
                                        <input required minlength="7" type="text" id="futher" name="futher" class="form-control" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mother">
                                            <p>Nome do Mãe:</p>
                                        </label>
                                        <input required minlength="7" type="text" id="mother" name="mother" class="form-control" />
                                    </div>
                                   
                                </div>
                                <div class="col-md-12">
                                <br>   
                                <div class="col-md-4">
                                        <label for="Idnumber">
                                            <p>Número de B.I ou Cedula:</p>
                                        </label>
                                        <input required type="text" minlength="3" maxlength="14" id="Idnumber" name="Idnumber" class="form-control" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="born">
                                            <p>Data de nascimento:</p>
                                        </label>
                                        <input required type="date" max="<?=date("Y")-14?>-12-31"  id="born" name="born" class="form-control" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="genre">
                                            <p>Sexo:</p>
                                        </label>
                                        <select required type="text" id="genre" name="genre" class="form-control">
                                            <option selected disabled>Selecione:</option>
                                            <option value="MASCULINO">MASCULINO</option>
                                            <option value="FEMENINO">FEMENINO</option>
                                        </select>
                                    </div>
                                    
                                </div>        
                            </fieldset>
                            <h1>CONTACTOS</h1>
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
                                        <input  type="number" id="cellphoneFuther" name="TelefonePai" class="form-control" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cellphoneMother">
                                            <p>Telefone da mãe:</p>
                                        </label>
                                        <input  type="number" id="cellphoneMother" name="TelefoneMae" class="form-control" />
                                    </div>           
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <div class="col-md-4">
                                        <label for="cellphone">
                                            <p>Telefone Candidato:</p>
                                        </label>
                                        <input  type="number" id="cellphone" name="cellphone" class="form-control" />
                                    </div>
                                    <div class="col-md-8">
                                        <label for="email">
                                            <p>Seu Email:</p>
                                        </label>
                                        <input type="email" id="email" name="email" class="form-control" />
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
                                        <input required type="text" minlength="4" id="escolaAnterior" name="escolaAnterior" class="form-control" />
                                    </div>
                                    <div class="col-md-8">
                                        <label for="anoAnterior">
                                            <p>Ano que estudou:</p>
                                        </label>
                                        <input required type="number" min="2010" max="<?=date("Y")-1?>" id="anoAnterior" name="anoAnterior" class="form-control" />
                                    </div>          
                                </div>  
                                <div class="col-md-12">
                                    <br>
                                    <div class="col-md-12">
                                        <label for="curso">
                                            <p>Inscreve-se no curso de:</p>
                                        </label>
                                        <select required  id="curso" name="curso" class="form-control">
                                        <option selected disabled>Selecione:</option>
                                            <?php for ($i=0; $i < count($curso) ; $i++) { ?>
                                                <option value="<?= $curso[$i]->id?>"><?= $curso[$i]->nome?></option>
                                            <?php } ?>
                                        </select>
                                    </div>         
                                </div>  
                            </fieldset>

                            <h1>FINALIZAR</h1>
                            <fieldset>
                                <h4>Atenção: Apresentação de falsas informações pode implicar o cancelamento da matricula.</h4>                                
                                <label for="acceptTerms">Você concorda que todas informações prestadas estão correctas?</label>
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
{!! Html::script('js/plugins/chosen/chosen.jquery.js') !!}


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

             $('.chosen-select').chosen({width: "100%"});
       });
    </script>
@endsection