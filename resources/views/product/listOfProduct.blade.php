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
	
		@if(count($product)>0)
			@foreach($product as $newProduct)
			<div class="container">
				<div class="card" style="width: 18rem;">
				  <img class="card-img-top" src="..." alt="Card image cap">
				  <div class="card-body">
				  	 <h5 class="card-title">{{$newProduct->id}}</h5>
				    <h5 class="card-title">{{$newProduct->product_name}}</h5>
				    <h5 class="card-title">{{$newProduct->product_quantity}}</h5>
				    <h5 class="card-title">{{$newProduct->product_price}}</h5>

				    @if($newProduct->product_quantity == 0)
				    	<lable>Out Of Stock</lable>
				    
				    @else
				    <a href="#" class="btn btn-primary addtoCart" data-id="{{$newProduct->id}}" id="addTocart">Add To Cart</a>
				    @endif
				  </div>
				</div>
			</div>
			@endforeach
		@endif

		<div class="dyanamicDiv">
			
		</div>

	<a href="{{route('order.checkout')}}" class="btn btn-info">Checkout</a>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

		// $('#addToCart').click(function(e){
		// 	e.preventDefault();
		// 	var ele=$(this);


		// 	$.ajax({
		// 		url:'#',
		// 		method:"post",
		// 		data:{
		// 			_token:"{{csrf_token()}}",
		// 			id:ele.parents("tr").attr("data-id"),
		// 			quantity:ele.parents("tr").find(".quantity").val()
		// 		},

		// 		success:function(response){
		// 			window.location.reload();
		// 		}
		// 	});
		// });
	})
	$(document).on('click','.addtoCart',function(){
		var id=$(this).data('id');
			$.ajax({
				url:'{{route("add.carts")}}',
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