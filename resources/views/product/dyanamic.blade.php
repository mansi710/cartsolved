<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	<title></title>
</head>
<body>
	<table class="table">
		<tr>
			<th>Id</th>
			<th>Product Name</th>
			<th>Product Qty</th>
			<th>Product Price</th>
			<th>Product Total</th>
			<th>Action</th>
		</tr>

		@if(count($carts) > 0)
			@foreach($carts as $cart)
				<tr>
					
					<th>{{$cart->id}}</th>
					<th>{{$cart->product->product_name}}</th>
					<th>{{$cart->qty}}</th>
					<th>{{$cart->price}}</th>
					<th>{{$cart->price*$cart->qty}}</th>
					<th><a href="#" class="btn btn-danger removeCart" data-id="{{$cart->id}}" id="removeFromCart">Remove From Cart</th>
				</tr>
			@endforeach
		@endif
	</table>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">


	function loadCart()
	{
		$.ajax({
			url:'{{route("show.carts")}}',
			method:"get",
			success:function(response){
				$('.dyanamicDiv').html(response.html);
			}
		});
	}


	$(document).ready(function(){
		loadCart();
	})
		$(document).on('click','.removeCart',function(){
		var id=$(this).data('id');
		alert(id);
			$.ajax({
				url:'{{route("remove.carts")}}',
				method:"get",
				data:{
					id:id,
				},
				success:function(response){
				//	window.location.reload();
				loadCart();
				}
			});
		});
</script>
</body>
</html>

 