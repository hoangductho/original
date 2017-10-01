<div class="float-left frame-page" >
        <div class="form-group">
            <h3>Profile</h3>
        </div>
        <div class="form-group has-success">
            <div class="row col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="row col-sm-3">Email: </label>
                    <span><?php echo !empty($profile) ? $profile['email'] : null?></span>
                </div>
                <div id="profile-info" class="form-group panel-collapse collapse in">
                    <div class="form-group">
                        <label class="row col-sm-3">Fisrtname: </label>
                        <span><?php echo !empty($profile) ? $profile['firstname'] : null?></span>
                    </div>
                    <div class="form-group">
                        <label class="row col-sm-3">Lastname: </label>
                        <span><?php echo !empty($profile) ? $profile['lastname'] : null?></span>
                    </div>
                    <div class="form-group">
                        <label class="row col-sm-3">Birthday: </label>
                        <span><?php echo !empty($profile) ? $profile['birthday'] : null?></span>
                    </div>
                    <div class="form-group">
                        <label class="row col-sm-3">Phonenumber: </label>
                        <span><?php echo !empty($profile) ? $profile['mobile'] : null?></span>
                    </div>
                    <div class="form-group">
                        <label class="row col-sm-3">Sex: </label>
                        <span><?php echo !empty($profile) ? ($profile['sex'] == 1 ? 'Male' : 'Female') : null?></span>
                    </div>
                    <div class="form-group">
                        <a href="javascript:profile_editing();">Edit</a>
                    </div>
                </div>
                <form role="form" class="collapse" id="profile">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" data-toggle="tooltip" placeholder="Lastname" name="firstname" type="text" title="Tối đa 64 ký tự" value="<?php echo !empty($profile) ? $profile['firstname'] : null?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" data-toggle="tooltip" placeholder="Fisrtname" name="lastname" type="text" title="Tối đa 64 ký tự" value="<?php echo !empty($profile) ? $profile['lastname'] : null?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control birthday-datepicker" data-toggle="tooltip" placeholder="Birthday" name="birthday" type="text" value="<?php echo !empty($profile) ? date('d/m/Y',strtotime($profile['birthday'])) : null?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" data-toggle="tooltip" placeholder="Phone-number" name="mobile" type="text" value="<?php echo !empty($profile) ? $profile['mobile'] : null?>">
                        </div>
                        <div class="form-group">
                            <input placeholder="Male" name="sex" type="radio" value="1" <?php echo !empty($profile) && $profile['sex'] == 1 ? 'checked' : null?>>
                            <label>Male</label>
                            <span>&nbsp;&nbsp;&nbsp;</span>
                            <input placeholder="Female" name="sex" type="radio" value="0" <?php echo !empty($profile) && $profile['sex'] == 0 ? 'checked' : null?>>
                            <label>Female</label>
                        </div>
                        <div class="form-group">
                            <p id="message"></p>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-danger pull-right" href="javascript:profile_editing();">Clear</a>
                            <a class="btn btn-info pull-right mr-1" href="javascript:profiles_edit();">Submit</a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="form-group">
            <p id='message'></p>
        </div>
</div>