<script type="text/javascript">

    @if ($onStart=='true')

        $(document).ready(function(){
            
            {{$funcao}}();
          
        });

    @endif

    function {{$funcao}}(){
        

        var container = document.getElementById("{{$container}}");
            
        var selected = document.getElementById("{{$selected}}").value;
        
        $(function(){

            $.get('{{ url($url) }}/'+selected+'', function(o){

                
                container.innerHTML="";

                for (var i=0; i< o.length; i++) {
                    
                    $("#{{$container}}").append('<option  value="'+o[i].{{$selectValue}}+'">'+o[i].{{$selectShow}}+'</option>');
                }

                return false;

            }, 'json');

        });

    }


</script>