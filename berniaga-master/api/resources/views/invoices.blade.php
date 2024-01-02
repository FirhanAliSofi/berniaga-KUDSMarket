<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Aokwokwok</th>
    </tr>
    </thead>
    <tbody>
    @foreach($seller as $invoice)
        <tr>
            <td>{{ $invoice->nama }}</td>
            <td>{{ $invoice->email }}</td>
            <td>{{ $invoice->provinces->prov_name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>