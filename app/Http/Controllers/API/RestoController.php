<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resto;
use Exception;
use App\Helpers\ApiFormatter;
use Validator;
use Illuminate\Support\Facades\Hash;

class RestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Resto::all();

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    /**
     * Login with given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => 'Validation error',
                'errors' => $validator->errors()->toArray()
            ], 422);
        }
        if (! $token = auth('resto')->attempt($validator->validated())) {
            return response()->json([
                'status' => false,
                'code' => 401,
                'error' => 'Login Failed. Please Check Your Username and Password'
            ], 401);
        }
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Login Success.',
            'data' => auth('resto')->user(),
        ], 200);
    }


     /**
     * Register2 a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register2(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama_pemilik' => 'required|string|between:2,255',
            'no_ktp' => 'required|string|between:2,255',
            'no_hp' => 'required|string|between:2,255',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Validation error',
                'errors' => $validator->errors()->toArray(),
            ], 400);
        }
        $user = Resto::create(array_merge(
                    $validator->validated(),
                    ['nama_outlet' => '---'],
                    ['no_telp_outlet' => '---'],
                    ['alamat' => '---'],
                    ['no_rek' => '---'],
                    ['bank' => '---'],
                    ['password' => Hash::make($request->password)]
                ));
        return response()->json([
            'status' => true,
            'code' => 201,
            'message' => 'Resto successfully registered',
            'data' => $user
        ], 201);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register3(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama_outlet' => 'required|string|between:2,255',
            'no_telp_outlet' => 'required|string|between:2,255',
            'alamat' => 'required|string|between:2,255',
            'no_rek' => 'required|string|between:2,255',
            'bank' => 'required|string|between:2,255',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Validation error',
                'errors' => $validator->errors()->toArray(),
            ], 400);
        }
        $user = Resto::where(['nama_outlet'=>'---','no_telp_outlet'=>'---'])->update(array_merge(
                    $validator->validated()
                ));
        return response()->json([
            'status' => true,
            'code' => 201,
            'message' => 'Behasil Daftar',
            'data' => $user
        ], 201);
    }
    

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Ok',
            'data' => auth('resto')->user(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $resto = Resto::create([
                'email' => $request->email,
                'password' => $request->password
            ]);

            $data = Resto::where('id', $resto->id)->get();

            if ($data) {
                return ApiFormatter::createApi(200, 'Success', $data);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Resto::all();

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $resto = Resto::findOrFail($id);

        $resto->update([
            'email' => $request->email,
            'password' => $request->password
        ]);

        $data = Resto::where('id', $resto->id)->get();

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    } catch (Exception $error) {
        return ApiFormatter::createApi(400, 'Failed');
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    try {
        $resto = Resto::findOrFail($id);

        $deleted = $resto->delete();

        if ($deleted) {
            return ApiFormatter::createApi(200, 'Success', $resto);
        } else {
            return ApiFormatter::createApi(400, 'Failed to delete Resto');
        }
    } catch (ModelNotFoundException $exception) {
        return ApiFormatter::createApi(404, 'Resto not found');
    } catch (Exception $exception) {
        return ApiFormatter::createApi(500, 'Failed');
    }
}
}