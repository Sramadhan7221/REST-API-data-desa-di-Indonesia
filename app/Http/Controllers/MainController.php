<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddDesaRequest;
use App\Http\Requests\GetDesaRequest;
use App\Http\Requests\UpdateDesaRequest;
use App\Http\Resources\VillageCollection;
use App\Models\IndonesiaVillageModel;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function villageList(GetDesaRequest $request)
    {
        $page = $request->page ?? 1;
        $size = $request->size ?? 10;

        $villageList = IndonesiaVillageModel::query()
            ->select('indonesia_villages.id as id_village','indonesia_villages.name as village_name','indonesia_villages.code as village_code','district.code as district_code','district.name as district_name','cities.code as city_code', 'cities.name as city_name', 'prov.code as province_code','prov.name as province_name')
            ->leftJoin('indonesia_districts as district','indonesia_villages.district_code','=','district.code')
            ->leftJoin('indonesia_cities as cities','district.city_code','=','cities.code')
            ->leftJoin('indonesia_provinces as prov','cities.province_code','=','prov.code');

        if($request->province_code){
            $villageList = $villageList->whereRaw("LEFT(indonesia_villages.code,2) = '?'",[$request->province_code]);
        }
        if($request->city_code){
            $villageList = $villageList->whereRaw("LEFT(indonesia_villages.code,4) = '?'",[$request->city_code]);
        }
        if($request->district_code){
            $villageList = $villageList->where("indonesia_villages.district_code",$request->district_code);
        }
        if($request->keyword){
            $villageList = $villageList->where("indonesia_villages.name","LIKE",'%'.strtoupper($request->keyword).'%');
        }

        $data = $villageList->offset((intval($page)-1) * intval($size))
        ->limit(intval($size))
        ->get();

        return response()->json([
            'status' => true,
            'message' => "Village Updated successfully!",
            'villages' => $data
        ], 200);
    }

    public function village($id)
    {
        $village = IndonesiaVillageModel::query()
            ->select('indonesia_villages.id as id_village','indonesia_villages.name as village_name','indonesia_villages.code as village_code','district.code as district_code','district.name as district_name','cities.code as city_code', 'cities.name as city_name', 'prov.code as province_code','prov.name as province_name')
            ->leftJoin('indonesia_districts as district','indonesia_villages.district_code','=','district.code')
            ->leftJoin('indonesia_cities as cities','district.city_code','=','cities.code')
            ->leftJoin('indonesia_provinces as prov','cities.province_code','=','prov.code')
            ->where("indonesia_villages.id",$id)->first();
        
        return response()->json([
            'status' => true,
            'message' => "Village Updated successfully!",
            'village' => $village
        ], 200);
    }

    public function addVillage(AddDesaRequest $request) 
    {
        $data = $request->all();
        $data['meta'] = $data['meta'] ? json_encode($data['meta']) : null;
        try {
            $village = IndonesiaVillageModel::create($data);
            return response()->json([
                'status' => true,
                'message' => "Village Created successfully!",
                'village' => $village
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => "Opps ,Something wrong!",
                'error' => $th->getCode()
            ], 400);
        }
    }

    public function updateVillage($id,UpdateDesaRequest $request)
    {
        try {
            //code...
            IndonesiaVillageModel::where('id',$id)->update($request->all());

            $selectedVillage = IndonesiaVillageModel::query()
                ->select('indonesia_villages.id as id_village','indonesia_villages.name as village_name','indonesia_villages.code as village_code','district.code as district_code','district.name as district_name','cities.code as city_code', 'cities.name as city_name', 'prov.code as province_code','prov.name as province_name')
                ->leftJoin('indonesia_districts as district','indonesia_villages.district_code','=','district.code')
                ->leftJoin('indonesia_cities as cities','district.city_code','=','cities.code')
                ->leftJoin('indonesia_provinces as prov','cities.province_code','=','prov.code')
                ->where("indonesia_villages.id",$id)->first();

            return response()->json([
                'status' => true,
                'message' => "Village Updated successfully!",
                'village' => $selectedVillage
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Opps ,Something wrong!",
                'error' => $th->getCode()
            ], 400);
        }
    }

    public function deleteDesa($id)
    {
        try {
            IndonesiaVillageModel::where('id',$id)->delete();
            return response()->json([
                'status' => true,
                'message' => "Village Deleted successfully!"
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Opps ,Something wrong!",
                'error' => $th->getCode()
            ], 400);
        }
    }
}
