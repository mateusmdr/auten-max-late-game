<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EULAController extends Controller
{
    
    public function update(Request $request){
        $this->authorize('viewAny', User::class);

        $this->validate($request, ['file' => 'required|mimes:pdf|max:10000']);

        $content = $request->file;
        $disk = Storage::disk('public');
        
        $disk->putFileAs('',$content,'eula.pdf');
        return $disk->url('eula.pdf');
    }

}
