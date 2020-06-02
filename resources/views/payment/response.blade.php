<?php

   if($order_status==="Success")
   {
      echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";

   }
   else if($order_status==="Aborted")
   {
      echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";

   }
   else if($order_status==="Failure")
   {
      echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
   }
   else
   {
      echo "<br>Security Error. Illegal access detected";

   }

   echo "<br><br>";

   echo "<table cellspacing=4 cellpadding=4>";
   for($i = 0; $i < $dataSize; $i++) 
   {
      $information=explode('=',$decryptValues[$i]);
          echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
   }

   echo "</table><br>";
   echo "</center>";
?>