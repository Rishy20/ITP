@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="{{ route('reports.index') }}">
        <i class="fa fa-arrow-left pg-back"></i>
    </a>
    <div class="pg-title">Daily Profit Report</div>
</div>

<div class="section">
    <livewire:reports.daily-profit />
</div>

@endsection
