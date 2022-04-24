<?php

namespace App\Http\Controllers;

use App\Http\Requests\adminHasOneRequest;
use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Member;
use DataTables;
use DB;

class adminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Phone::with('memberToMember');
            return Datatables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('memberToMember', function (Phone $phone) {
                return $phone->memberToMember->name;
            })
            ->addColumn('memberToMemberEmail', function (Phone $phone) {
                return $phone->memberToMember->email;
            })
            ->addColumn('memberToMemberAddress', function (Phone $phone) {
                return $phone->memberToMember->address;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="#" class="editPhone" data-id='.$row->id.' data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="fa fa-edit fa-fw text-warning"></i></a> &nbsp;
                <a href="#" data-id='.$row->id.' class="delete"><i class="fa fa-trash fa-fw text-danger"></i></a> &nbsp;';
                return $btn;
            })
            ->filter(function ($instance) use ($request) {
                if ($request->get('role')) {
                    $instance->where('role', $request->get('role'));
                }
                if (!empty($request->get('search'))) {
                     $instance->where(function($w) use($request){
                        $search = $request->get('search');
                        $w->orWhere('phone_number', 'LIKE', "%$search%")
                        ->orWhere('role', 'LIKE', "%$search%");
                    });
                }
            })
            ->rawColumns(['memberToMember','memberToMemberEmail','memberToMemberAddress','action'])
            ->make(true);
        }
        return view('admin');
    }

    public function create(adminHasOneRequest $request)
    { 
        $member = new Member();
        $member->name =  $request->name;
        $member->email =  $request->email;
        $member->address =  $request->address;
        $member->save();

        $phone = new Phone();
        $phone->member_id =  $member->id;
        $phone->role =  'member admin';
        $phone->phone_number =  $request->phone_number;
        $phone->save();

        return response()->json(['message'=>'success !']);
    }

    public function edit(Request $request, $id)
    {
        $phone = Phone::with('memberToMember')->find($id);

        return Response()->json($phone);
    }

    public function update(adminHasOneRequest $request, $id)
    { 
        DB::beginTransaction();

        $member = Member::find($id);
        $member->name =  $request->name;
        $member->email =  $request->email;
        $member->address =  $request->address;
        $member->save();

        if (!$member) {
            DB::rollback();
        }

        $phone = Phone::where('member_id',$id)->update([
            'phone_number' => $request->phone_number
        ]);

        if (!$phone) {
            DB::rollback();
        }

        DB::commit();

        return response()->json(['message'=>'success !']);
    }

    public function delete($id)
    {
        $member = Member::find($id);
        $member->delete();
        return response()->json(['message'=>'success !']);
    }
}
