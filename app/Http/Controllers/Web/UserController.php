<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    // Sender Functions

    // Get Login Function
    public function getLogin(){
        return Inertia::render('login');
    }

    // Get Parcel Function
    public function getSenderParcels($id){
        return Inertia::render('sender/parcels', ['parcels' => Parcel::where('uid', $id)->get()]);
    }

    // Get Edit Parcel Function
    public function getEditSenderParcel($id){
        return Inertia::render('sender/edit-parcel', ['parcel' => Parcel::where('id', $id)->first()]);
    }


    // Biker Functions

    // Get Parcel Function
    public function getBikerParcels($id){
        return Inertia::render('biker/parcels', ['parcels' => Parcel::where('biker_id', $id)
                                                                    ->whereNotNull('pick_up')
                                                                    ->whereNotNull('drop_off')
                                                                    ->get()]);
    }

    // Get Edit Parcel Function
    public function getEditBikerParcel($id){
        return Inertia::render('biker/edit-parcel', ['parcel' => Parcel::where('id', $id)->first()]);
    }
}
