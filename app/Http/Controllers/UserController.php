<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;
use illuminate\Support\Str;

use function Laravel\Prompts\search;

class UserController extends Controller
{
    //

    public function index()
    {
        return view('instructor.index');
    }



   public function getUsers()
   {
        $users = User::with('role')->get();
        return response()->json($users, 200);
   }

   public function edit($id)
   {
        return view('student.edit', ['id' =>$id]);
   }

//    public function getStudents()
//    {
//      $users = User::with('role')->get();

//      if($users === 'student'){
//         return response()->json($users, 200);
//      }

//      return 0;
//    }



// go baram spored id studentot
public function getStudent($id)
{
        $user = User::find($id);
        return response()->json($user, 200);
}

public function updateStudent(Request $request)
{
    $student = User::find($request->id);

    $student->name = $request->name;
    $student->email = $request->email;


    // ako se update studentot da ni ispecati nesto 
    if($student->update()) {
        return response()->json([
            'success' => true,
            'message' => 'Student is updated'
        ], 200);
    }

    return response()->json([
        'success' => false,
        'message' => 'Something went wrong, student is not updated sucesfully'
    ], 500);

}



public function deleteStudent($id)
{
    User::destroy($id);
    //$student = new User;
   // $student->delete($id);
   // $student->save();

    return response()->json([
        'success' => true,
        'message' => 'Student is deleted'
    ], 200);

    return response()->json([
        'success' => false,
        'message' => 'Cannot delete this row'
    ], 500);
}

public function create()
{
    return view('student.create');
}

public function storeStudent(Request $request)
{

    $student = new User;
    $student->name = $request->name;
    $student->email = $request->email;
    $student->password = Hash::make($request->password);
    $student->api_token = Str::random(80);
    $student->role_id = 2;

    if($student->save()) {
        return response()->json([
            'success' => true,
            'message' => 'Student is created'
        ], 200);
    }

    return response()->json([
        'success' => false,
        'message' => 'Something went wrong, student is not created sucesfully'
    ], 500);
}


public function search(Request $request)
{
    $searchQuery = $request->input('search');

    $users = User::where('name', 'like', '%' . $searchQuery . '%')
            ->orWhere('email', 'like', '%' . $searchQuery . '%')
            ->with('role')
            ->get();

    return response()->json($users, 200);

}

}
