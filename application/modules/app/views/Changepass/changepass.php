<div class="float-left frame-page" >
    <div class="form-group">
        <h3>Change Password</h3>
    </div>
    <div class="form-group has-success">
        <div class="row col-sm-6">
            <form role="form" id="changepass">
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" data-toggle="tooltip" placeholder="Current Password" name="current_password" type="password" value="">
                    </div>
                    <div class="form-group">
                        <input class="form-control" data-toggle="tooltip" placeholder="New Password" name="new_password" type="password" value="" title="Maximum 128 characters, not contain whitespace">
                    </div>
                    <div class="form-group">
                        <input class="form-control" data-toggle="tooltip" placeholder="Retype Password" name="retype_password" type="password" value="">
                    </div>
                    <div class="form-group">
                        <p id="message"></p>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-danger pull-right" href="javascript:changepass_editing();">Clear</a>
                        <a class="btn btn-info pull-right mr-1" href="javascript:changepass_edit();">Submit</a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <div class="form-group">
        <p id='message'></p>
    </div>
</div>