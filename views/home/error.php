<main>
<h2>Error:</h2>
<p>Oops, this is the error page.</p>
<?php
 if(isset($this->msg)){
 	echo $this->msg;
 }
 else
 	echo 'wrong controller';
?>
<br/>
</main>