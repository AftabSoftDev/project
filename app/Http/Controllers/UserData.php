<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\user_assgin;



use Illuminate\Support\Facades\Validator;

class UserData extends Controller
{
    public function storeUser(Request $req)
    {
        if ($req->ajax() && $req->isMethod('post')) {
            $name= $req->input('name');

            $validator = Validator::make(
                $req->all(),
                [
                    'name'   => 'required|string|max:255',
                ],
            );


            if ($validator->passes()) {
        $data = ['name' => $name];
        $create = User::create($data);

        if ($create) {
            echo json_encode(array('msg' => 200));
        }else{

            echo json_encode(array('msg' => 201));
        }
    }else{
            echo json_encode(array('msg' => 202));
    }

    }else{

        echo json_encode(array('msg' => 404));
    }
}

public function storeCompany(Request $req)
    {
        if ($req->ajax() && $req->isMethod('post')) {
            $name= $req->input('name');

            $validator = Validator::make(
                $req->all(),
                [
                    'name'   => 'required|string|max:255',
                ],
            );


            if ($validator->passes()) {
        $data = ['name' => $name];
        $create = Company::create($data);

        if ($create) {
            echo json_encode(array('msg' => 200));
        }else{

            echo json_encode(array('msg' => 201));
        }
    }else{
            echo json_encode(array('msg' => 202));
    }

    }else{

        echo json_encode(array('msg' => 404));
    }
}

public function getData()
{
    $data['comData'] = Company::all();

    return view('company', $data);
}

public function AssignUser($id)
{
    $data['comData'] = Company::find($id);
    $data['userData'] = User::all();

    return view('assignuser', $data);
}

public function getUserData()
{
    $data['userData'] = User::all();

    return view('/index', $data);
}


public function userGetUpdate(Request $req)
{
    $id= $req->input('id');
    $data['UserUpdateData'] = User::find($id);

        echo json_encode(array('msg' => 200, 'data' => $data));

}


public function deleteUserData($id)
{
    $delete = User::find($id)->delete();


    if ($delete) {
        return redirect()->back();
    }else{

        return view('/company')->with('msg', "unble to Delete");
    }
}

public function comDelete($id)
{
    $delete = Company::find($id)->delete();


    if ($delete) {
        return redirect()->back()->with('msg', "Deleted");
    }else{

        return redirect()->back()->with('msg', "unble to Delete");
    }
}

public function UpdateSave(Request $req)
{
    $id = $req->input('id');
    $name = $req->input('name');

    $update= User::where('id', $id)->update(['name' => $name]);

    if ($update) {
        echo json_encode(array('msg' => 200));
    }else{

        echo json_encode(array('msg' => 201));
    }
}

public function comGetUpdate(Request $req)
{
    $id= $req->input('id');
    $data['comUpdateData'] = Company::find($id);

        echo json_encode(array('msg' => 200, 'data' => $data));

}

public function ComUpdateSave(Request $req)
{
    $id = $req->input('id');
    $name = $req->input('name');

    $update= Company::where('id', $id)->update(['name' => $name]);

    if ($update) {
        echo json_encode(array('msg' => 200));
    }else{

        echo json_encode(array('msg' => 201));
    }
}
public function AssigUser(Request $req)
{
    if ($req->isMethod('post')) {
        $user_id[]= $req->input('user_id');
        $com_id= $req->input('com_id');

        // dd($user_id);

        $validator = Validator::make(
            $req->all(),
            [
                'user_id'   => 'required',
            ],
        );


    $data =$user_id[0];

        if ($validator->passes()) {


            foreach ($data as $user_id) {
                $db = New user_assgin;
                $db->user_id = $user_id;
                $db->com_id = $com_id;
                $db->save();

            }
            $data['comData'] = Company::all();
            if ($db) {

                // session()->flash('msg', 'Successfully Assgined');
                return view('company', $data)->with('msg', 'Users has been Assign successfully.');

            }else{

                return view('company', $data)->with('msg', 'Users Unable to Assign');;
            }

}
}
}




}
