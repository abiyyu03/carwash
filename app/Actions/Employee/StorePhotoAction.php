<?php 
namespace App\Actions\Employee;

use Illuminate\Http\Request;
use App\Models\{Employee, User, Role, WorkDetail, TransactionDetail};
use App\Actions\Employee\{StoreUserAction, StorePhotoAction};
use Image;

class StorePhotoAction
{
    public $filename;
    function executeEmployee(Request $request)
    {
        $image = $request->file('employee_photo');
        $this->filename = $image->getClientOriginalName();

        $image->move(public_path().'/img/img_temp/',$this->filename);
        $image_compressed = Image::make(public_path().'/img/img_temp/'.$this->filename);
        $image_compressed->fit(354,472);
        $image_compressed->save(public_path('/img/employee/'.$this->filename));
        unlink(public_path('/img/img_temp/'.$this->filename));

    }
}