@extends("secretaria.main")
@section("title","Lista de candidatos a serem inscritos")

@section("head")
{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
{!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}
@endsection

@section("content")
  
<div class="row">
    <div class="col-md-12">
        @include('components.messages')
    </div>
    <div class="col-md-6 col-lg-offset-3">
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
                    @if(isset($candidato[0]->id))                   
                    {!! Form::open(array('route' => 'MatriculaAnonima')) !!}   
                                         
                        <div class="row">                            
                            <input id="idaluno" readonly type="hidden" name="idaluno" value="{{$candidato[0]->aluno->id}}" class="form-control">                                
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nome</label> 
                                    <input id="nome" readonly type="text" value="{{$candidato[0]->nome}}" name="nome" class="form-control">                                
                                </div>                            
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Inscreve-se no curso de:</label> 
                                    <select id="curso" readonly class="form-control"  tabindex="2" name="curso">
                                     <option value="{{$candidato[0]->aluno->curso->id}}" selected>{{$candidato[0]->aluno->curso->nome}}</option>
                                    </select>                             
                                </div>                            
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Classe</label> 
                                    <select id="classe" class="form-control"  tabindex="2" name="classe">
                                     @foreach($classe as $c) 
                                        <option value="{{ $c->id }}"> {{ $c->nome }}</option>
                                    @endforeach
                                    </select>
                                </div>                            
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IdPeriodo">
                                        <p>Periodo</p>
                                    </label>
                                    <select required class="form-control" name="periodo" id="IdPeriodo"> 
                                        <option selected value="Manhã">Manhã</option>
                                        <option value="Tarde">Tarde</option>
                                        <option value="Noite">Noite</option>
                                    </select>                
                                </div>                            
                            </div> 
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="custo">Custo da Inscricao</label> 
                                        <input min="1000" id="custo" required type="number" name="custo" class="form-control">                                
                                    </div>                            
                            </div>
                            <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                            <button  type="submit" class="btn btn-primary">Inscrever</button>
                        </div>    
                    {!! Form::close() !!} 
                    @endif
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
        setTimeout(function()
        {
            $.get("{{url('/Secretaria/renderiza')}}",{"game":1},function(done)
                {
                    if(done.view == true)
                    {
                        window.location.href = "";
                    }
                    console.log(done)
                },"Json");
                
        },50);
       
        $(document).ready(function(){
                 


            $('.data-table-grid').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'excel', title: 'ExampleFile'}
                   

                    
                ]

            });

        });
    </script>
@endsection