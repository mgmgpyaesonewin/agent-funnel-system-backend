<div class="col-6">
    @if ($field)
    <span class="text-success">&check;</span>
    @else
    <span class="text-danger">
      &#10007;</span>  
    @endif
    {{ ucwords(str_replace('_',' ',$fieldName))}}
  </div>