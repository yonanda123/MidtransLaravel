<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/style.css')}}">
  </head>
  <body>
  <div class="kotak_login">
	<p class="tulisan_login">Silahkan login</p>
 
	<form action="/payment" method="GET">
		<label>Username</label>
		<input type="text" name="uname" class="form_login" placeholder="Masukkan Username" required>
		
		<label>Email</label>
		<input type="email" name="email" class="form_login" placeholder="Masukkan Email" required>

		<label>Nomor</label>
		<input type="number" name="nomor" class="form_login" placeholder="Masukkan Nomor" required>
 
		<input type="submit" class="tombol_login" value="LANJUT">
 
		<br/>
		<br/>
		<!-- <center>
			<a class="link" href="https://www.malasngoding.com">kembali</a>
		</center> -->
	</form>
	@if (session('aler-success'))
		<script>alert("{{ session('alert-success') }}")</script>
	@elseif(session('alert-failed'))
		<script>alert("{{ session('alert-failed') }}")</script>
	@endif
	</div>
    <body>
</html>