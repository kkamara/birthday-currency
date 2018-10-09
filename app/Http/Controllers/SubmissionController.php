<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use Validator;

class SubmissionController extends Controller
{
    public function index(Request $request)
    {
        $submissions = Submission::getSubmissions($request)->paginate(7);

        return view('submission.index', [
            'title' => 'View All'
        ])->with(compact('submissions'));
    }

    public function create()
    {
        return view('submission.create', [
            'title' => 'Create',
        ]);
    }

    public function store(Request $request)
    {

    }
}
