<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Organization;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
    /**
     * 获取老师信息
     */
    public function OrganizationCreate(Request $request) {

        $user = Auth::user();
        $org = Organization::where('user_id', $user->id)->get();
        if ($org != null) {
            return \response()->json([
                'status' => 0,
                'response_time' => time(),
                'error_msg' => '已创建机构'
            ]);
        }
        $validator = Validator::make($request->all(), [
            'logo' => 'required|max:255|min:4',
            'address' => 'required',
            'bank' => 'required',
            'bank_card' => 'max:100|min:10',
        ]);
        if ($validator->fails()) {
            return \response()->json([
                'status' => 0,
                'response_time' => time(),
                'error_msg' => $validator->errors()
            ]);
        }
        $data = $request->all();
        return Organization::create([
            'logo' => $data['logo'],
            'address' => $data['address'],
            'bank' => $data['bank'],
            'bank_card' => $request->input('bank_card', ''),
            'status' => 0,
            'reason' => '',
            'user_id' => $user->id,
        ]);
    }
}
