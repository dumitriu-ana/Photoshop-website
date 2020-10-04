@extends('layouts.baselayout')

@section('title', 'Recover your password')
@section('header', 'Recover your password')

@section('content')

<br><br>
<center><form class="form-inline" action="/forgot-password" method="post">
  @csrf
  <div class="form-group">
    <div class="col-lg-3">
    <label for="mail">Your mail address</label>
  </div>
  <div class="col-lg-9">
    <input class="form-control" type="text" id="mail" name="mail"
    placeholder="mail adress" placeholder="mail" required>
    </div>
  </div>
  <br><br>

  <input class="btn btn-sm" type="submit" name="send" value="Send mail">
</form>
</center>

@endsection
