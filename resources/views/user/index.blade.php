@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="alert alert-light" role="alert">
                <form action="{{ route('user.index') }}" method="GET" id="buscador">
                    <div class="row">

                        <div class="form-group col-md-9">
                            <input id="search" type="text" class="form-control">
                        </div>

                        <div class="form-group col-md-2" >
                            <input type="submit" value="Buscar" class="btn btn-success">
                        </div>

                    </div>
                </form>    
            </div> 

            @foreach($users as $user)
            <div class="alert alert-light person" role="alert">
                <a href="{{ route('profile', ['id' => $user->id]) }}" class="detail"><h4 style="text-align: left;">{{ $user->name.' '.$user->surname }}</h4></a>

                    <div class="data-user-profile">
                            @if($user->image)
                                <div class="container-avatar">
                                    <img src="{{  route('user.avatar',['filename'=>$user->image]) }}" class="avatar">
                                </div>
                            @endif
                        
                        <div class="info-user">

                            <p class="text-profile">Nombre: {{ $user->name.' '.$user->surname }} </p>

                            <p class="text-profile">Nick: {{ '@'.$user->nick }} </p>                           

                            <p class="text-profile">Email: {{ ' '.$user->email }} </p>
                        
                            <p class="text-profile">Se unio: {{ ' ( '.\FormatTime::LongTimeFilter($user->created_at).' )' }} </p>
                            
                        </div> 
                    </div>                                   
            </div>
            @endforeach

            {{-- Paginacion --}}

            <div class="clearfix">
                    {{  $users->links()  }}
            </div>
        </div>        
    </div>
</div>

@endsection