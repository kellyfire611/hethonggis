<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Frontend\Contact\SendContact;
use App\Http\Requests\Frontend\Contact\SendContactRequest;
use Illuminate\Http\Request;

/**
 * Class PageController.
 */
class PageController extends Controller
{
    /**
     * @param ManagePageRequest $request
     * @param Page              $Page
     *
     * @return mixed
     */
    public function show(Request $request, $slug)
    {
        $Page = Page::where('slug', $slug)->first();
        return view('frontend.pages.show')
            ->with('page', $Page);
    }
}
