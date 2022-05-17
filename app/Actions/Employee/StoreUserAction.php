<?php
namespace App\Actions\Employee;

use Illuminate\Http\Request;
use App\Models\{Employee, User, Role, WorkDetail, TransactionDetail};
use App\Actions\Employee\{StoreUserAction, StorePhotoAction};

class StoreUserAction
{
    function __construct()
    {
        $this->user = new User();
    }
    function execute(Request $request)
    {
        $this->user->id_user = rand();
        $this->user->name = $request->employee_fullname;
        $this->user->email = $request->employee_email;
        $this->user->password = bcrypt($request->password);
        $this->user->role_id = $request->role_id;
        $this->user->save();
    }

    function idUser()
    {
        return $this->user->id_user;
    }

    function roleName()
    {
        return $this->user->role_id;
    }
}
