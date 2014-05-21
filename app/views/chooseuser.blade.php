{{ Form::open(array('id' => 'chooseuser')) }}
<div class="form-group">
    <label class="control-label">Username</label>
    <input type="text" name="username" class="form-control"/>
    @if($invalid)
        Can't find user by given username.
    @endif
</div>
<button class="btn btn-lg btn-primary" type="submit">Find user</button>
{{ Form::close() }}