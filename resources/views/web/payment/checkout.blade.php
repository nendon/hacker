
<form action="{{ url('checkout') }}" method="POST">
  {{ csrf_field() }}
  <input type="submit" value="Pay with VT-Web">

</form>

<script>
fbq('track', 'InitiateCheckout');
</script>