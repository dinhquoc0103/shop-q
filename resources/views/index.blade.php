dsds
<form action="" method="post">
   @csrf
   <input type="text" name=name" id="" value="{{ old("name") }}">
   @error('name')
       {{ $message }}
   @enderror
   <input type="submit" value="submit">
</form>


{{ dd(auth()->check()); }}