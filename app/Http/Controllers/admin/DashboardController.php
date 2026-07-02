<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PersonalInfo;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;

class DashboardController extends Controller
{
    public function dashboardPage()
    {
        $userInfo = PersonalInfo::with('user:id,name')->first();

        $projects = Project::orderBy('sort_order')->get();

        $services = Service::orderBy('sort_order')->get();
        
        $skills = Skill::orderBy('sort_order')->get();

        $stats = [ 
            'total' => $skills->count(),
            'frontend' => $skills->where('category', 'frontend')->count(),
            'backend' => $skills->where('category', 'backend')->count(),
            'active' => $skills->where('is_active', true)->count(),
            'inactive' => $skills->where('is_active', false)->count(),
            'featured' => $skills->where('featured', true)->count()
        ]; 

        $lastSaved = collect([
            $userInfo?->updated_at,
            $services->max('updated_at'),
            $projects->max('updated_at'),
            $skills->max('updated_at')
        ])->filter()->max();

        return view('admin.dashboard', compact([
            'userInfo', 
            'projects', 
            'services',
            'skills',
            'stats' ,
            'lastSaved'
        ]));
    }




}
