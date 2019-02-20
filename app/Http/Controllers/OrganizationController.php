<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Organization;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Http\Response;

class OrganizationController extends Controller
{
    /**
     * 创建机构
     */
    public function OrganizationCreate(Request $request) {

        $user = Auth::user();

        // 判断是否已创建机构
        $org = Organization::where('user_id', $user->id)->first();
        if ($org != null) {
            return Response::errorMessage('已创建机构');
        }
        $validator = Validator::make($request->all(), [
            'logo' => 'required|max:255|min:4',
            'address' => 'required',
            'bank' => 'required',
            'bank_card' => 'max:100|min:10',
        ]);
        if ($validator->fails()) {
            return Response::errorMessage($validator->errors());
        }
        $data = $request->all();
        $org = Organization::create([
            'user_id' => $user->id,
            'logo' => $data['logo'],
            'address' => $data['address'],
            'bank' => $data['bank'],
            'bank_card' => $request->input('bank_card', ''),
            'status' => 0,
            'reason' => '',
        ]);
        Cache::put('organization_'.$org->id, $org, 86400*30);
        return $org;
    }

    /**
     * 机构信息
     */
    public function OrganizationInfo(Request $request, $id)
    {
        $cache = Cache::get('organization_'.$id);
        if ($cache != null) {
            return $cache;
        }
        $org = Organization::find($id);
        return $org;
    }

    /**
     * 邀请老师
     */
    public function InviteTeacher(Request $request)
    {

    }
}
