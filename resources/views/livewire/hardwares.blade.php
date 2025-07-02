<tbody wire:poll.30s>

    @foreach($hardwares as $hardware)
        <tr>
            <th scope="row">{{ $hardware->hrdws_serial_number }}</th>
            <td>{{ $hardware->hrdws_hw_identifier }}</td>
            <td>{{ $hardware->hrdws_model_number }}</td>
            <td>{{ $hardware->hrdws_qty }}</td>
            <td>{{ $hardware->hrdws_family }}</td>
            <td>{{ $hardware->hrdws_city }}</td>
            <td>{{ $hardware->hrdws_state }}</td>
            <td>
                @if($hardware->hrdws_qty == 0)
                    <span class="badge bg-danger">Out of Stock</span>
                @else
                    <a href="{{ url('/customer/session/marketplace/hardwares-details/' . $hardware->hrdws_id) }}"
                        class="btn btn-sm btn-outline-primary" title="View H/W Details">View</a>
                @endif
            </td>
            <!-- <td ><a href="{{ url('/customer/session/marketplace/hardwares-details/'.$hardware->hrdws_id) }}" class="btn btn-sm btn-outline-primary" title="View H/W Details">View</a></td> -->
        </tr>
    @endforeach

</tbody>