<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Like;
use App\Comment;
use Illuminate\Http\Response;

class ImageController extends Controller{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('image.create');
    }

    public function save(Request $request){

        //Validación

        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path'  => 'required|image'
        ]);
        

        $image_path = $request->file('image_path');
        $description = $request->input('description');

        $user = \Auth::user();

        $image = new Image();

        $image->user_id = $user->id;
        $image->description = $description;
        
        //subir Imagen

        if($image_path){

            $image_path_name = time().$image_path->getClientOriginalName();

            Storage::disk('images')->put($image_path_name, File::get($image_path)); //Guardar imagen en la carpeta image en storage

            $image->image_path  = $image_path_name;
        }

        $image->save();

        return redirect()->route('home')->with([
            'message'=>'La foto ha sido subida correctamente !!'
        ]);

    }

    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id){

        $image = Image::find($id);

        return view('image.detail', [
            'image'=> $image
        ]);
    }

    public function delete($id){
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        if($user && $image && $image->user_id == $user->id){

            //Eliminar comentarios

            if($comments && count($comments) >= 1){
                foreach($comments as $comment ){
                    $comment->delete();
                }
            }

            //Eliminar Likes

            if($likes && count($likes) >= 1){
                foreach($likes as $like ){
                    $like->delete();
                }
            }

            //Eliminar ficheros de imagen de storage

            Storage::disk('images')->delete($image->image_path);

            //Eliminar registro de la imagen

            $image->delete();

            $message = array('message'=>'Se ha borrado la imagen');

        }else{

            $message = array('message'=>'No se ha podido borrar la imagen');

        }

        return redirect()->route('home')->with($message);
    }

    public function edit($id){
        $user  = \Auth::user();
        $image = Image::find($id);

        if($user && $image && $image->user->id == $user->id){

            return view('image.edit', [
                    'image'=>$image
                ]);

        }else{

            return redirect()->route('home');
        }
    }

    public function update(Request $request){

        $validate = $this->validate($request, [
            'image_path'  => 'image'
        ]);
        
        $image_id   = (int) $request->input('image_id');
        $image_path =       $request->file('image_path');
        $description=       $request->input('description');

        //Buscar Imagen a actualizar

            $image = Image::find($image_id);
            $image->description = $description;

        //Subir Imagen

        if($image_path){

            $image_path_name = time().$image_path->getClientOriginalName();

            Storage::disk('images')->put($image_path_name, File::get($image_path)); //Guardar imagen en la carpeta image en storage

            $image->image_path  = $image_path_name;
        }

        //Actualizar Registro
        
        $image->update();

        return redirect()->route('image.detail', ['id'=>$image_id])
                         ->with(['message'=> 'Datos Actualizados']);       

    }
}
