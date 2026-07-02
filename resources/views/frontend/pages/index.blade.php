@extends('frontend.layouts.app')

@section("title", "Portfolio | Robiul Hassan")

@section("meta_description", "Full Stack Laravel developer building practical, performant web applications and clean APIs. Available for new projects.")

@section("og_title", "Robiul Hassan — Full Stack Laravel Developer")

@section("og_description", "Backend-focused developer shipping Laravel apps, APIs, and admin dashboards.")
 

@section('content')

    @include('frontend.sections.hero')
    @include('frontend.sections.projects')
    @include('frontend.sections.skills')
    @include('frontend.sections.about')
    @include('frontend.sections.services')
    @include('frontend.sections.contact.contact')

@endsection