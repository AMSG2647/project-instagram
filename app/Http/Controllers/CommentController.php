<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){

        //Validacion

        $validate = $this->validate($request, [
            'image_id' =>'integer',
            'content' => 'string|required'
        ]);

        //Recoger datos
        $user       = \Auth::user();
        $image_id   = $request->input('imagen_id'); 
        $content    = $request->input('content');
        
        $comment = new Comment();
        
        //Settear Valores
        $comment->user_id   = $user->id;
        $comment->image_id  = $image_id;
        $comment->content   = $content;

        $comment->save();

        return redirect()->route('image.detail', ['id'=>$image_id])
                         ->with([
                             'message'=> 'Comentario Realizado'
                         ]);
        
    }

    public function delete($id){

        // Conseguir datos del usuario identificado
        $user = \Auth::user();

        // Conseguir objeto del comentario
        $comment = Comment::find($id); // Find saca un objeto por id

        //Comprobar si soy el dueño del comentario o de la publicacion

        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            
            $comment->delete();

            return redirect()->route('image.detail', ['id'=>$comment->image->id])
                         ->with([
                             'message'=> 'Comentario Eliminado'
                         ]);
        }else{

            return redirect()->route('image.detail', ['id'=>$comment->image->id])
                         ->with([
                             'message'=> 'El comentario no logro eliminarse'
                         ]);
        }
        
    }
}
