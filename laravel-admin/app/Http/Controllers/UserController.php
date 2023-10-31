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
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response="200",
     *         description="User Collection" 
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         description="Pagination page",
     *         in="query",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     )
     * )
     */
    public function index()
    {
        $this->authorize('view', 'users');

        return UserResource::collection(User::with('role')->paginate());
    }

    /**
     * @OA\Post(path="/users",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response="201",
     *         description="User Create" 
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserCreateRequest")
     *     )
     * )
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
     * @OA\Get(path="/users/{id}",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response="202",
     *         description="User Update" 
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         description="User ID",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        Gate::authorize('view', 'users');

        return new UserResource(User::with('role')->findOrFail($id));
    }

    /**
     * @OA\Put(path="/users/{id}",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response="201",
     *         description="User" 
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         description="User ID",
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserUpdateRequest")
     *     )
     * )
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
     * @OA\Delete(path="/users/{id}",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response="204",
     *         description="User Delete"
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         description="User ID",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        Gate::authorize('edit', 'users');

        $user = User::findOrFail($id);

        $user->delete($user);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
