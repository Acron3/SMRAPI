<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Login extends ResourceController
{
   use ResponseTrait;
   
   public function index()
   {
      $email             = $this->request->getVar('email');
      $password          = $this->request->getVar('password');

      $userModel = new UserModel;
      $adminModel = new AdminModel;
      
      $user = $userModel->where('email', $email)->first();
      $admin = $adminModel->where('email', $email)->first();
      
      if (!$user && !$admin) {
         return $this->respond(['status' => false, 'message' => 'Email salah'], 401);
      }

      if (!password_verify($password, ($user ? $user['password'] : null)) && !password_verify($password, ($admin ? $admin['password'] : null))) {
         return $this->respond(['status' => false, 'message' => 'Password salah'], 401);
      }

      if($user){
         $data = $user;
         $data['role'] = 'user';
      }else{
         $data = $admin;
         $data['nama'] = "Admin";
         $data['role'] = 'admin';
      }

      $key = getenv('TOKEN_SECRET');

      $iat = time();

      $exp = $iat + 3600;

      $payload = array(
         "iss" => "Sistem Informasi Pengguna",
         "aud" => $data['id'],
         "sub" => $data['nama'],
         "iat" => $iat, //Time the JWT issued at
         "exp" => $exp, // Expiration time of token
         "email" => $data['email'],
         "role" => $data['role']
      );

      $token = JWT::encode($payload, $key, "HS256");
      return $this->respond(['status' => true, 'token' => $token, 'user' => $data,'token_exp'=>$exp], 200);
   }

   public function refresh_token()
   {
      try {
         $key = getenv('TOKEN_SECRET');
         $header = $this->request->getServer('HTTP_AUTHORIZATION');
         if (!$header) {
               return $this->failUnauthorized('Akses ditolak, tidak ada header otorisasi yang diberikan');
         }

         $oldToken = explode(' ', $header)[1];
         $decoded = JWT::decode($oldToken, new Key($key, 'HS256'));

         // Generate new token
         $newData = [
               'iat' => time(),
               'exp' => time() + 3600, // 1 jam kedaluwarsa
               'sub' => $decoded->sub,
               'email' => $decoded->email,
               'role' => $decoded->role
         ];

         $newToken = JWT::encode($newData, $key, 'HS256');

         return $this->respond(['token' => $newToken, 'token_exp' => $newData['exp']]);
      } catch (\Exception $e) {
         return $this->fail('Gagal memperbarui token: ' . $e->getMessage());
      }
   }
}