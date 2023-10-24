<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * @OA\Get(path="/users",
     *     @OA\Response(response="200",
     *         description="User Collection" 
     *     )
     * )
     */
    public function index()
    {
        $this->authorize('view', 'users');

        return UserResource::collection(User::with('role')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        Gate::authorize('edit', 'users');

        $user = User::create(
            $request->only(
                'first_name',
                'last_name',
                'email',
                'role_id',
            ) +
            ['password' => Hash::make(1234)]
        );

        return response(new UserResource($user), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('view', 'users');

        return new UserResource(User::with('role')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        Gate::authorize('edit', 'users');

        $user = User::findOrFail($id);

        $user->update(
            $request->only(
                'first_name',
                'last_name',
                'email',
                'role_id',
            )
        );

        return response(new UserResource($user), Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('edit', 'users');

        $user = User::findOrFail($id);

        $user->delete($user);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
