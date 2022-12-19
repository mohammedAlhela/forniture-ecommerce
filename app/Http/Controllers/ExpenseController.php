<?php

namespace App\Http\Controllers;

use App\Exports\ExpenseExport;
use App\Models\Expense;
use Excel;
use Helper;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

        $this->middleware('activeUser');

    }


    public function write(Request $request)
    {

        $authArray = array('expense', 'write');

        Helper::authorizeModel($authArray);

        $id = $request->id;

        $expense = $id ? Expense::where('id' , $id)->update($request->all()) :  Expense::create($request->all());

    }

    public function index()
    {

        $authArray = array('expense', 'show');

        Helper::authorizeModel($authArray);

        return view('expenses');

    }

    public function getData()
    {

        $authArray = array('expense', 'show');

        Helper::authorizeModel($authArray);

        $expenses = Expense::all();

        $response = [
            'expenses' => $expenses,
        ];

        return response( $response , 201);

    }

    public function delete($id)
    {

        $authArray = array('expense', 'delete');

        Helper::authorizeModel($authArray);

        $expense = Expense::find($id)->delete();

        return $expense;


    }


    public function exportExcel($id)
    {

        $authArray = array('expense', 'show');

        Helper::authorizeModel($authArray);

        return Excel::download(new ExpenseExport($id), 'expenses.xlsx');

    }

}
