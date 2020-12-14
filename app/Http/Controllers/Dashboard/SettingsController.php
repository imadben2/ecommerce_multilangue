<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{

    public function editShipingMethods($type)
    {

        if ($type === 'free')

           $shiping_methode = Setting::where('key', 'free_shiping_label')->first();


         else if ($type === 'inner')

            $shiping_methode = Setting::where('key', 'local_label')->first();


         else if ($type === 'outer')

            $shiping_methode = Setting::where('key', 'outer_label')->first();

         else
             $shiping_methode = Setting::where('key', 'free_shiping_label')->first();


             return  view('dashborad.settings.shippings.edit',compact('shiping_methode'));



    }

    public function updateShippingMethods(ShippingsRequest $request,$id){

        try{


            $shipping_method=Setting::find($id);
            DB::beginTransaction();
            $shipping_method->update(['plain_value'=>$request->plain_value]);
            //save translation
            $shipping_method->value=$request->value;
            $shipping_method->save();
            DB::commit();
            return redirect()->back()->with(['success'=>'تم التحديث بنجاح']);

        }
        catch(\Exception $sex){
            return redirect()->back()->with(['error'=>'هناك خطأ ما يرجى المحاولة فيما بعد']);

            DB::rollback();
        }



    }
}
