@component('mail::message')
# Order Being Processed #{{ $orderNo }}

<h5>Hi {{ $user->name }} ,</h5>
We received your #{{ $orderNo }} on {{ $date }}, We’re getting your
order ready and will let you know once it’s verified.
We wish you enjoy shopping with us and hope to see you again real soon!


@component('mail::button', ['url' => route('orders.show', $orderNo)])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
