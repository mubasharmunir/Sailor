<?php
namespace App\Http\Controllers;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use DataTables;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $city = City::with('Country')->get();
        // dd($city);
        $countries = Country::get();
        if($request->ajax()){
            $allData = DataTables::of($city)

            ->addIndexColumn()
            ->addColumn('action' , function($row){
                $btn = '<button type="button" data-toggle="modal" data-id="'.$row->id.'"
                    data-city="'.$row->city.'" data-country="'.$row->country.'"  data-original-title="Edit" class="edit btn btn-primary btn-sm
                       editCity" data-toggle="modal" data-target="#editCityModel">Edit</button>';
                $btn.= '<button type="button"  data-toggle="tooltip" data-id="'.
                    $row->id.'"data-original-title="Delete" class="edit btn btn-danger btn-sm
                    deleteCity">Delete</button>';
                return $btn;
            })
            ->addColumn('country_id', function ($city) {
                return $city->country->country;
            })
            ->rawColumns(['action'])
            ->make(true);
        return $allData;
        }
        return view('city' , compact('city', 'countries'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function city_edit($id)
    {
        $city= City::find($id);
//        $country_id= Country::find($id);
        return response()->json($city);
    }

    public function city_update(Request $request)
    {
        $request->validate([
            'city_edit'=>'required'
        ]);
        $city=City::find($request->city_id);
        $city->city=$request->city_edit;
        $city->save();
        return "success";
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(CityRequest $request){
                //dd($request->all());
            $city=new City();
            $city->city=$request->city;
            $city->country_id=$request->country;
            $city->save();
//           City::create([
//                'city'=>$request->city,
//                'country_id'=>$request->country
//           ]);
           return response()->json(['success'=>'City Added SuccessFully']);
        }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
//    public function show(City $city)
//    {
//        //
//    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
//    public function edit(City $city)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request, City $city)
//    {
//        //
//    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $id)
    {
        City::where('id' , $id)->delete();

        return response()->json(['success'=>'Data Deleted Successfully']);
    }
    public function getAllCountries()
    {
        $countries = Country::all();
        return response()->json($countries);
    }
}
