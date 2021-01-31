<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\RoleResource;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function index()
    {
        return RoleResource::collection(Role::all());
    }

    public function store(Request $request)
    {
        $role = Role::create($request->all());
        $this->insert_permission($role->id, $request->permissions);
        return response(new RoleResource($role), Response::HTTP_CREATED);
    }

    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        $this->delete_permission($role->id);
        $this->insert_permission($role->id, $request->permissions);
        return response(new RoleResource($role), Response::HTTP_ACCEPTED);
    }

    public function destroy(Role $role)
    {
        $this->delete_permission($role->id);
        $role->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    protected function insert_permission($role_id, $permissions)
    {
        foreach($permissions as $permission_id) {
            DB::table('role_permission')->insert(['role_id' => $role_id, 'permission_id' => $permission_id]);
        }
    }

    protected function delete_permission($role_id)
    {
        DB::table('role_permission')->where('role_id', $role_id)->delete();
    }
}
