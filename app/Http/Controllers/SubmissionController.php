<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use Validator;

class SubmissionController extends Controller
{
    public function index()
    {
        return view('submission.index', [
            'title' => 'View All'
        ]);
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
