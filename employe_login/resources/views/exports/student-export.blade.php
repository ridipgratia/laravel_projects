<table>
    <thead>
        <tr>
            <th>Employe Code</th>
            <th>Login Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->e_id }}</td>
                <td>{{ $student->login_time }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
