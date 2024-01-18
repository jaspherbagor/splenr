<?php

namespace App\Http\Controllers;

use App\Mail\ShortlistMail;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
    public function index()
    {
        $listings = Listing::latest()->withCount('users')->where('user_id', auth()->user()->id)->get();
        return view('applicants.index', compact('listings'));
    }

    public function show(Listing $listing)
    {
        $this->authorize('view', $listing);
        $listing =  Listing::with('users')->where('slug', $listing->slug)->first();

        return view('applicants.show', compact('listing'));
    }

    public function shortlist($listingId, $userId)
    {
        $listing = Listing::find($listingId);
        $user = User::find($userId);
        if($listing) {
            $listing->users()->updateExistingPivot($userId, ['shortlisted' => true]);

            Mail::to($user->email)->send(new ShortlistMail($user->name, $listing->title));
            return back()->with('success', 'Applicant is shortlisted successfully!');
        }

        return back();
    }

    public function apply($listingId)
    {
        $user = auth()->user();

        if ($user->user_type === 'seeker') {
            $user->listings()->syncWithoutDetaching($listingId);
            return back()->with('success', 'Your application has been successfully submitted!');
        } else {
            return back()->with('error', 'Only job seekers are allowed to apply the job.');
        }
    }
}
