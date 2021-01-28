<h1>Edit Profile</h1>

{!! Form::open(['action' => ['UserDisplayController@update', $info->id], 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('lastname', 'Lastname' )}}
        {{Form::text('lastname', $info->lastname, ['class' => 'form-control', 'placeholder' => 'Lastname'])}}
    </div>
    <div class="form-group">
        {{Form::label('firstname', 'Firstname' )}}
        {{Form::text('firstname', $info->firstname, ['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>
    <div class="form-group">
        {{Form::label('birthday', 'Birthdate' )}}
        {{Form::text('birthday', $info->birthday, ['class' => 'form-control', 'placeholder' => 'Birth Date'])}}
    </div>
    <div class="form-group">
        {{Form::label('age', 'Age' )}}
        {{Form::number('age', $info->age, ['class' => 'form-control', 'placeholder' => 'Age'])}}
    </div>
    <div class="form-group">
        {{Form::label('address', 'Address' )}}
        {{Form::text('address', $info->address, ['class' => 'form-control', 'placeholder' => 'Address'])}}
    </div>
    <div class="form-group">
        {{Form::label('marital_status', 'Marital Status' )}}
        {{Form::text('marital_status', $info->marital_status, ['class' => 'form-control', 'placeholder' => 'Marital Status'])}}
    </div>
    <div class="form-group">
        {{Form::label('email', 'Email' )}}
        {{Form::email('email', $info->email, ['class' => 'form-control', 'placeholder' => 'email@gmail.com'])}}
    </div>
    <div class="form-group">
        {{Form::label('contact_number', 'Contact No.' )}}
        {{Form::text('contact_number', $info->contact_number, ['class' => 'form-control', 'placeholder' => 'Mobile No.'])}}
    </div>
    <div class="form-group">
        {{Form::label('facebook', 'Facebook' )}}
        {{Form::text('facebook', $info->facebook, ['class' => 'form-control', 'placeholder' => 'facebook'])}}
    </div>
    <div class="form-group">
        {{Form::label('instagram', 'Instagram' )}}
        {{Form::text('instagram', $info->instagram, ['class' => 'form-control', 'placeholder' => 'instagram'])}}
    </div>
    <div class="form-group">
        {{Form::label('twitter', 'Twitter' )}}
        {{Form::text('twitter', $info->twitter, ['class' => 'form-control', 'placeholder' => 'twitter'])}}
    </div>
    <div class="form-group">
        {{Form::label('leader', 'Leader' )}}
        {{Form::text('leader', $info->leader, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => 'leader'])}}
    </div>
    <div class="form-group">
        {{Form::label('category', 'Category' )}}
        {{Form::text('category', $info->category, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => 'category'])}}
    </div>
    <div class="form-group">
        {{Form::label('isCGVIP', 'isCGVIP' )}}
        {{Form::text('isCGVIP', $info->isCGVIP, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => 'isCGVIP'])}}
    </div>
    <div class="form-group">
        {{Form::label('isSCVIP', 'isSCVIP' )}}
        {{Form::text('isSCVIP', $info->isSCVIP, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => 'isSCVIP'])}}
    </div>
    <div class="form-group">
        {{Form::label('auxilliary', 'Auxilliary' )}}
        {{Form::text('auxilliary', $info->Auxilliary, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => 'auxilliary'])}}
    </div>
    <div class="form-group">
        {{Form::label('ministries', 'Ministried' )}}
        {{Form::text('ministries', $info->ministries, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => 'ministries'])}}
    </div>

    {{ Form::hidden('_method', 'PUT') }}
    {{ Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        
{!! Form::close() !!}