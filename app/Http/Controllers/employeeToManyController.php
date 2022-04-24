<?php

namespace App\Http\Controllers;

use App\Http\Requests\employeeToManyRequest;
use Illuminate\Http\Request;
use App\Models\PhoneMany;
use App\Models\Member;
use DataTables;
use DB;


class employeeToManyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PhoneMany::with('oneMemberToManyMember');
            return Datatables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('oneMemberToManyMember', function (PhoneMany $phone) {
                return $phone->oneMemberToManyMember->name;
            })
            ->addColumn('oneMemberToManyMemberEmail', function (PhoneMany $phone) {
                return $phone->oneMemberToManyMember->email;
            })
            ->addColumn('oneMemberToManyMemberAddress', function (PhoneMany $phone) {
                return $phone->oneMemberToManyMember->address;
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
            ->rawColumns(['oneMemberToManyMember','oneMemberToManyMemberEmail','oneMemberToManyMemberAddress','action'])
            ->make(true);
        }
        return view('employee_to_many');
    }

    public function getMember(Request $request){
        $search = $request->search;
        if($search == ''){
           $members = Member::get();
        }else{
           $members = Member::where('name', 'like', '%' .$search . '%')->get();
        }
  
        $response = array();
        foreach($members as $member){
           $response[] = array(
                "id"=>$member->id,
                "text"=>$member->name
           );
        }
        return response()->json($response); 
    } 


    public function create(employeeToManyRequest $request)
    { 
        $phone = new PhoneMany();
        $phone->member_id =  $request->member_id;
        $phone->role =  'member employee';
        $phone->phone_number =  $request->phone_number;
        $phone->save();

        return response()->json(['message'=>'success !']);
    }

    public function edit(Request $request, $id)
    {
        $phone = PhoneMany::with('oneMemberToManyMember')->find($id);

        return Response()->json($phone);
    }

    public function update(employeeToManyRequest $request, $id)
    { 
        $phone = PhoneMany::find($id);
        $phone->member_id =  $request->member_id;
        $phone->phone_number =  $request->phone_number;
        $phone->save();

        return response()->json(['message'=>'success !']);
    }

    public function delete($id)
    {
        $phone = PhoneMany::find($id);
        $phone->delete();
        return response()->json(['message'=>'success !']);
    }
}
