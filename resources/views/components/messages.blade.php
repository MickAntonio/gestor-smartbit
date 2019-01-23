    
    @if (Session::has('successo'))
        <div class="alert alert-success margin-top-100" role="alert">
            <strong>Mensagem:</strong> {{ Session::get('successo') }}
        </div>
    @endif
    @if (Session::has('fail'))
        <div class="alert alert-danger margin-top-100" role="alert">
            <strong>Mensagem:</strong> {{ Session::get('fail') }}
        </div>
    @endif

    @if (count($errors) > 0)            
        <div class="alert alert-danger margin-top-100" role="alert">
            <strong>Lamento:</strong>
            
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
