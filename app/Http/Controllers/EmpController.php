<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password as PasswordRule;


class EmpController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role == 1){
            $emp = User::whereNot('role', 1)->sortable()->paginate(5);
            return view('admin.emadmin',compact('emp'));
        }
        else {
        return view('dashboard');
       }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $new_user = new User;

        $validated = $request->validate([
          'name' => 'required|unique:users|max:255',
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'phone' => 'required | numeric | digits:10',
          'department' => ['required', 'string', 'max:255'],
          'password' => ['required', 'confirmed', new PasswordRule],
        ]);
   
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->phone = $request->phone;
        $new_user->department = $request->department;
        $new_user->password = Hash::make($request->password);    
        $new_user->save();         
        return redirect()->back()->with('message','Employee Added Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $emp = User::find($id);
        if($emp){
            return response()->json([
              'status'=> 200,
               'emp' =>$emp,
            ]);
          }
          else {
            return response()->json([
              'status'=> 400,
               'emp' =>'is not found',
            ]);

            }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $emp = user::find($id);
        if($emp){
            $emp->name = $request->name;
            $emp->email = $request->email;
            $emp->department = $request->department;

            $emp->update(); 
            return response()->json([
              'status'=> 200,
               'message' =>'updated',
            ]);
          }
          else {
            return response()->json([
              'status'=> 400,
               'message' =>'is not found',
            ]);

            }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $emp = User::find($id);
      if($emp){
        $emp->delete();
          return response()->json([
            'status'=> 200,
             'emp' =>'data deleted successfully',
          ]);
        }
        else {
          return response()->json([
            'status'=> 400,
             'emp' =>'is not found',
          ]);

          }
    }
}
