<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactSubmissionRequest;
use App\Mail\ContactFormSubmitted;
use App\Models\ContactSubmission;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(StoreContactSubmissionRequest $request)
    {
        // Honeypot: a real visitor never sees or fills this field (hidden
        // via CSS in the form). If it's filled, pretend success and quietly
        // drop the submission — an error response would just teach the bot
        // which field to leave blank next time.
        if (filled($request->input('website'))) {
            return redirect()
                ->route('contact')
                ->with('status', 'Thanks — we\'ll be in touch within 24 hours.');
        }

        $submission = ContactSubmission::create(
            $request->validated() + ['ip_address' => $request->ip()]
        );

        if ($adminEmail = config('app.admin_email')) {
            Mail::to($adminEmail)->send(new ContactFormSubmitted($submission));
        }

        return redirect()
            ->route('contact')
            ->with('status', 'Thanks — we\'ll be in touch within 24 hours.');
    }
}
