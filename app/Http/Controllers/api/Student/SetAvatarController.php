<?php

namespace App\Http\Controllers\api\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Traits\ApiTrait;

class SetAvatarController extends Controller
{
    use ApiTrait;

    // upload an avatar image

    public function setAvatar(Request $request)
    {
        $image = $request->image;
        $image->move('uploads', time() . '.' . $image->getClientOriginalExtension());
        $data['image'] = time() . '.' . $image->getClientOriginalExtension();

        // $image = $request->image;
        // $imageName = time() . $image->getClientOriginalName();
        // $img = $image->move("uploads", $imageName);
        $user = auth()->user();
        $user->update($data);
        // $user->image = base64_decode($img);
        $data = (object)[
            'image' => $user->imageLink,
        ];


        return $this->dataResponse("image uploaded",$data );
    }
}
