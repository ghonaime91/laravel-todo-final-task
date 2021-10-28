<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use App\Models\tasks;

class todoListController extends Controller
{

    //middle ware
    public  function __construct(){

        $this->middleware('userCheck',['except' => ['create','store','LoginView','login']]);
    }

    // create user
    public function createUser()
    {
        //
        return view('todo.register');
    }
     // store user
     public function storeUser(Request $req)
     {
         //

         $data =  $this->validate($req,[
            "name"     => "required|string",
            "email"    => "required|email",
            "password" => "required|min:6"
           ]);
         # Hashing Password 
         $data['password'] = bcrypt($data['password']);

         # Store Data   
          $op = users::create($data); 

         if($op){

            $message = "User Created";

         }else{

            $message = "Error Try Again";
         }
  
        # Set Message To Session .... 
        session()->flash('Message',$message);
        
        return redirect(url('/todo/register'));
   
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // tasks page
    {
        $fetched_data = tasks::get();
        
        foreach ($fetched_data  as $d) {
            $d->start_date = date('d/m/y', $d->start_date) ;
            $d->end_date = date('d/m/y', $d->end_date);
        }
        $data = ["data"=>$fetched_data];
        return view('todo.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // create task page
    {

        // tasks form

        return view('todo.create');
    }

    public function loginView()
    {

        // tasks form

        return view('todo.login');
    }

    public function login(Request $req)
    {

        // login

       $data = $this->validate($req,[
            "email" => "required|email",
            "password" =>"required|min:6"
       ]);

       if(auth()->attempt($data)) {
           return redirect('/todo');
       } else {
           return redirect(url('/todo/login'));
       }
    }

    public function logout() {
        auth()->logout();
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req) // storing the task
    {
        //
        $data =  $this->validate($req,[
            "title"       => "required|string",
            "description" => "required",
            "start_date"  => "required|date",
            "end_date"    => "required|date",
            "image"       => "required|mimes:jpeg,png,jpg",
            


           ]);
         # image 
         $img = $req->file('image');
         $new_name = rand().'.'.$img->getClientOriginalExtension();
         $img->move(public_path('images'),$new_name);
         $data['image'] = $new_name;  
         #date operation
         $data['start_date'] = strtotime($data['start_date']);
         $data['end_date'] = strtotime($data['end_date']);
         # Store Data   
          $op = tasks::create($data); 

         if($op){

            $message = "task Created";

         }else{

            $message = "Error Try Again";
         }
  
        # Set Message To Session .... 
        session()->flash('Message',$message);
        
        return redirect(url('/todo'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $op = users::where('id',$id)->delete();

    }


    
}
