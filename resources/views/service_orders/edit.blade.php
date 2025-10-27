<form action="{{ route('service_orders.update', $serviceOrder->id) }}" method="POST" onsubmit="submitServiceOrderForm(event)">
    @csrf
    @method('PUT')

    
</form>
