<?php

namespace App\Http\Controllers;

use App\Http\Requests\SerachUserRequet;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UsersService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $usersService; 

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function index()
    {
        $users = $this->usersService->allCustomerUsers();

        return view('dashboard.users')->with(['users' => $users]);
    }

    public function edit($id)
    {
        $user = $this->usersService->findOne($id);

        return view('dashboard.edit_users', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $action = $request->input('action'); 

        if ($action === 'deactivate') {
            $this->usersService->deactivateUser($id);
            return redirect()->route('users.index')->with('success', 'User deactivated successfully.');
        } elseif ($action === 'reactivate') {
            $this->usersService->reactivateUser($id);
            return redirect()->route('users.index')->with('success', 'User reactivated successfully.');
        }

        try {
            $data = $request->validated();
            $this->usersService->updateUser($id, $data);
            
            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        } catch (Query $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy($id)
    {
        $this->usersService->destroy($id);
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function search(SerachUserRequet $request)
    {
        $data = $request->validated();
        $users = $this->usersService->search($data);

        return view('dashboard.users')->with(['users' => $users]);
    }
}
