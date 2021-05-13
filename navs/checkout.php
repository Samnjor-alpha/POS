<div class="modal fade" id="checkout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Check Out</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">

                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="customer" class="form-control form-control-user" placeholder="customer name" required>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <input type="number" name="cash"  min="<?php echo $fgfg; ?>" value="<?php echo $fgfg; ?>" class="form-control form-control-user" placeholder="Cash" required>
                            <input hidden type="number" name="casht"  min="<?php echo $fgfg; ?>" value="<?php echo $fgfg; ?>" class="form-control form-control-user" placeholder="Cash" required>

                        </div>

                    </div>
                    <br>
                    <div class="text-right">
                        <button class="btn  btn-block btn-warning " type="submit" name="chk">Proceed</button>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>