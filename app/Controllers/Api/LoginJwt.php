<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\Api\MJwt;
use Firebase\JWT\JWT;

class LoginJwt extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function index()
    {


        $rules = [
            'username' => 'required',
            'password' => 'required|min_length[8]'
        ];

        if (!$this->validate($rules)) {
            $response = [
                'status' => false,
                'msg' => 'Form tidak lengkap atau terjadi kesalahan pada form'

            ];

            return  $this->respond($response);
        }


        $model = new MJwt();
        $user = $model->where('username', $this->request->getVar('username'))->first();

        if (!$user) {
            $response = [
                'status' => false,
                'msg' => 'Username atau password salah'

            ];

            return  $this->respond($response);
        };

        $verify  = password_verify($this->request->getVar('password'), $user['password']);
        if (!$verify) {
            $response = [
                'status' => false,
                'msg' => 'Username atau password salah'

            ];

            return  $this->respond($response);
        }

        $date   = date('Y-m-d H:i:s');
        $exp =  strtotime("+30 minutes", strtotime($date));



        $key = getenv('TOKEN_API');
        $payload = [

            'iat'  =>  strtotime($date),
            'nbf'  =>  strtotime($date),
            'exp'  => $exp,
            'id' => $user['id'],
            'username' => $user['username']
        ];

        $token = JWT::encode($payload, $key, 'HS256');

        try {
            $token = JWT::encode($payload, $key, 'HS256');

            $response = [
                'status' => true,
                'token' => $token

            ];
            return  $this->respond($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => false,
                'msg' => 'Terjadi Kesalahan'

            ];

            return  $this->respond($response);
        }
    }
}
