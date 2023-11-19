<?php

namespace App\Http\Controllers\api\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Traits\ApiTrait;

class SetAvatarController extends Controller
{
    use ApiTrait;
    public function setAvatar(Request $request) {
        $image = $request->image;
        $imageName = time().$image->getClientOriginalName();
        $img = $image->move("uploads",$imageName);
        $user = auth()->user();
        $user->image = $img;
        $user->save();

        return $this->successResponse("image uploaded");
    }
}
