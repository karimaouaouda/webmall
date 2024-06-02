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

        $request->validate([
            'id_card' => ['required', 'mimes:' . implode('.', ['jpg', 'png', 'jpeg', 'jfif'])]
        ]);

        $user = null;
        $g = null;
        foreach( ['seller', 'client'] as $guard ){
            if( auth($guard)->check() ){
                $user = auth($guard)->user();
                $g = $guard;
            }
        }

        $id_path = ids_path($g);
        $file = $request->file('id_card');



        $path = Storage::putFile($id_path, $file );

        $user->storeID($path);

        return back();
    }


}
