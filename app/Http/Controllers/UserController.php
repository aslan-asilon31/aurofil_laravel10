<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
   
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('user-management.index',compact('data'));
    }
   
    public function profile()
    {
        return view('user-management.profile');
    }
    

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('user-management.user_add',compact('roles'));
    }
    

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

            //upload image
        $image = $request->file('image');
        $image->storeAs('public/users', $image->hashName());
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        // $user = User::create($input);
        $user = User::create([
            'image'     => $image->hashName(),
            'name'     => $request->name,
            'email'   => $request->email,
            'password'   => md5($request->password),
        ]);

        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    public function show($id)
    {
        $user = User::find($id);
        return view('user-management.show',compact('user'));
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('user-management.user_edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        //get data User by ID
        // $user = User::findOrFail($user->id);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        // $user->update($input);

        if($request->file('image') == "") {

            $user->update([
                'name'     => $request->name,
                'email'   => $request->email,
                // 'password'   => $request->password
            ]);
    
        } else {
    
            //hapus old image
            Storage::disk('local')->delete('public/users/'.$user->image);
    
            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/users', $image->hashName());
    
            $user->update([
                'image'     => $image->hashName(),
                'name'     => $request->name,
                'email'   => $request->email,
                'password'   => $request->password
            ]);
    
        }

        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function userOnlineStatus()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (Cache::has('user-online' . $user->id))
                echo $user->name . " is online. <br>";
            else
                echo $user->name . " is offline <br>";
        }
    }
}

