<form action="{{ url('/convert/data') }}" method="POST">
  @csrf
  <label for="">Data</label>
  <label>
    <textarea name="data" cols="30" rows="10"></textarea>
  </label>
  <input type="submit" value="Submit">
</form>
