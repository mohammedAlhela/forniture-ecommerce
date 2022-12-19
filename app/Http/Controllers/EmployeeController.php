<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Excel;
use Helper;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

        $this->middleware('activeUser');

    }


    public function write(EmployeeRequest $request)
    {

        $authArray = array('employee', 'write');

        Helper::authorizeModel($authArray);

        $id = $request->id;

        $employee = $id ? Employee::where('id' , $id)->update($request->all()) :  Employee::create($request->all());

        $employeeRecord = $id ? Employee::find($id) : $employee;

        $image = request()->file("image");

        $data = array(
            "record" => $employeeRecord,
            "image" => $image,
            "dirPath" => "/images/employees/",
            "width" => 400,
            "height" => 400,

        );

        Helper::uploadImage($data);

    }

    public function index()
    {

        $authArray = array('employee', 'show');

        Helper::authorizeModel($authArray);

        return view('employees');

    }

    public function getData()
    {

        $authArray = array('employee', 'show');

        Helper::authorizeModel($authArray);

        $employees = Employee::orderBy('created_at', 'DESC')->get();

        $response = [
            'employees' => $employees,
        ];

        return response( $response , 201);

    }

    public function delete($id)
    {

        $authArray = array('employee', 'delete');

        Helper::authorizeModel($authArray);

        $employee = Employee::find($id);

        $imageFileExist = file_exists(public_path() . $employee->image);

        $imageFileExist ? $imageFileDeleted = unlink(substr($employee->image, 1)) : $imageFileDeleted = false;

        $imageFileExist ? ($imageFileDeleted ? $employee->delete() : 1 == 1) : $employee->delete();

    }


    public function exportExcel()
    {

        $authArray = array('employee', 'show');

        Helper::authorizeModel($authArray);

        return Excel::download(new EmployeeExport, 'employees.xlsx');

    }

}
