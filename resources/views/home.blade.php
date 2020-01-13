@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            
            @include('includes.mensaje')

            @foreach($images as $image)
                {{-- Tarjeta de una imageeeen --}}
                @include('includes.image', ['image'=>$image])

            @endforeach

            {{-- Paginacion --}}

            <div class="clearfix">
                    {{  $images->links()  }}
            </div>
        </div>        
    </div>
</div>

@endsection
