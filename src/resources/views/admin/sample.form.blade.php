<div class="row">
    <div class="col-sm-12">
        {{ Form::xtext('Key', null, ['placeholder'=>'test']) }}
        {{ Form::xpassword('Password') }}
        {{ Form::xtextarea('textarea', null, ['placeholder'=>'tesg']) }}
        {{ Form::xnumber('number') }}
        {{ Form::xemail('email') }}
        {{ Form::xfile('file') }}

        {{ Form::xradio('rank', 'Scum') }}
        {{ Form::xradio('rank', 'Wannabe') }}
        {{ Form::xradio('rank', 'Goon') }}
        {{ Form::xradio('rank', 'Elite Wannabe') }}

        {{ Form::xcheckbox('checkbox', 'Single choice') }}
        {{ Form::xcheckbox('checkbox', 'Single choice') }}
        {{ Form::xcheckbox('checkbox', 'Single choice') }}


        {{ Form::xdate('date') }}
        {{ Form::xselect('select', [
            'test'  =>  'tset',
            'val'   =>  'value'
        ], 'val') }}
        {{ Form::xsubmit('submit') }}
        {{ Form::xlabel('label') }}
    </div>
</div>