<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * 获取老师信息
     *
     * @return \Illuminate\Contracts\Support\Response
     */
    public function teacherInfo(Request $request)
    {
        return \response($request->user());
    }

    /**
     * 编辑老师信息
    *
     * @return \Illuminate\Contracts\Support\Response
     */
    public function teacherEdit(Request $request, User $user)
    {
        $this->validate($request, [
            'avatar' => 'required|max:255|min:4',
            'mobile' => 'required|size:11',
            'person_tile' => 'required',
            'idcard' => 'required',
            'id_font' => 'required',
            'id_back' => 'required',
        ]);
        $user->update(request(['avatar', 'mobile', 'person_title', 'idcard', 'id_font', 'id_back']));
        return \response($user);
    }

    protected function registered(Request $request, $user)
    {
        $user->generateToken();

        return response()->json(['data' => $user->toArray()], 201);
    }
}
