<?php

namespace App\Http\Controllers;

use App\Exports\DeductionExport;
use App\Models\Deduction;
use Excel;
use Helper;
use Illuminate\Http\Request;

class DeductionController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

        $this->middleware('activeUser');

    }


    public function write(Request $request)
    {

        $authArray = array('deduction', 'write');

        Helper::authorizeModel($authArray);

        $id = $request->id;

        $deduction = $id ? Deduction::where('id' , $id)->update($request->all()) :  Deduction::create($request->all());

    }

    public function index()
    {

        $authArray = array('deduction', 'show');

        Helper::authorizeModel($authArray);

        return view('deductions');

    }

    public function getData()
    {

        $authArray = array('deduction', 'show');

        Helper::authorizeModel($authArray);

        $deductions = Deduction::all();

        $response = [
            'deductions' => $deductions,
        ];

        return response( $response , 201);

    }

    public function delete($id)
    {

        $authArray = array('deduction', 'delete');

        Helper::authorizeModel($authArray);

        $deduction = Deduction::find($id)->delete();

        return $deduction;


    }


    public function exportExcel($id)
    {

        $authArray = array('deduction', 'show');

        Helper::authorizeModel($authArray);

        return Excel::download(new DeductionExport($id), 'deductions.xlsx');

    }

}
