<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\ControladorBase as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;


class ControladorRegistro extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombres' => 'required',
            'apellidos' => 'required',
            'cedula' => 'required',
            'password' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Error de validación.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        return response()->json([
            'created'   =>  true,
            'data'      =>  $user
        ], 201);
    }
}