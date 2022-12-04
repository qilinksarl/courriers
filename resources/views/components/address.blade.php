@if($person['type'] === \App\Enums\AddressType::PROFESSIONAL)
    {{ $person['compagny'] }}<br/>
@else
    {{ $person['first_name'] }} {{ $person['last_name'] }}<br/>
@endif
@if($person['address_line_2'])
    {{ $person['address_line_2'] }}<br/>
@endif
@if($person['address_line_3'])
    {{ $person['address_line_3'] }}<br/>
@endif
@if($person['address_line_4'])
    {{ $person['address_line_4'] }}<br/>
@endif
@if($person['address_line_5'])
    {{ $person['address_line_5'] }}<br/>
@endif
{{ $person['postal_code'] }} {{ $person['city'] }}<br/>
{{ $person['country'] }}
