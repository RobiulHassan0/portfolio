<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\PersonalInfo;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $userInfo = PersonalInfo::with('user:id,name')->first();
        $stack = collect(is_array($userInfo?->stack) ? $userInfo->stack : [])->filter()->implode(', ');

        $contact = Contact::first();

        $projects = Project::where('is_active', true)
                            ->orderByDesc('featured')
                            ->orderBy('sort_order')
                            ->take(4)
                            ->get();

        $services = Service::where('is_active', true)
                    ->orderByDesc('featured')
                    ->orderBy('sort_order')
                    ->get()
                    ->groupBy('category')
                    ->map( fn ($items) => $items->take(2));

        $skills = Skill::where('is_active', true)
            ->orderByDesc('featured')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category')
            ->map( fn ($items) => $items->take(3));

        return view('frontend.pages.index', compact(
            [
                'userInfo',
                'stack',
                'contact',
                'projects',
                'services',
                'skills'
            ]
        ));
    }
}
