<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Position;
use Carbon\Carbon as Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::with('position');
            return Datatables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('photo', function($row){
                    $img =
                        view('employees.image', [
                            'employee' => $row
                        ]);
                    return $img;
                })
                ->addColumn('position', function($row){
                    $position = $row->position->name;
                    return $position;
                })
                ->addColumn('wage', function($row){
                    $wage = number_format($row->wage, 2);
                    return $wage;
                })
                ->addColumn('action', function($row){
                    $btn = view('employees.action', [
                        'row' => $row
                    ]);
                    return $btn;
                })
                ->rawColumns(['photo', 'action'])
                ->toJson();
        }

        return view('employees.index');
    }

    public function add()
    {
        return view('employees.add', [
            'positions' => Position::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required|max:5120',
            'name' => 'required|max:255',
            'phone' => 'required|unique:employees',
            'email' => 'required|unique:employees|max:255',
            'wage' => 'required|numeric',
            'emp_date' => 'required|date',
            'position' => 'required|min:1',
            'head' => 'exists:App\Employee,name'
        ]);;

        if ($validator->fails()) {
            return redirect()->route('admin.employees.add')
                ->withErrors($validator)
                ->withInput();
        }

        $head = Employee::firstWhere('name', $request->head);

        $level = 5;
        while(!empty($head->head()->first()) && $level > 1) {
            $level--;
            $head = $head->head()->first();
        }

        if ($level <= 1) {
            return redirect()->route('admin.employees.add')
                ->withErrors(['head' => 'Please select a director of higher rank'])
                ->withInput();
        }

        $file_path = $request->file('photo')->store('uploads', 'public');

        Employee::create([
            'photo' => $file_path,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'wage' => $request->wage,
            'emp_date' => $request->emp_date,
            'position_id' => $request->position,
            'director_id' => Employee::firstWhere('name', $request->head)->id,
            'admin_created_id' => Carbon::now()
        ]);

        return redirect()->route('admin.employees');
    }

    public function edit(Request $request)
    {
        $employee = Employee::find($request->id);
        $positions = Position::all();
        return view('employees.edit', [
            'employee' => $employee,
            'positions' => $positions
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'max:5120',
            'name' => 'required|max:255',
            'phone' => 'required',
            'email' => 'required|max:255',
            'wage' => 'required|numeric',
            'emp_date' => 'required|date',
            'position' => 'required|min:1',
            'head' => 'exists:App\Employee,name'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.employees.edit', ['id' => $request->id])
                ->withErrors($validator)
                ->withInput();
        }

        $employee = Employee::find($request->id);

        if ($request->has('photo')) {
            $employee->photo = $request->file('photo')->store('uploads', 'public');
        }

        $employee->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'wage' => $request->wage,
            'emp_date' => $request->emp_date,
            'position_id' => $request->position,
            'director_id' => Employee::firstWhere('name', $request->head)->id,
            'admin_updated_id' => Carbon::now()
        ]);

        return redirect()->route('admin.employees');
    }

    public function delete(Request $request)
    {
        $position = Employee::find($request->id);
        $position->delete();
        return redirect()->route('admin.employees');
    }
}
