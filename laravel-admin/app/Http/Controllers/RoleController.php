<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{
    public function index()
    {
        return RoleResource::collection(Role::all());
    }

    public function store(Request $request)
    {
        $role = Role::create($request->only('name'));
        
        return response(new RoleResource($role), Response::HTTP_CREATED);
    }

    public function show($id)
    {
        return new RoleResource(Role::with('permissions')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $role->update($request->only('name'));

        return response(new RoleResource($role), Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->delete($role);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
