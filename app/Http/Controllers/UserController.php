<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Hash the password
        ]);

        return response()->json(['message' => 'User created successfully.'], 201);

        // Redirect with success message for web requests
        // return redirect()->route('users.index')->with('success', 'User created successfully.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // Validate input
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $id, // Ensure email is unique except for this user
            'password' => 'nullable|min:6',
        ]);

        // Update user fields if provided
        if ($request->has('name')) {
            $user->name = $validated['name'];
        }
        if ($request->has('email')) {
            $user->email = $validated['email'];
        }
        if ($request->has('password')) {
            $user->password = Hash::make($validated['password']); // Hash the new password
        }

        // Save changes
        $user->save();

        return response()->json(['message' => 'User updated successfully.', 'user' => $user], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // Delete the user
        $user->delete();

        return response()->json(['message' => 'User deleted successfully.'], 200);
    }

}
