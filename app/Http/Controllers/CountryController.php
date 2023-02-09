<?php
namespace App\Http\Controllers;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use DataTables;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $country = Country::get();
            if($request->ajax()){
                $allData = DataTables::of($country)
                    ->addIndexColumn()
                    ->addColumn('action' , function($row){
                        $btn = '<button type="button" data-toggle="modal" data-id="'.$row->id.'"
                        data-country="'.$row->country.'" data-original-title="Edit" class="edit btn btn-primary btn-sm
                           editCountry" data-toggle="modal" data-target="#editnewcountry">Edit</button>';
                        $btn.= '<button type="button"  data-toggle="tooltip" data-id="'.
                            $row->id.'"data-original-title="Delete" class="edit btn btn-danger btn-sm
                        deleteCountry">Delete</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
                    return $allData;
               }
             return view('country' , compact('country'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function country_edit($id)
    {
        $country= Country::find($id);
        return response()->json($country);
    }
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Country::updateOrCreate(
            ['id'=>$request->country_id],
            ['country'=>$request->country]);
        return response()->json(['success'=>'Country Added Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function edit($id)
//    {
//        $country= Country::find($id);
//        return response()->json($country);
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function country_update(Request $request){
        $request->validate([
            'country_edit'=>'required'
        ]);
        // dd($request->all());
        $country=Country::find($request->country);
        $country->country=$request->country_edit;
        $country->save();
        return "success";
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Country::where('id',$id)->delete();
        return response()->json(['success'=>'Data Deleted Successfully']);
    }
}
