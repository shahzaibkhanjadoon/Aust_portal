<table border="1">
    @foreach($student_personal_info as $data)
    <tr>
        <td>
            {{$data->name}}
</td>
<td>
    {{$data->email}}
</td>
</tr>
@endforeach
</table>