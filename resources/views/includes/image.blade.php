<div class="card pub_image">
    <div class="card-header">
        @if($image->user->image)
            <div class="container-avatar">
                <img src="{{  route('user.avatar',['filename'=>$image->user->image]) }}" class="avatar">
            </div>
        @endif
    
    <div class="tarjeta">
        <div class="data-user">
                <a href="{{ route('profile', ['id' => $image->user->id]) }}" class="detail">
                    {{ $image->user->name. ' ' . $image->user->surname }}
                    <span class="nickname">
                        {{  ' ( '.$image->user->nick.' )'}}
                    </span>
                </a>
        </div>
                <div class="action-ver">
                    <a href="{{ route('image.detail', ['id' => $image->id]) }}" title="Ver"><img src="{{ asset('img/camera.png') }}" alt="Ver" class="btn-ver"></a>
                </div>           
    </div>                              
</div>
        
    <div class="card-body">
        <div class="image-container">
            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}">
        </div>

        <div class="likes" id="like">
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

        <a href="{{ route('image.detail', ['id' => $image->id]) }}"class="btn btn-warning btn-sm bg-light btn-comments">
            Comentarios ({{count($image->comments)}})
        </a>
        
        <div class="comments">          
                <hr>                 
                <form action="{{ route('comment.save') }}" method="POST">

                    @csrf
                    <input type="hidden" name="imagen_id" value="{{$image->id}}">

                    <div class="md-form">
                            <label for="content">Publicar Comentario</label>
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

            @if($image->comments)
                @for($i=count($image->comments); $i<=2; $i++)
                    @foreach ($image->comments as $comment => $res)
                      
                        <hr>
                            <div class="comment">
                                <div>
                                    @if($res->user->image)
                                        <div class="container-avatar">
                                            <img src="{{  route('user.avatar',['filename'=>$res->user->image]) }}" class="avatar">
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <span class="nickname">{{'@'. $res->user->nick.' ('}} </span>
                                    <span class="date">{{ \FormatTime::LongTimeFilter($res->created_at).' )' }}</span>
                                     <p class="imageDes">{{$res->content }}</p>                                                              
                            </div>
                        </div>                             
                    @endforeach
                @endfor
            @endif
        </div>
    </div>
</div>