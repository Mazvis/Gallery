{{ Form::open(array('route' => 'user.mysubscribtions', 'id' => 'subscribe')) }}
    <div class="form-group">
        <label class="control-label col-lg-4">Select user</label>
        <div class="col-lg-6">
            {{ Form::select('user_id', $subs, null, array('class' => 'form-control')) }}
        </div>
        <div class="form-submit col-lg-2">
            <button type="submit" class="btn btn-sm btn-success">View actions</button>
        </div>
    </div>
{{ Form::token() }}
{{ Form::close() }}