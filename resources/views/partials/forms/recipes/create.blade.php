<input type="hidden" name="photos_token" value="{{ $photos_token }}">

<div class="form-group">
    {!! Form::label('title', 'Title: ') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'autofocus', 'required' => 'required']) !!}
    {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description: ') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<span class="text-danger">:message</span>') !!}
</div>

<div class="form-group">
    {!! Form::label('ingredients', 'Ingredients: ') !!}
    {!! Form::text('ingredients[]', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::text('ingredients[]', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::text('ingredients[]', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group ingredient">
    {!! Form::text('ingredients[]', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <a class="btn btn-default" id="add-ingredient">+ Add Ingredient</a>
</div>

<div class="form-group">
    {!! Form::label('directions', 'Directions: ') !!}
    {!! Form::textarea('directions', null, ['class' => 'form-control', 'required' => 'required', 'rows' => '20']) !!}
    {!! $errors->first('directions', '<span class="text-danger">:message</span>') !!}
</div>

{!! Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}