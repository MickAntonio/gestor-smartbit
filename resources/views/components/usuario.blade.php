<div class="col-md-4">
   
    <div class="widget-head-color-box navy-bg p-lg text-center">
                <div class="m-b-md">
                <h2 class="font-bold no-margins">
                {{Auth::user()->name}}
                </h2>
                    <small>{{Auth::user()->type}}</small>
                </div>
                <img src="/img/user.png" width="140px" class="img-circle circle-border m-b-md" alt="profile">
                
            </div>
            <div class="widget-text-box">
                <h4>Nome de usuário: {{Auth::user()->name}}</h4>
                <p>Email: {{Auth::user()->email}}</p>
                <p>Tipo: {{Auth::user()->type}}</p>
                <div class="text-right">
                    <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                    <a class="btn btn-xs btn-primary"><i class="fa fa-heart"></i> Love</a>
                </div>
            </div>
</div>