<html>
<head>
<title> Iframe</title>
</head>
<body>
<center>

<iframe src="{{$production_url}}" id="paymentFrame" width="482" height="450" frameborder="0" scrolling="No" ></iframe>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
       $(document).ready(function(){
           window.addEventListener('message', function(e) {
              $("#paymentFrame").css("height",e.data['newHeight']+'px');     
          }, false);

      });
</script>
</center>
</body>
</html>
