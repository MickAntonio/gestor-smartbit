@extends("secretaria.main")
@section("title","Formulário de Matricula")


@section("content")
<style>
.wrapper > .row
{
    background: #fff;
    padding: 10px 0px 35px 0px !important;
}
</style>
<div class="row">
@if ($errors->any())     
            <div class="alert alert-danger">         
                <ul>             
                    @foreach ($errors->all() as $error)                 
                        <li>{{ $error }}</li>            
                    @endforeach         
                </ul>     
            </div> 
        @endif 
        {!! Form::open(['url' => 'Administrador/AddCourse']) !!}
</div>
<div class="row" >
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>DADOS BIOGRAFICOS</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content" >
            <div class="col-md-12">
                <div class="col-md-4">
                    <label for="firstName">
                        <p>Primeiro Nome</p>
                    </label>
                    <input required type="text" id="firstName" name="firstName" class="form-control" />
                </div>
                <div class="col-md-4">
                    <label for="middleName">
                        <p>Segundo Nome</p>
                    </label>
                    <input required type="text" id="middleName" name="middleName" class="form-control" />
                </div>
                <div class="col-md-4">
                    <label for="lastName">
                        <p>Ultimo Nome</p>
                    </label>
                    <input required type="text" id="lastName" name="lastName" class="form-control" />
                </div>
            </div>   
            <div class="col-md-12">
            <br>   
                <div class="col-md-4">
                    <label for="futher">
                        <p>Nome do Pai:</p>
                    </label>
                    <input required type="text" id="futher" name="futher" class="form-control" />
                </div>
                <div class="col-md-4">
                    <label for="mother">
                        <p>Nome do Mãe:</p>
                    </label>
                    <input required type="text" id="mother" name="mother" class="form-control" />
                </div>
                <div class="col-md-4">
                    <label for="Idnumber">
                        <p>Número de B.I:</p>
                    </label>
                    <input required type="text" id="Idnumber" name="Idnumber" class="form-control" />
                </div>
            </div>
            <div class="col-md-12">
            <br>   
                <div class="col-md-4">
                    <label for="born">
                        <p>Data de nascimento:</p>
                    </label>
                    <input required type="date" id="born" name="born" class="form-control" />
                </div>
                <div class="col-md-4">
                    <label for="genre">
                        <p>Sexo:</p>
                    </label>
                    <select required type="text" id="genre" name="genre" class="form-control">
                        <option selected disabled>Selecione:</option>
                        <option value=""></option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="Naturalidade">
                        <p>Naturalidade:</p>
                    </label>
                    <select required  id="Naturalidade" name="Naturalidade" class="form-control">
                        <option selected disabled>Selecione:</option>
                        <?php for ($i=0; $i <count($municipio) ; $i++) { ?>
                            <option value="<?= $municipio[$i]->id?>"><?= $municipio[$i]->nome?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>        
        </div> 
    </div>
</div>
<div class="row">
<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>CONTACTOS</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
<div class="ibox-content">
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
            <div class="col-md-12"><hr>
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
</div>
<div class="col-md-12">
    <br>
    <input type="submit" id="submit" name="submit" value="Cadastrar" class="btn btn-success col-md-12" />
</div>
{!! Form::close() !!}
@endsection