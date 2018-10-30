@extends("Administrador.main")
@section("title","Criar novo Curso")


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
    {!! Form::open(['url' => 'Administrador/AddCourse']) !!}

        <div class="col-md-6">
            <div class="col-md-8">
                <label for="NomeCurso">
                    <p>Nome do curso</p>
                </label>
                <input required type="text" id="NomeCurso" name="Curso" class="form-control" />
            </div>
            <div class="col-md-4">
                <label for="Abreviacao">
                    <p>Abreviacao</p>
                </label>
                <input required type="text" id="Abreviacao" name="Abreviacao" class="form-control" />
            </div>
            <div class="col-md-12">
            <br>
                <label for="Descricao">
                    <p>Descricao</p>
                </label>
                <textarea required id="Descricao"  rows="3" name="Descricao" class="form-control"></textarea>
            </div>
        </div>
        <br>       
        <div class="col-md-12">
            <br>
            <button class="col-md-6 btn btn-primary" type="submit">Criar Turma</button>
        </div>
    {!! Form::close() !!}
</div>
@endsection