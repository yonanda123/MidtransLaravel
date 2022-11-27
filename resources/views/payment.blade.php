<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/style.css')}}">
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-6AFeHp6UoxXcDrHt"></script>
      <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
  </head>
 
  <body>
    <button id="pay-button">Pay!</button>
    
    <form action="" id="submit_form" method="POST">
        @csrf
        <input type="hidden" name="json" id="json_callback">
    </form>

    <script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{$snap_token}}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            console.log(result);
            send_response_to_(result);
          },
          onPending: function(result){
            /* You may add your own implementation here */
             console.log(result);
            send_response_to_(result);
          },
          onError: function(result){
            /* You may add your own implementation here */
             console.log(result);
            send_response_to_(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
          }
        })
      });

      function send_response_to_(result){
            document.getElementById('json_callback').value =  JSON.stringify(result);
            alert(document.getElementById('json_callback').value);
            $('#submit_form').submit();
      }
    </script>
  </body>
</html>