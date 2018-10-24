<script type="text/javascript">
    
    $(function(){
    
        // obtem o submit do formulário
        $("#{{$form}}").submit(function(){

            // obtem o fomulário a ser enviado
            var form = document.getElementById("{{$form}}");
            // responsavel por armazenar os campos (obrigatorio) não preenchidos
            var necessaryFields = [];
            // responsavel por armazenar os campos ( não obrigatorio) não preenchidos
            var notNecessaryFields = [];
    
    /**
     *  verifica se existem campos (obrigatorios) que devem ser verificados
    */
    
        // verifica a variavel necessaryFields foi declarada
        @if(isset($necessaryFields))
    
            // percorre cada campo (obrigatorio) que deve ser verificado
            @for($i=0; $i< count($necessaryFields) ; $i++)
                // verifica se o campo (obrigatorio) foi prenchido ou não
                if(form.<?=$necessaryFields[$i]?>.value === ''){
                    // se o campo não foi preechido é adicionada a variavel de campos a serem preenchidos
                    necessaryFields = necessaryFields.concat("{{$necessaryFields[$i]}}"); 
                }
            @endfor
            
        @endif

        
    
    /**
     *  verifica se existem campos (obrigatorios) que devem ser verificados
    **/
        // verifica a variavel notNecessaryFields foi declarada
        @if(isset($notNecessaryFields))
        
            // percorre cada campo (obrigatorio) que deve ser verificado
            @for($i=0; $i< count($notNecessaryFields) ; $i++)
                // verifica se o campo (obrigatorio) foi prenchido ou não
                if(form.<?=$notNecessaryFields[$i]?>.value === ''){
                    // se o campo não foi preechido é adicionada a variavel de campos a serem preenchidos
                    notNecessaryFields = notNecessaryFields.concat("{{$notNecessaryFields[$i]}}"); 
                }
                
            @endfor

        @endif


        
    
    
            // verifica se existe um campo (obrigatorio) que não foi prenchido
             if(necessaryFields.length > 0)
             {
                 if(necessaryFields.length==1){
                    swal({
                        title: 'O campo seguinte deve ser preenchido.',
                        text: '( '+necessaryFields.join(' | ')+' ) ',
                        type: "warning"
                    });
                 }else{
                    swal({
                        title: 'Os campos seguintes devem ser preenchidos.',
                        text: '( '+necessaryFields.join(' | ')+' ) ',
                        type: "warning"
                    });
                 }
                
             }
    
             // verifica se existe um campo ( não obrigatorio) que não foi prenchido
             if(necessaryFields.length == 0 && notNecessaryFields.length > 0)
             {
                 var msg = '';
    
                 if(notNecessaryFields.length==1){
                    msg = 'O campo seguinte não foi preenchido';
                 }else{
                    msg = 'Os campos seguintes não foram preenchidos';
                 }
    
                swal({
    
                    title: '<?=$sure ?>',
                    text: ''+msg+' ( '+notNecessaryFields.join(' | ')+' ) ',
                    type: "info",
                    showCancelButton: true,
                    cancelButtonText:'Cancelar',
                    confirmButtonColor: "#2F3B59",
                    confirmButtonText: "Continuar Sim",
                    closeOnConfirm: false
    
                }, 
                function () {
                    // enviar o formulário
                    submitForm();
                });
             }

             
    
             // verifica se todos os campos foram prenchido
             if(necessaryFields.length == 0 && notNecessaryFields.length == 0){
                // enviar o formulário
                submitForm();
             }
    
            return false;
    
        });
    
        // função responsavel por envia o formulario para
    // ser persistido na base de dados via post por meio do ajax
    function submitForm(){

       $.ajax({
           
           url: '{{ route($route) }}',
           type: 'POST',
           data: $("#{{$form}}").serialize(),
           success: function( data ) {
               
               if ( data == 'successo' ) {
                   swal({
                       title: "{{$success}}",
                       type: "success"
                   },function(){
                        @if(isset($redirect))
                            window.location.href="{{url($redirect)}}";
                        @endif
                   });
               } else{
            
                   swal({
                       title: '{{$error}}'+data,
                       type: "error"
                   }, function(){
                        @if(isset($redirect))
                            window.location.href="{{url($redirect)}}";
                        @endif
                   });
               }
           }
       });

       
    
    }
    
    });
    
    
    
    </script>