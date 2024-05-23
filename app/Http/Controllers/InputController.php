<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Http\Request;

class InputController extends Controller
{
    public function insert(Request $request)
    
    {

        try {
             $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:user_data,email',
                'phone' => 'required|unique:user_data,phone|max:11|min:11',
            ]);
    
            // Insert user data into the database
            UserData::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'image' => 'image.png', // Assuming image is provided in the request
            ]);
            // Return success response
        return response()->json(['message' => 'Data inserted successfully']);
    } catch (ValidationException $e) {
        // Check if the error is due to duplicate email
        if ($e->validator->errors()->has('email')) {
            return response()->json(['error' => 'The email has already been taken.'], 422);
        }

        // Return other validation errors
        return response()->json(['errors' => $e->validator->errors()->all()], 422);
    } catch (\Exception $e) {
        // Log the error for further investigation
        \Log::error('Error inserting data: ' . $e->getMessage());

        // Return error response
        return response()->json(['error' => 'An error occurred while inserting data. Please try again.'], 500);
    }
        
    }
}
