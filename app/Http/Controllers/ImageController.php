<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use Response;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ImageController extends Controller
{
	protected $rules = array(
    	'fichier' => 'mimes:jpeg,jpg,png|required|max:2048' 
    );

    public function updateCouverture(Request $request)
    {
    	$image = $request->file('fichier'); $token = $request->input('token');
        if($image->isValid())
        {
            $validator = Validator::make($request->all() , $this->rules);
            if ($validator->fails()) {
                return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
            }else{
            	$chemin = config('img.path');
            	$extension = $image->getClientOriginalExtension();
                do{
                   $nom = str_random(10) . '.' . $extension;
                }while(file_exists($chemin . '/' . $nom));
                $image->move($chemin, $nom);
				$loginController = new LoginController();
                $loginController->update_cover($nom , $token);
				return Response::json(array('nom' => $nom));
            }
        }        
    }
}
