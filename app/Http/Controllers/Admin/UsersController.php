<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $categories = User::all();
        View::share([
            "categories" => $categories,
            'status_options' => User::statusOptions(),
            'status_types' => User::typeOptions(),
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::paginate(15);

        return view('admin.users.index', [
            'title' => 'Users List',
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()
        ->route('users.index')
        ->with('success', "users Has Been Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
