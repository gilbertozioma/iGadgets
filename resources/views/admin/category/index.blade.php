@extends('layouts.admin')

@section('title', 'Categories')

@section('content')

<div>
    {{-- Including a Livewire component for displaying the list of categories in the admin section --}}
    <livewire:admin.category.index />
</div>

@endsection
