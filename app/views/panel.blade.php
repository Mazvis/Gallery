<div class="profile-edit">
    <div class="row">

        <div class="col-sm-12">
            <h1>Panel</h1>
            <fieldset>
                {{ Form::open(array('route' => 'create.category', 'method' => 'post', 'class' => 'form-horizontal')) }}
                <legend>Categories</legend>
                <div class="form-group">
                    <label class="control-label col-lg-4">Create category (name)</label>
                    <div class="col-lg-8">
                        {{ Form::text('catName', null, array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4">Create tag (description)</label>
                    <div class="col-lg-8">
                        {{ Form::text('catDescription', null, array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-submit">
                    {{ Form::submit('Create', array('class' => 'btn btn-sm btn-success')) }}
                </div>
                {{ Form::token() }}
                {{ Form::close() }}

                <br><br>
                {{ Form::open(array('route' => 'delete.category', 'method' => 'post', 'class' => 'form-horizontal')) }}
                <div class="form-group">
                    <label class="control-label col-lg-4">Delete category (name)</label>
                    <div class="col-lg-8">
                        {{ Form::text('category', null, array('class'=>'form-control')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-4">or select categories to delete</label>
                    <div class="col-lg-8">
                        {{ Form::select('categories[]', $allExistingCategories, null, array('multiple'=>true, 'class' => 'form-control', 'data-selected-text-format' => 'count', 'data-style' => 'btn-danger')) }}
                    </div>
                </div>

                <div class="form-submit">
                    {{ Form::submit('Delete', array('class' => 'btn btn-sm btn-danger')) }}
                </div>

                {{ Form::token() }}
                {{ Form::close() }}

                <!--<br><br>
                {{ Form::open(array('route' => 'delete.category', 'method' => 'post', 'id' => 'create-tags', 'class' => 'form-horizontal')) }}
                <div class="form-group">
                    <label class="control-label col-lg-4">Select category to edit</label>
                    <div class="col-lg-8">
                        {{ Form::select('tags[]', $allExistingCategories, null, array('id' => 'tags', 'class' => 'form-control', 'data-selected-text-format' => 'count', 'data-style' => 'btn-danger')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-4">edit categories</label>
                    <div class="col-lg-8">
                        {{ Form::select('tags[]', $allExistingCategories, null, array('multiple'=>true, 'id' => 'tags', 'class' => 'form-control', 'data-selected-text-format' => 'count', 'data-style' => 'btn-danger')) }}

                    </div>
                </div>

                <div class="form-submit">
                    {{ Form::submit('Edit', array('class' => 'btn btn-sm btn-default')) }}
                </div>

                {{ Form::token() }}
                {{ Form::close() }}-->
            </fieldset>

        </div>

    </div>
</div>