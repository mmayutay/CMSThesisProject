<h1>Edit Profile</h1>

{!! Form::open(['action' => ['UserDisplayController@index', $info->id], 'method' => 'POST']) !!}
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
    {{ Form::hidden('_method', 'PUT')}}
    {{ Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        
{!! Form::close() !!}