<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Position::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return view('positions.action', [
                        'row' => $row
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('positions.index');
    }

    public function add()
    {
        return view('positions.add');
    }

    public function positionValidator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'unique:positions|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.positions.add')
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function store(Request $request)
    {
        $this->positionValidator($request);

        Position::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.positions');
    }

    public function edit(Request $request)
    {
        $position = Position::find($request->id);
        return view('positions.edit', [
            'position' => $position
        ]);
    }

    public function update(Request $request)
    {
        $this->positionValidator($request);

        Position::find($request->id)->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.positions');
    }

    public function delete(Request $request)
    {
        $position = Position::find($request->id);
        $position->delete();
        return redirect()->route('admin.positions');
    }
}
