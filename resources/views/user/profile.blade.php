@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                <div class="alert alert-light" role="alert">
                    <h4 style="text-align: left;">Perfil</h4>

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
    </div> 
    
        <div class="col-md-8">

                <div class="alert alert-warning" role="alert">
                        Fotos Publicadas
                </div>
        
                <div class="image-public">
                    @foreach($user->images as $image)
                        <div class="caja col-md-2">                                                                                             
                            <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                                <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="">
                            </a>
                        </div>  
                    @endforeach
                </div>
        </div>                
    </div>
</div>

@endsection
