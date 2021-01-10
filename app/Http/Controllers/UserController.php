<?php

namespace App\Http\Controllers;

use App\User;
use App\UserFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mockery\Exception;

class UserController extends Controller

{

    public function uploadFile(Request $request){
        try {
            $userId = $request->query('user_id');
            if(!$userId)
                throw new Exception('Field user_id is required', 400);
            $user = User::find($userId);
            if(!is_object($user))
                throw new Exception('User not found', 404);
            $file = $request->file('file_name');
            if(!$file)
                throw new Exception('Field file_name is required', 400);
            $filename = $file->getClientOriginalName();
            \Storage::disk('public')->put($filename, \File::get($file));
            $post['user_id'] = $user['id'];
            $post['file_name'] = $filename;
            $post['url'] = \Storage::url('app/public/'.$filename);
            $post['created_at'] = Carbon::now();
            $idFile = UserFile::create($post)->id;
            $response = [
                'code' => 201,
                'body' => [
                    'user_id' => $userId,
                    'upload_file' => [
                        UserFile::where('id', '=', $idFile)->get()
                    ],
                    'files' => UserFile::where('user_id', '=', $userId)->orderBy('created_at', 'ASC')->orderBy('file_name', 'ASC')->get()
                ]
            ];
        } catch (\Exception $e) {
            $response = [
                'code' => (empty($e->getCode())) ? 500 : $e->getCode(),
                'body' => [
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]
            ];
        } finally {
            return response()->json($response['body'], $response['code']);
        }
    }

    public function listFiles($userId = ''){
        try {
            if(!$userId)
                throw new Exception('Field user_id is required', 400);
            $user = User::find($userId);
            if(!is_object($user))
                throw new Exception('User not found', 404);
            $response = [
                'code' => 200,
                'body' => [
                    'user_id' => $userId,
                    'files' => UserFile::where('user_id', '=', $userId)->orderBy('created_at', 'ASC')->orderBy('file_name', 'ASC')->get()
                ]
            ];
        } catch (\Exception $e) {
            $response = [
                'code' => (empty($e->getCode())) ? 500 : $e->getCode(),
                'body' => [
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]
            ];
        } finally {
            return response()->json($response['body'], $response['code']);
        }
    }

    public function listUsers(){
        try {
            foreach(User::all() as $user){
                $files[] = [
                    'user_id' => $user->id,
                    'files' => UserFile::where('user_id', '=', $user->id)->orderBy('created_at', 'ASC')->orderBy('file_name', 'ASC')->get()
                ];
            }
            $response = [
                'code' => 200,
                'body' => $files
            ];
        } catch (\Exception $e) {
            $response = [
                'code' => (empty($e->getCode())) ? 500 : $e->getCode(),
                'body' => [
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]
            ];
        } finally {
            return response()->json($response['body'], $response['code']);
        }
    }
}
