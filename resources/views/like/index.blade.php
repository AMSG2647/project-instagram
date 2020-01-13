@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="alert alert-light" role="alert">
                    <h4 class="alert-heading text-black-50">Imagenes Favoritas</h4>
                    <hr>
                    <p>En este apartado se muestran las publicaciones a las cuales le has dado Like!!</p>
            </div>

                @foreach($likes as $like)
                    @include('includes.image', ['image'=>$like->image])
                @endforeach

            <div class="clearfix">
                    {{  $likes->links()  }}
            </div>           
        </div>           
    </div>
</div>

@endsection
