<?php
namespace App\Http\Controllers\Publish;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Publish\AuthPublishResource;
use App\Models\User;
use App\Models\PasswordResets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Socialite;
use Str;

class AuthPublishController extends ApiController
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:3',
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => \Str::random(60)
        ]);
        $user->save();
        $forgotLink =  getenv('APP_URL') .'/login?token=' . $user->remember_token;
        $data = [
            'email' => $request->email,
            'forgotLink' => $forgotLink
        ];
        $result = \Mail::send('mailregister', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email']);
            $message->subject('[HATONET] ' . 'Thông báo mới!');
        });

        return response()->json([
            'message' => 'Đăng ký tài khoản thành công!',
        ], 201);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            $data = [
                'errors' => [
                    'message' => __('messages.login')
                ],
            ];
            return response()->json($data,422);
        }
        $user = User::where('email', $request->email)->first();
        if (!Hash::check($request->password, $user->password)) {
            throw new \Exception('Error in Login');
        }

        if ($user->status != 'active') {
            $data = [
                'errors' => [
                    'message' => __('messages.confirm')
                ],
            ];
            return response()->json($data,422);
        }
        $tokenResult = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            'user' => new AuthPublishResource(Auth::user()),
        ]);
    }

    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $isEmailExisted = User::where('email', $request->email)->first();
        if (!$isEmailExisted) {
            $data = [
                'errors' => [
                    'message' => __('messages.email_forgot')
                ],
            ];
            return response()->json($data,422);
        }

        $passwordReset = PasswordResets::updateOrCreate(
            ['email' => $request->email],
            ['token' => \Str::random(60)]
        );

        $passwordReset->save();

        $forgotLink = getenv('APP_URL') . '/reset?token=' . $passwordReset->token;
        $data = [
            'email' => $request->email,
            'forgotLink' => $forgotLink
        ];

        $result = \Mail::send('mailforgot', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email']);
            $message->subject('[HATONET] ' . 'Thông báo mới!');
        });

        return response()->json([
            'message' => 'Đăng ký tài khoản thành công!',
        ], 201);
    }
    public function confirm(Request $request){
        $request->validate([
            'token' => 'required|string',
        ]);
        $resetPassword = User::where('remember_token', $request->token)->first();
        if (!$resetPassword) {
            throw new \Exception('Token invalid');
        }

        $isTokenExpired = $resetPassword->updated_at->addHour(1)->isPast();
        if ($isTokenExpired) {
            throw new \Exception('Token expired');
        }
        $data = $resetPassword->update(['status' => 'active']);
        return response()->json($data, 200);
}
    public function reset (Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $resetPassword = PasswordResets::where('token', $request->token)->first();
        if (!$resetPassword) {
            throw new \Exception('Token invalid');
        }

        $isTokenExpired = $resetPassword->updated_at->addHour(1)->isPast();
        if ($isTokenExpired) {
            throw new \Exception('Token expired');
        }

        return response()->json($resetPassword);
    }
    public function change(Request $request)
    {
        $rules = [
            'email' => 'required|string|email',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password'
        ];
        $customMessages = [
            'required' => 'Không được để trống',
            'same' => 'Mật khẩu không trùng khớp',
            // 'regex'=> 'mật khẩu phải bao gồm chữ viết hoa, chứ viết thường, số và ký tự đặc bi ',
        ];
        $this->validate($request, $rules, $customMessages);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            throw new \Exception('User does not exist.');
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json(['status' => true], 200);

    }
    public function social($provider)
    {
        $social = Socialite::driver($provider)->redirect()->getTargetUrl();
        return response()->json(['url' => $social]);
    }
    public function callbackSocial($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        // service id
        $serviceId = $user->getId();
        // check account
        $isAccount = User::where("provider_id", $serviceId)->first();
        // dd($isAccount);
        // die();
        if (is_null($isAccount)) {
            $account = new User([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt($user->getId()),
                'provider_id' => $serviceId,
                'roles' => User::USER_ROLES['COMPANY'],
                'status' => User::USER_STATUS['PENDING'],
            ]);
            $account->save();
            Auth::login($account);
            $tokenResult = $account->createToken('authToken')->plainTextToken;
            return response()->json([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => new AuthPublishResource(Auth::user()),
            ]);
        } else {
            Auth::login($isAccount);
            $tokenResult = $isAccount->createToken('authToken')->plainTextToken;
            return response()->json([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => new AuthPublishResource(Auth::user()),
            ]);
        };

        // $request->session()->put('state',Str::random(40));
        // $result =  Socialite::driver('facebook');
        // if($provider === "github") {
        // dd(Socialite::driver($provider)->stateless()->user());
        // }else {
        //     // $user = Socialite::driver($provider)->user();
        //     // dd( $user);
        // }
        // $check = $request->query("type");

        // $social = Socialite::driver("facebook")->redirect()->getTargetUrl();

        // return response()->json(['url' =>$social]);
    }
}
