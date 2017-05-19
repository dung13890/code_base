<div class="col-sm-12">
    @component('backend._partials.components.alert')
    @endcomponent
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'required: name']) }}
            </div>
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email', ['class' => 'control-label']) }}
        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'required: email@domain.com']) }}
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                {{ Form::label('password', 'Password', ['class'=>'control-label']) }}
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'required: your password']) }}
            </div>
            <div class="col-sm-6">
                {{ Form::label('password_confirmation', 'Confirm Password', ['class'=>'control-label']) }}
                {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'required: confirm your password']) }}
            </div>
        </div>
    </div>
    @component('backend._partials.components.submit')
    @endcomponent
</div>
