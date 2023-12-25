@extends('layouts.app')

@section('content')
<div class="container py-5 px-4">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <img src="{{ Storage::url($listing->feature_image) }}" alt="" class="card-img-top">
                <div class="card-body">
                    <h2 class="card-title">{{ $listing->title }}</h2>
                    <span class="badge bg-primary">{{ $listing->job_type }}</span>
                    <p class="mt-3">Salary: <span class="fw-bold">₱{{ number_format($listing->salary,2) }}</span></p>
                    <p>Address: <span class="fw-bold">{{ $listing->address }}</span></p>
                    <h4 class="mt-4">Description</h4>
                    <p class="card-text">{!! $listing->description !!}</p>
                    <h4>Roles and Responsibilities</h4>
                    {!! $listing->roles !!}
                    <p class="card-text mt-4">Application Closing Date: <span class="fw-bold">{{ $listing->application_close_date }}</span></p>
                    @if($listing->profile->resume)
                    <a href="#" class="btn btn-primary mt-3">Apply Now</a>
                    @else
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Apply
                    </button>
                    @endif

                    {{-- Modal --}}
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Resume</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <input type="file" id="uploadResumeFile">
                            </div>
                            <div class="modal-footer">
                              <button type="button" disabled class="btn btn-primary" id="btnApply">Apply</button>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Get a reference to the file input element
    const uploadResume = document.querySelector('#uploadResumeFile');

    // Create a FilePond instance
    const pond = FilePond.create(uploadResume);

    pond.setOptions({
    server: {
        url: '/resume/upload',
        process: {
            method: 'POST',
            withCredentials: false,
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            ondata: (formData) => {
                formData.append('file', pond.getFiles()[0].file, pond.getFiles()[0].file.name)

                return formData
            },
            onload: (response) =>{
                document.getElementById('btnApply').removeAttribute('disabled')
            },
            onerror: (response) => {
                console.log('Error while uploading...', response)
            }
        },
    },
});
</script>
@endsection