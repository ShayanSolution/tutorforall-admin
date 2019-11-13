<?php

namespace App\Http\Controllers;

use App\Models\PercentageCostForMultiStudentGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PercentageCostForMultiStudentGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $percentageCosts = PercentageCostForMultiStudentGroup::all();
        return view('admin.percentage_costs.index', compact('percentageCosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.percentage_costs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'number_of_students'    => 'required|unique:percentage_cost_for_multistudent_group,number_of_students',
                'percentage'            => [
                    'required'
                ]
            ],
            [
                'number_of_students.unique' => 'The Percentage Cost for '.$request->get('number_of_students').' Student Group has already been created.'
            ]
        )->validate();

        PercentageCostForMultiStudentGroup::create(
            $request->except('_token')
        );

        return redirect()->route('percentage-costs.index')->with('success', 'Percentage Costs created successfully!');
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
        $percentageCost = PercentageCostForMultiStudentGroup::find($id);

        if(!$percentageCost)
            return redirect()->back()->with('error', 'Could not find requested "Percentage Cost for Multi Students"');


        return view('admin.percentage_costs.edit', compact('percentageCost'));

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
        Validator::make(
            $request->all(),
            [
                'number_of_students'    => [
                    'required',
                    'unique:percentage_cost_for_multistudent_group,number_of_students,{$id},id,deleted_at,NULL'
                ],
                'percentage'            => [
                    'required'
                ]
            ],
            [
                'number_of_students.unique' => 'The Percentage Cost for '.$request->get('number_of_students').' Student Group already exists.'
            ]
        )->validate();

        PercentageCostForMultiStudentGroup::create(
            $request->except('_token')
        );

        return redirect()->route('percentage-costs.index')->with('success', 'Percentage Costs created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $percentageCost = PercentageCostForMultiStudentGroup::find($id);

        if(!$percentageCost)
            return redirect()->back()->with('error', 'Could not find requested "Percentage Cost for Multi Students"');

        $percentageCost->delete();

        return redirect()->route('percentage-costs.index')->with('success', 'Requested Percentage Cost deleted successfully!');
    }
}
