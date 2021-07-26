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
use Illuminate\Support\Str;

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
            /*$token = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $token);
			if($token){
				$user = JWTAuth::authenticate($token);			
				JWTAuth::invalidate();
			}         */  
            return $this->respondWithMessage('Logout succesful!');
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function forgotPassWord(Request $request) {
        try {
            $username = $request->get('username');
            $user = $this->userRepository->where('username', $username)->first();

            $password = HelperClass::randomString(6);
            $user->password = $password;
            $user->password_confirmation = $password;
            $user->reset_password_code = $password;
            $user->change_password = 0;
            $user->is_activated = 0;
            $user->save();

            return $this->respondWithMessage("Reset Password succesfully!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function changePassword(Request $request) {
        try {
            $newPassword = $request->get('new_password');
            $confirmPassword = $request->get('confirm_password');
            $userToken = JWTAuth::parseToken()->authenticate();
            $user = $this->userRepository->find($userToken->id);
            if ($newPassword != $confirmPassword) {
                return $this->respondWithError('Mật khẩu nhập lại không trùng khớp!', self::HTTP_INTERNAL_SERVER_ERROR);
            }
            $user->password = $newPassword;
            $user->password_confirmation = $confirmPassword;
            $user->save();

            return $this->respondWithMessage("Cập nhật mật khẩu thành công!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateAccount(Request $request) {
        try {
            $name = $request->get('name');
            $gender = $request->get('gender');
            $email = $request->get('email');
            $birthday = $request->get('birthday');
            $phone = $request->get('phone');
            $address = $request->get('address');
            $userToken = JWTAuth::parseToken()->authenticate();
            $user = $this->userRepository->find($userToken->id);
            $user->name = $name;
            $user->gender = $gender;
            $user->email = $email;
            $user->username = $email;
            $user->birthday = $birthday;
            $user->phone = $phone;
            $user->address = $address;
            $user->save();
            $results = fractal($user, new UserTransformer())->toArray();
            return $this->respondWithSuccess($results, "Update Account succesfully!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    public function updateAvatar(Request $request) {
        try {
            $userToken = JWTAuth::parseToken()->authenticate();
            $user = $this->userRepository->find($userToken->id);
            if ($user) {
                if ($request->hasFile('avatar')) {
                    $file = $request->avatar;
                    $arrFile = ['png', 'jpg', 'jpeg'];
                    $extension = Str::lower($file->getClientOriginalExtension());
                    if (in_array($extension, $arrFile)) {
                        $user->avatar = $request->file('avatar');
                        $user->save();
                        $data['avatar'] = $user->avatar->getPath();
                        $return['data'] = $data;
                        return $this->respondWithSuccess($return, "Avatar succesfully!");
                    } else {
                        return $this->respondWithError('File không hợp lệ!', self::HTTP_INTERNAL_SERVER_ERROR);
                    }
                } else {
                    return $this->respondWithError('File không hợp lệ!', self::HTTP_INTERNAL_SERVER_ERROR);
                }
            } else {
                return $this->respondWithError('Người Dùng không tồn tại!', self::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

}
