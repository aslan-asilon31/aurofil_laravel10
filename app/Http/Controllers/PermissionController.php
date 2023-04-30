<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $permissions = Permission::orderBy('id','DESC')->paginate(5);
        return view('user-management.permissions',compact('permissions'));
    }

        
    public function create()
    {
        $permission = Permission::get()->take(1);
        return view('user-management.permissions_add', compact('permission'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'guard_name' => 'required',
        ]);
    
        $permission = Permission::create(
            ['name' => $request->input('name')],
            // ['guard_name' => $request->input('guard_name')],
        );
        // $permission = Permission::create(['guard_name' => $request->input('guard_name')]);
        // $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('permissions.index')
                        ->with('success','Permission created successfully');
    }

    // public function show($id)
    // {
    //     $permission = Permission::find($id);
    //     $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
    //         ->where("role_has_permissions.role_id",$id)
    //         ->get();
    
    //     return view('user-management.roles_show',compact('role','rolePermissions'));
    // }
    
    public function edit($id)
    {
        $permission = Permission::find($id);
        // $permission = Permission::get();
        // $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        //     ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        //     ->all();
    
        return view('user-management.permissions_edit',compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'guard_name' => 'required',
        ]);
    
        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->guard_name = $request->input('guard_name');
        $permission->save();
    
        // $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('permissions.index')
                        ->with('success','Permission updated successfully');
    }

    public function destroy($id)
    {
        DB::table("permissions")->where('id',$id)->delete();
        return redirect()->route('permissions.index')
                        ->with('success','Permission deleted successfully');
    }
    
}
