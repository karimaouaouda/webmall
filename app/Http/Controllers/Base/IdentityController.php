<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\ImageFile;

class IdentityController extends Controller
{


    public function upload(Request $request): RedirectResponse
    {

        if( !$request->has('id_card') || $request->file('id_card') == null ){
            return back()->withErrors([
                'the id card image must be present'
            ]);
        }
        $file = $request->file('id_card');

        $exts = ['png', 'jpg', 'jfif'];

        if( ! in_array($file->getClientOriginalExtension() , $exts) ){
            return back()->withErrors([
                'the id card image must be one of types : ' . implode(",", $exts)
            ]);
        }

        $filename = $file->getClientOriginalName();

        $user = null;
        $g = null;
        foreach( ['seller', 'client'] as $guard ){
            if( auth($guard)->check() ){
                $user = auth($guard)->user();
                $g = $guard;
            }
        }

        $id_path = ids_path($g);

        $path = Storage::disk('public')
                ->putFile($id_path, $file);

        $user->storeID($path);

        return back()->with('status', 'successfull added id card');
    }


}
