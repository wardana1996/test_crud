<?php

namespace App\Http\Controllers;

use App\Http\Requests\employeeManyToManyRequest;
use Illuminate\Http\Request;
use App\Models\Brand_Member;
use App\Models\Brand;
use App\Models\Member;
use DataTables;

class employeeManyToManyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand_Member::join('member', 'member_brand.member_id','member.id')
            ->join('brand', 'member_brand.brand_id','brand.id')
            ->select(['member_brand.id','member_id','brand_id' ,'member.name', 'brand.brand_name' , 'brand.description']);
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a href="#" class="editBrand" data-id='.$row->id.' data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="fa fa-edit fa-fw text-warning"></i></a> &nbsp;
                <a href="#" data-id='.$row->id.' class="delete"><i class="fa fa-trash fa-fw text-danger"></i></a> &nbsp;';
                return $btn;
            })
            ->filter(function ($instance) use ($request) {
                if ($request->get('brand_id')) {
                    $instance->where('brand_id', $request->get('brand_id'));
                }
                if (!empty($request->get('search'))) {
                     $instance->where(function($w) use($request){
                        $search = $request->get('search');
                        $w->orWhere('name', 'LIKE', "%$search%")
                        ->orWhere('brand_id', 'LIKE', "%$search%");
                    });
                }
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('employee_many_to_many');
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

    public function create(employeeManyToManyRequest $request)
    { 
        $brand_member = new Brand_Member();
        $brand_member->member_id =  $request->member_id;
        $brand_member->brand_id =  $request->brand_id;
        $brand_member->save();

        return response()->json(['message'=>'success !']);
    }

    public function edit(Request $request, $id)
    {
        $where = array('member_brand.id' => $request->id);
        $brand_member = Brand_Member::join('member', 'member_brand.member_id','member.id')
            ->join('brand', 'member_brand.brand_id','brand.id')
            ->select(['member_brand.id','member_id','brand_id' ,'member.name', 'brand.brand_name' , 'brand.description'])
            ->where($where)->first();
        return Response()->json($brand_member);
    }

    public function update(employeeManyToManyRequest $request, $id)
    { 
        $brand_member = Brand_Member::find($id);
        $brand_member->member_id =  $request->member_id;
        $brand_member->brand_id =  $request->brand_id;
        $brand_member->save();

        return response()->json(['message'=>'success !']);
    }

    public function delete($id)
    {
        $phone = Brand_Member::find($id);
        $phone->delete();
        return response()->json(['message'=>'success !']);
    }
}
