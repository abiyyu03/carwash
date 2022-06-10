<?php 
namespace App\Actions\Product;

use Illuminate\Http\Request;
use App\Models\{Product, User, Role, WorkDetail, TransactionDetail};
// use App\Actions\Employee\{StoreUserAction, StorePhotoAction};
use Image;

class StoreProductImageAction
{
    public $filename;
    function executeProduct(Request $request)
    {
        $image = $request->file('product_image');
        $this->filename = $image->getClientOriginalName();

        $image->move(public_path().'/img/img_temp/',$this->filename);
        $image_compressed = Image::make(public_path().'/img/img_temp/'.$this->filename);
        $image_compressed->fit(354,472);
        $image_compressed->save(public_path('/img/product/'.$this->filename));
        unlink(public_path('/img/img_temp/'.$this->filename));

    }
}