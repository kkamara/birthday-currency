<?php

namespace App\Http\Controllers;

use Ixudra\Curl\Facades\Curl;
use Illuminate\Http\Request;
use App\Models\ExchangeRate;
use App\Models\Submission;
use Carbon\Carbon;

class SubmissionController extends Controller
{
    /**
     * View all submissions.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        $submissions = Submission::getSubmissions($request)->paginate(7);

        return view('submission.index', [
            'title' => 'View All'
        ])->with(compact('submissions'));
    }

    /**
     * Allow user to create a submission.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('submission.create', [
            'title' => 'Give it a go',
        ]);
    }

    /**
     * Get errors for store request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getStoreErrors(Request $request)
    {
        return response()->json(["Errors"=>Submission::getPostErrors($request)]);
    }

    /**
     * Store submission.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!empty(Submission::getPostErrors($request)))
        {
            return redirect()->back()->with('flashDanger', 'Oops, something went wrong. Error 500. Contact system administrator.');
        }
        /**
         * Store submitted birthday.
         *
         * @var string
         */
        $birthday = filter_var($request->input('birthday'), FILTER_SANITIZE_STRING);
        /**
         * Check if date already submitted.
         */
        $submission = Submission::where('birthday', $birthday)->first();

        if($submission !== NULL)
        {
            /**
             * Increment submission occurence if birthday already exists
             */
            $submission->update([
                'occurrences' => $submission['occurrences'] + 1,
            ]);
        }
        else
        {
            /**
             * Query Fixer API for exchange results
             */
            $url = sprintf(
                "%s/%s?access_key=%s&symbols=HKD",
                config('app.fixer-base-url'),
                $birthday,
                config('app.fixer-api-key')
            );
            $r = Curl::to($url)->get();
            $r = json_decode($r, TRUE);
            /**
             * Fail gracefully if unsuccessful curl response
             */
            if($r === NULL || (isset($r['error']) && !empty($r['error'])))
            {
                return redirect()->back()->with('flashDanger', 'Oops, something went wrong. Error 503. Contact system administrator.');
            }
            /**
             * Sanitize HKD exchange rate for DB insertion.
             *
             * @var double
             */
            $hkdRate = (float) filter_var($r['rates']['HKD'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            /**
             * Create a new submission.
             */
            $submission = new Submission;
            $submission->birthday =$birthday;
            $submission->save();
            /**
             * Assign an exchange rate to submission.
             */
            $exchangeRate = new ExchangeRate;
            $exchangeRate->submission_id = $submission->id;
            $exchangeRate->hong_kong_dollar = $hkdRate;
            $exchangeRate->save();
        }
        /**
         * Redirect to page that shows submission details.
         */
        return redirect()->route('home', ['search'=>$birthday])->with('flashSuccess', 'Success!');
    }
}
