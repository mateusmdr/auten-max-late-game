<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EULAController extends Controller
{
    
    public function update(StoreEULARequest $request){
        $this->authorize('viewAny', User::class);

        $content = $request->file;
        $disk = Storage::disk('public');
        
        $disk->putFileAs('',$content,'eula.pdf');
        return $disk->url('eula.pdf');
    }

}
