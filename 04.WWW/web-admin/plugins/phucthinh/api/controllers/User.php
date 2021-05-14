<?php

namespace PhucThinh\API\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use RainLab\User\Models\User As UserModel;
use Rainlab\User\Models\UserGroup;
use PhucThinh\API\Transformers\UserTransformer;
use JWTAuth;
use Illuminate\Support\Facades\Storage;

/**
 * User Back-end Controller
 */
class User extends General {

    protected $userRepository;

    public function __construct(UserModel $user) {
        $this->userRepository = $user;
    }
    
    public function login(Request $request) {
        try {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $now = date('Y-m-d H:i:s');
            $ipFactory = $request->get('ip_factory');
            $username = $request->get('username');
            $password = $request->get('password');            
            $credentials = $request->only('username', 'password');
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->respondWithError('Username or password incorrect', self::HTTP_INTERNAL_SERVER_ERROR);
            }
            $user = $this->userRepository->where('username', $username)->first();            
                        
            if ($user->is_activated == 0) {
                return $this->respondWithError('The account has not been activated. Please contact the admin', self::HTTP_INTERNAL_SERVER_ERROR);
            }
            if($user->user_factory){
                $IP = $user->user_factory->ip;
                if($ipFactory != $IP)
                    return $this->respondWithError('IP Factory incorrect', self::HTTP_INTERNAL_SERVER_ERROR);
            }
            if (Hash::check($password, $user->password)) {
                $userModel = JWTAuth::authenticate($token);
                $user->last_login = $now;
                $user->save();

                $results = fractal($user, new UserTransformer())->toArray();
                if ($userModel->methodExists('getAuthApiSigninAttributes')) {
                    $user = $userModel->getAuthApiSigninAttributes();
                } else {
                    $token = JWTAuth::fromUser($user);
                    $user->access_token = $token;
                }
                $results['data']['access_token'] = $token;
                return $this->respondWithSuccess($results, "Login succesful!");
            } else {
                return $this->respondWithError('Username or password incorrect', self::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }
    public function logout(Request $request) {
        try {
            $token = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $token);
            $user = JWTAuth::authenticate($token);
            
            //Store Log
            $userId = $user->id;            
            $dataPost = $request->all();        
            JWTAuth::invalidate();
            return $this->respondWithMessage('Logout succesful!');
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    public function forgotPassWord(Request $request) {
        try {
            $username = $request->get('username');
            $user = $this->userRepository->where('username', $username)->first();            
            
            //Store Log
            $userId = $user->id;            
            
            $password = HelperClass::randomString(6);
            $user->password = $password;
            $user->password_confirmation = $password;
            $user->reset_password_code = $password;
            $user->change_password = 0;
            $user->is_activated = 0;
            $user->save();

            return $this->respondWithMessage("Reset Password succesfully!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    
    public function changePassword(Request $request) {
        try {
            
            $newPassword = $request->get('new_password');
            $confirmPassword = $request->get('confirm_password');
            $userToken = JWTAuth::parseToken()->authenticate();
            $user = $this->userRepository->find($userToken->id);
            if ($newPassword != $confirmPassword) {
                return $this->respondWithError('Password confirmation does not match!', self::HTTP_BAD_REQUEST);
            }
            $user->password = $newPassword;
            $user->password_confirmation = $confirmPassword;
            $user->change_password = 1;
            $user->save();
            
            //Store Log
            $userId = $user->id;            
            $dataPost = $request->all();            
            HelperClass::storeLog('Change Password', $dataPost, $userId);

            return $this->respondWithMessage("Change Password succesfully!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }
    

}
