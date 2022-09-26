<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = array_unique(Score::orderBy('grade')->get()->pluck('grade')->toArray());
        sort($grades);
        $data['grades'] = $grades;
        $data['scores'] = Score::select(\DB::raw('count(*)'))->orderBy('grade')->groupBy('grade')->get()->pluck('count');
        $scores = Score::paginate(10);
        return view('score.index', compact('scores', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('score.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'name' => 'required',
            'major' => 'required',
            'quiz' => 'required',
            'task' => 'required',
            'presence' => 'required',
            'practice' => 'required',
            'exam' => 'required'
        ]);

        $quiz = $request->quiz;
        $task = $request->task;
        $presence = $request->presence;
        $practice = $request->practice;
        $exam = $request->exam;
        $final_score = ($quiz + $task + $presence + $practice + $exam) / 5;

        $grade = 'A';
        if ($final_score <= 65) {
            $grade = 'D';
        } else if ($final_score <= 75) {
            $grade = 'C';
        } else if ($final_score <= 85) {
            $grade = 'B';
        }

        $score = new Score();
        $score->nim = $request->nim;
        $score->name = $request->name;
        $score->major = $request->major;
        $score->quiz = $quiz;
        $score->task = $task;
        $score->presence = $presence;
        $score->practice = $practice;
        $score->exam = $exam;
        $score->final_score = $final_score;
        $score->grade = $grade;
        $score->save();

        session()->flash('success', 'The score added successfully.');
        return redirect()->route('score.index');
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
        $score = Score::find($id);
        $score->delete();
        session()->flash('success', 'The score deleted successfully.');
        return redirect()->route('score.index');
    }
}
