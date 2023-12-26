@extends('layouts.app')

@section('content')

<div class="container-fluid px-4 py-5">
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <h4 class="fw-bold">Recommended Jobs</h4>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Salary
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ route('listing.index', ['sort' => 'salary_high_to_low']) }}">High To Low</a></li>
                </ul>
            </div>
        </div>
        <div class="row mt-3 g-3">
            @foreach($jobs as $job)
            <div class="col-md-3">
                <div class="card p-2 mt-4">
                    <div class="text-end">
                        <small class="badge text-bg-info">{{ $job->job_type }}</small>
                    </div>
                    <div class="text-center mt-2 p-3">
                        <img src="{{ Storage::url($job->profile->profile_pic) }}" alt="logo" width="100" class="rounded-circle">
                        <br>
                        <span class="d-block fw-bold">{{ $job->title }}</span>
                        <hr>
                        <span>{{ $job->profile->name }}</span>
                        <div class="d-flex flex-row align-items-center justify-content-center">
                            <small class="ms-1">{{ $job->address }}</small>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <span>₱{{ number_format($job->salary,2) }}</span>
                            <a href="{{ route('job.show', [$job->slug]) }}">
                                <button class="btn btn-sm btn-outline-dark">Apply</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .card:hover {
        background-color: #efefef;
    }
</style>

@endsection