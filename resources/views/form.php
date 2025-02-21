<form action="post" method="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    Nhap gi do di: 
    <input type="text" name="name">
    <button type="submit">Submit</button>
</form>