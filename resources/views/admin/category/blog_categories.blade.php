{!! Form::open(array('route' => 'category.edit', 'method' => 'GET')) !!}
	<ul>
		<li>
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name') !!}
		</li>
		<li>
			{!! Form::label('slug', 'Slug:') !!}
			{!! Form::text('slug') !!}
        </li>
        <li>
			{!! Form::label('parent', 'Parent::') !!}
			{!! Form::text('parent') !!}
		</li>
		<li>
			{!! Form::label('description', 'Description:') !!}
			{!! Form::text('description') !!}
        </li>
        <li>
			{!! Form::label('updated_at', 'Updated_at::') !!}
			{!! Form::text('updated_at') !!}
        </li>
        <li>
			{!! Form::label('created_at', 'Created_at:') !!}
			{!! Form::text('created_at') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}
