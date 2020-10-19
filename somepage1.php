<?
$famID=$_GET['famID'];
$famAddr=$_GET['famAddr'];
$famPhone=$_GET['famPhone'];
$famName=$_GET['famName'];

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="fam_id">Name <?php echo $famName;?></h4>
</div>
<div class="modal-body">
    <form id="form1" method="post">
        <b>Details</b>
        <hr></hr>
        Address: <p><?php echo $famAddr;?></p>
        Phone_num: <p><?php echo $famPhone;?></p>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>