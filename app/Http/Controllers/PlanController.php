<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display the plan upgrade form.
     *
     * @return \Illuminate\View\View
     */
    public function showUpgradeForm()
    {
        // --
        // Render the view for the plan upgrade form
        return view('plans.index');
    }

    /**
     * Handle the plan upgrade request.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upgrade(Request $request)
    {
        // --
        // Validate the request to ensure the 'plan' field is present
        $request->validate(['plan' => 'required']);

        // --
        // Redirect to the dashboard with a success message indicating the plan upgrade
        return redirect()->route('urls.index')->with('success', 'Plan upgraded to ' . $request->plan);
    }
}
