<?php

namespace App\Http\Controllers;

use App\Modules\MentorMatch\Matcher;

class EmployeesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        if (!session()->has('employees')) {
            return redirect('/');
        }

        $matcher = new Matcher(session('employees'));

        return view('employees', [
            'matches' => $matcher->getMatchedEmployees(),
            'avg' => $matcher->getAverage()
        ]);
    }
}
