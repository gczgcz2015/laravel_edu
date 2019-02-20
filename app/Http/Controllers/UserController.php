<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{

    /**
     * 获取平台所有老师
     */
    
    public function teachers(Request $request)
    {
        $pagesize = request('pagesize');
        return User::paginate($pagesize);
    }

    /**
     * 获取老师信息
     */
    public function teacherInfo(Request $request)
    {
        // Auth::user查询有缓存处理
        return Auth::user();
    }

    /**
     * 编辑老师信息
     */
    public function teacherEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|max:255|min:4',
            'mobile' => 'required|size:11',
            'person_title' => 'required',
            'idcard' => 'required',
            'id_font' => 'required',
            'id_back' => 'required',
        ]);
        if ($validator->fails()) {
            return \response()->json([
                'status' => 0,
                'response_time' => time(),
                'error_msg' => $validator->errors()
            ]);
        }
        $user = $request->user();
        $user->update(request(['avatar', 'mobile', 'person_title', 'idcard', 'id_font', 'id_back']));
        // 缓存处理
        // Cache::put($user->id, $user, 60*60);
        return $user;
    }

    /**
     * 注册成功后返回
     */
    protected function registered(Request $request, $user)
    {
        $user->generateToken();

        return response()->json(['data' => $user->toArray()], 201);
    }
}
