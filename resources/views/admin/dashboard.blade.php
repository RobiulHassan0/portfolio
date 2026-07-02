@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

    <!-- ============ DASHBOARD ============ -->
    @include('admin.sections.overview')
    @include('admin.sections.settings')
    @include('admin.sections.projects')
    @include('admin.sections.services')
    @include('admin.sections.skills')
    
@endsection



