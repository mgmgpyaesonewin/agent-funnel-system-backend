@extends('layouts.contentLayoutMaster')

@section('title')Import History @endsection

@section('content')
<div class="row justify-content-center">
  <div class="col-10">
    <div class="card">
      <div class="card-content">
        <ul class="list-group list-group-flush">
        @if($files)
        @foreach($files as $file)
          <li class="list-group-item">
            <span class="float-right">
              <a href="{{ url('setting/download_history/'.$file->id)}}" class="btn btn-info">Download</a>
            </span>
            @php $filename =  str_replace('.xlsx','', str_replace('ImportHistory', 'Import History of ', $file->file_name));
              echo substr($filename, 0, strpos($filename, "_"));  
            @endphp
          </li>
        @endforeach
        @endif
        </ul>
      </div>
    </div>
  </div>
</div>

</form>
@endsection