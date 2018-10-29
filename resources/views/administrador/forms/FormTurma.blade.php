@extends("Administrador.main")
@section("title","Criar nova Turma")


@section("content")

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
{!! Form::open(["url" => "Administrador/AddClass", "method" => "post"]) !!}

    <div class="col-md-12">
        <div class="col-md-4 col-md-1-often">
            <label for="NomeTurma">
                <p>Nome da turma</p>
            </label>
            <input required type="text" name="turma" id="NomeTurma" class="form-control" />
        </div>
        <div class="col-md-4 col-md-1-often">
            <label for="Quantidade">
                <p>Quantidade</p>
            </label>
            <input  required min="0" max="50" type="number" id="Quantidade" name="Quantidade" class="form-control" />
        </div>
        <div class="col-md-4">
            <label for="IdPeriodo">
                <p>Periodo</p>
            </label>
            <select required class="form-control" name="periodo" id="IdPeriodo">
                <option disabled selected>Selecione:</option>
                <option value="Manhã">Manhã</option>
                <option value="Tarde">Tarde</option>
                <option value="Noite">Noite</option>
            </select>
        </div>
    </div>
    <div class="col-md-12">
    <br>
        <div class="col-md-4">
            <label for="IdClasse">
                <p>Classe</p>
            </label>
        <select required class="form-control" name="Classe" id="IdClasse">
        <option disabled selected>Selecione:</option>
        <?php for ($i=0; $i < count($classe) ; $i++) { ?>
            <option value="<?= $classe[$i]->id?>"><?= $classe[$i]->nome?></option>
        <?php } ?>
        </select>
        </div>
        <div class="col-md-4">
            <label for="IdCurso">
                <p>Curso</p>
            </label>
        <select required class="form-control" name="Curso" id="IdCurso">
        <option disabled selected>Selecione:</option>
        <?php for ($i=0; $i < count($Curso) ; $i++) { ?>
            <option value="<?= $Curso[$i]->id?>"><?= $Curso[$i]->nome?></option>
        <?php } ?>
        </select>
        </div>  
        <div class="col-md-4 col-md-1-often">
            <label for="Anoletivo">
                <p>Ano Lectivo</p>
            </label>
            <input required min="2015" max="<?=date("Y")+1?>" type="number" id="Anoletivo" name="Anoletivo" class="form-control" />
        </div>      
    </div>
    <div class="col-md-12">
        <br>
        <button class="col-md-12 btn btn-primary" type="submit">Criar Turma</button>
    </div>

{!! Form::close() !!}
</div>
@endsection