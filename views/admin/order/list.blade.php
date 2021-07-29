
<h1> This is list </h1>

<ul>
@foreach($users as $user)

    <li> {{ $user->name }} </li>

@endforeach
</ul>

