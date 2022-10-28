<style> <?php include public_path('css/header_css.css') ?> </style>
<div class="headerbox">
	<div class="logo">
		<a href="/">Shirzang</a>
	</div>
	<div class="linkbox">
		
		@auth
		  	<span>
			  Welcome {{auth()->user()->name}}
			</span>

			<a href="/market">Market</a>	
			<a href="/cart">Cart</a>		
			<a href="/dashboard">Dashboard</a>	

			<form method="POST" action="/logout">
				@csrf
				<button type="submit">Logout</button>
			</form>
		@else
			<a href="/register" >Register</a>
			<a href="/login" >Login</a>
		@endauth

		<a href="#">About Us</a>
		
	</div>
</div>
