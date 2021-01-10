<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function uploadFile(Request $request){
        $file = $request->file('file');
        $idUser = $request->query('user_id');
        $user = User::find($idUser);
        $data = [
            'status' => 'success',
            'code' => 200,
            'message' => $user
        ];
        /*if($file){
            $imageName = time().'_'.$idUser.'_'.$file->getClientOriginalName();
            \Storage::disk('public')->put($imageName, \File::get($file));
            $data = [
                'status' => 'success',
                'code' => 200,
                'imageName' => $imageName,
                'message' => 'File upload'
            ];
        }else{
            $data = [
                'status' => 'error',
                'code' => 400,
                'message' => 'Failed'
            ];
        }*/
        return response()->json($data, $data['code']);
    }
}
