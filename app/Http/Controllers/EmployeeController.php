<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\validator;



class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('id','DESC')->paginate(3);

        return view('employee.list',['employees' => $employees]);
    }

    public function create(){
        return view('employee.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'image' => 'sometimes|image:gif,png,jpeg,jpg',
        ]);

        if ($validator->passes()){
             //save data here
            // 1st option
        //    $employee = new Employee();
        //    $employee->name = $request->name;
        //    $employee->email = $request->email;
        //    $employee->address = $request->address;
        //    $employee->save();

        // dd($request->post());

        // 2nd option

        // $employee = new Employee();
        // $employee->fill($request->post())->save();

        //3rd option

        $employee = Employee::create($request->post());


           // upload image here

           if($request->image){
            $ext = $request->image->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->image->move(public_path().'/uploads/employees/',$newFileName); // this will save file in a floder
           
            $employee->image = $newFileName;
            $employee->save();
           }

        //    $request->session()->flash('success', 'Employee added successfully.');

           return redirect()->route('employees.index')->with('success','Employee added successfully');

        }else{
            // return with error
            return redirect()->route('employees.create')->withErrors($validator)->withInput();
        }
    }

    public function edit(Employee $employee){   //$id
      //  $employee = Employee::findOrFail($id);

        return view('employee.edit',['employee' => $employee]);
    }

    public function update(Employee $employee, Request $request){   //$id

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'image' => 'sometimes|image:gif,png,jpeg,jpg',
        ]);

        if ($validator->passes()){
             //save data here
            
        //    $employee = Employee::find($id);
        //    $employee->name = $request->name;
        //    $employee->email = $request->email;
        //    $employee->address = $request->address;
        //    $employee->save();

      //  2nd option 

        $employee->fill($request->post())->save();


           // upload image here

           if($request->image){
            $oldImage = $employee->image;

            $ext = $request->image->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->image->move(public_path().'/uploads/employees/',$newFileName); // this will save file in a floder
           
            $employee->image = $newFileName;
            $employee->save();

            File::delete(public_path().'/uploads/employees/'.$oldImage);

           }

           $request->session()->flash('success', 'Employee added successfully.');

           return redirect()->route('employees.index')->with('success','Employee updated successfully');

        }else{
            // return with error
            return redirect()->route('employees.edit',$employee->id)->withErrors($validator)->withInput();
        }

    }

    public function destroy(Employee $employee, Request $request ){  //$id
        
     //   $employee = Employee::findOrFail($id);

        File::delete(public_path().'/uploads/employees/'.$employee->image);

        $employee->delete();

        // $request->session()->flash('success','Employee deleted success');
        return redirect()->route('employees.index')->with('success','Employee deleted successfully');
    }
}
