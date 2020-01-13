@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @include('includes.mensaje')

                <div class="card pub_image pub_image_detail">
                    <div class="card-header">
                        @if($image->user->image)
                            <div class="container-avatar">
                                <img src="{{  route('user.avatar',['filename'=>$image->user->image]) }}" class="avatar">
                            </div>
                        @endif
                            
                            <div class="data-user">
                                    <a href="{{ route('profile', ['id' => $image->user->id]) }}" class="detail">
                                        {{ $image->user->name. ' ' . $image->user->surname }}
                                
                                        <span class="nickname">
                                            {{  ' ( '.$image->user->nick.' )'}}
                                        </span>
                                    </a>
                            
                            @if(Auth::user() && Auth::user()->id == $image->user->id)
                                <div class="action">
                                    <a href="{{ route('image.edit', ['id'=> $image->id]) }}" title="Editar"><img src="{{ asset('img/edit.png') }}" alt="Editar" class="btn-edicion"></a>
                                    
                                    <!-- Button to Open the Modal -->
                                            <a title="Borrar" data-toggle="modal" data-target="#myModal" ><img src="{{ asset('img/delete.png') }}" alt="Borrar" class="btn-edicion"></a>
  
                                        <!-- The Modal -->
                                        <div class="modal" id="myModal">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
  
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Eliminar Imagen</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
  
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    ¡Si eliminas la imagen no podras recuperarla!
                                                </div>
  
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                <button type="button" class="btn bg-light" data-dismiss="modal">Cerrar</button>
                                                <a href="{{ route('image.delete', ['id'=>$image->id]) }}" title="Borrar" class="btn btn-danger">Borrar</a>
                                                </div>
  
                                            </div>
                                            </div>
                                        </div>
                                </div>
                            @endif

                        </div>
                    </div>
                        
                    <div class="card-body">
                        <div class="image-container">
                            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}">
                        </div>

                        <div class="likes">
                            {{-- Comprobar si el usuario le dio like a la imagen --}}
                                <?php $user_like = false; ?>

                                    @foreach($image->likes as $like) 

                                        @if($like->user->id == Auth::user()->id)                    
                                            <?php $user_like = true; ?>
                                        @endif

                                    @endforeach

                                     @if($user_like)             
                                            <img src="{{  asset('img/like-red-white.png') }}" data-id="{{$image->id}}" class="btn-dislike"> 
                                        @else
                                            <img src="{{  asset('img/like.png') }}" data-id="{{$image->id}}" class="btn-like">
                                    @endif
                       
                                        <span class="number_likes">{{'('.count($image->likes).')'}}</span>
                        </div>


                        <div class="description">
                            <span class="nickname">{{'@'. $image->user->nick.' ('}}</span>
                            <span class="date">{{ \FormatTime::LongTimeFilter($image->created_at).' )' }}</span>  
                            <p class="imageDes">{{$image->description }}</p>
                        </div>

                        <div class="clearfix"></div>
                            <div class="comments">          
                                <p class="nickname" style="margin-left:15px;">Comentarios ({{count($image->comments)}})</p>
                                <hr>   
                                
                                <form action="{{ route('comment.save') }}" method="POST">

                                    @csrf
                                    <input type="hidden" name="imagen_id" value="{{$image->id}}">

                                    <div class="md-form">
                                            <label for="content">Comentario</label>
                                            <textarea id="content" name="content"  class="md-textarea form-control {{  $errors->has('content') ? 'is-invalid': '' }} " rows="3"></textarea> 
                                                
                                                @if ($errors->has('content'))
                                                    <span class="alert alert-danger" role="alert">
                                                        <strong>{{ $errors->first('content') }}</strong>
                                                    </span>
                                                @endif                      
                                    </div>

                                    <div style="margin-top:10px; margin-left:84%">
                                        <button type="submit" class="btn bg-light">
                                            Comentar
                                        </button>
                                    </div>

                                </form>

                                
                                @foreach ($image->comments as $comment)
                                <hr>
                                    <div class="comment">
                                        <div>
                                            @if($comment->user->image)
                                                <div class="container-avatar">
                                                    <img src="{{  route('user.avatar',['filename'=>$comment->user->image]) }}" class="avatar">
                                                </div>
                                            @endif
                                        </div>

                                        <div>
                                                <span class="nickname">{{'@'. $comment->user->nick.' ('}} </span>
                                                <span class="date">{{ \FormatTime::LongTimeFilter($comment->created_at).' )' }}
                                                
                                                 @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                                            <a href="{{ route('comment.delete', ['id'=> $comment->id]) }}" class="btn btn-sm btn-danger delete">
                                                            Eliminar
                                                            </a>
                                                    @endif
                                                    
                                                </span>  
                                                <p class="imageDes">{{$comment->content }}</p>
                                                
                                        </div>
                                    </div>
                                  
                                @endforeach
                            </div>
                </div>
            </div>
        </div>           
    </div>
</div>

@endsection
