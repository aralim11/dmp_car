<?php

namespace App\Http\Controllers\Super;

use App\Driver_info;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Driver_info::paginate(8);

        return view('admin.driver.index', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.driver.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver_name' => ['required', 'string', 'max:255'],
            'license_number' => ['required', 'string', 'max:255'],
            'phone_number' => ['required'],
            'license_issue_date' => ['required'],
            'license_exp_date' => ['required'],
        ]);

        if ($validator->fails())
          {
              session()->flash('delete_msg', 'Error!! Check Hints!!');
              return redirect()->back()->withErrors($validator)->withInput();
          } else {

            Driver_info::create([
                'user_id' => Auth::id(),
                'driver_name' => $request->driver_name,
                'license_number' => $request->license_number,
                'phone_number' => $request->phone_number,
                'license_issue_date' => $request->license_issue_date,
                'license_exp_date' => $request->license_exp_date,
                'picture' => 'default.png',
            ]);

            session()->flash('success_msg', 'Driver Info Added!');
            return redirect()->back();
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Driver_info::find($id);

        return view('admin.driver.edit', compact(['data']));
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
        $validator = Validator::make($request->all(), [
            'driver_name' => ['required', 'string', 'max:255'],
            'license_number' => ['required', 'string', 'max:255'],
            'phone_number' => ['required'],
            'license_issue_date' => ['required'],
            'license_exp_date' => ['required'],
        ]);

        if($validator->fails())
        {
            session()->flash('delete_msg', 'Error!! Check Hints!!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $update = Driver_info::find($id);
            $update->driver_name = $request->driver_name;
            $update->license_number = $request->license_number;
            $update->phone_number = $request->phone_number;
            $update->license_issue_date = $request->license_issue_date;
            $update->license_exp_date = $request->license_exp_date;

            $update->update();

            session()->flash('success_msg', 'Driver Info Updated!!');
            return redirect()->back();
        }
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
    }
}
