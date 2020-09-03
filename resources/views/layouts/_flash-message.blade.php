@if (session()->has('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p class="mb-0">{{ session('status') }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

<!-- Error message if either one of the fromDate or toDate is not chosen -->
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <p class="mb-0">{{$errors->first()}}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif
{{-- error message end --}}