<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Account\StoreAccountRequest;
use App\Http\Requests\Account\UpdateAccountRequest;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends ApiController
{
    /**
     * Construct
     */
    public function __construct(User $user, Auth $auth, UserMeta $userMeta)
    {
        $this->user = $user;
        $this->user_meta = $userMeta;
        $this->auth = $auth;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;
        if (!empty($status) || !empty($search)) {
            if (!empty($search)) {
                8 -$users = $this->user->where('status', 'LIKE', '%' . $status . '%')
                    ->where('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%')
                    ->with('meta')
                    ->paginate(10);
                return response()->json($users, 200);
            }
            $users = $this->user->where('status', 'LIKE', '%' . $status . '%')
                ->with('meta')
                ->paginate(10);
            return response()->json($users, 200);
        } else {
            $user = $this->user->with('meta')->paginate(10);
            return response()->json($user, 200);
        }

        // LÀM ƠN ĐỪNG SỬA CODE
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:3',
            'phone'  => 'required',
        ]);
        $user = new User([
            'name' => $request->name,
            'roles' => $request->roles,
            'email' => $request->email,
            'parent_id' => $request->parent_id,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            // 'remember_token' => \Str::random(60)
        ]);
        $user->save();
        return response()->json([
            'message' => 'Đăng ký tài khoản thành công!',
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // LÀM ƠN ĐỪNG SỬA CODE
        try {

            $users = $this->user->where('id', $id)->with('meta')->first();
            return response()->json($users);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, $id)
    {
        try {
            $account = $this->user->findOrFail($id)->update($request->all());
            return response()->json($account,200);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
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
            $user = $this->user->findOrFail($id)->destroy($id);
            return response()->json($user, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    public function changePassword(Request $request)
    {

        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|min:6|max:50|',
            'confirm_password' => 'required|same:new_password'
        ];
        $customMessages = [
            'required' => 'Không được để trống',
            'same' => 'Không chính xác',
        ];
        $this->validate($request, $rules, $customMessages);
        if (Hash::check($request->current_password, auth()->user()->password)) {
            $user = $this->user->find(auth()->user()->id);
            $user->password = Hash::make($request->new_password);
            $user->save();
            return response()->json(['status' => true], 200);
        } else {
            return response()->json(['errors' => ['current_password' => 'Mật khẩu không chính xác']], 422);
        }
    }

    public function getUsers(Request $request)
    {
        $search = $request->search;
        $status = $request->status;
        if (!empty($status) || !empty($search)) {
            if (!empty($search)) {
                $users = $this->user->where('parent_id', $request->id)

                    ->where(function ($query) use ($search, $status) {
                        $query
                            ->where('phone', 'LIKE', '%' . $search . '%')
                            ->orWhere('email', 'LIKE', '%' . $search . '%');
                    })
                    ->with('meta')
                    ->paginate(10);

                return response()->json($users, 200);
            }
            if (!empty($status) && !empty($search)) {
                $users = $this->user->where('parent_id', $request->id)

                    ->where(function ($query) use ($search, $status) {
                        $query->where('status', $status)
                            ->where('phone', 'LIKE', '%' . $search . '%')
                            ->orWhere('email', 'LIKE', '%' . $search . '%');
                    })
                    ->with('meta')
                    ->paginate(10);

                return response()->json($users, 200);
            }
            $users = $this->user->where('parent_id', $request->id)
                ->where('status', $status)
                ->with('meta')
                ->paginate(10);

            return response()->json($users, 200);
        } else {
            $users = $this->user->where('parent_id', $request->id)
                ->with('meta')->paginate(10);

            return response()->json($users, 200);
        }
    }
}
