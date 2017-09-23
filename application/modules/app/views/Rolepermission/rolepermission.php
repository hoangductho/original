<div class="float-left frame-page" >
    <form class='float-left' id="rolepermission">
        <div class="form-group">
            <h3>Edit</h3>
        </div>
        <div class="form-group has-success row">
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <select id='group_id' class="form-control" name='group_id'>
                        <option>-- Select Group --</option>
                        <?php if(isset($groups)) {
                            foreach ($groups as $key => $value) {
                                echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <select id='role_id' class="form-control" name="role_id">
                        <option>-- Select Role --</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <select id='permission_id' class="form-control" name="permission_id">
                        <option>-- Select Permission --</option>
                        <?php if(isset($permissions)) {
                            foreach ($permissions as $key => $value) {
                                echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <!-- <a class="btn btn-info pull-right ml-1 mr-1" href="javascript:groups_delete();">Delete</a> -->
                <button class="btn btn-dangerous pull-right" type="reset">Clear</button>
                <a class="btn btn-info pull-right ml-1 mr-1" href="javascript:rolepermissions_edit();">Submit</a>
            </div>
        </div>
        <div class="form-group">
            <p id='message'></p>
        </div>
    </form>
</div>
<div class="float-left frame-page">
    <table id="datatable" class="display float-left">
        <thead>
            <tr>
                <th class="col-md-1 col-sm-1">No.</th>
                <th class="col-md-3 col-sm-3">Group</th>
                <th class="col-md-3 col-sm-3">Role</th>
                <th class="col-md-3 col-sm-3">Permission</th>
                <th class="col-md-2 col-sm-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($usergroups)) {
                foreach($usergroups as $key => $item) {?>
                    <tr id='<?php echo $key;?>'>
                        <td><?php echo $key + 1;?></td>
                        <td class="name">
                            <?php echo $item['group_name'];?>
                            <span hidden="" class="group_id"><?php echo $item['group_id']?></span>
                        </td>
                        <td class="type">
                            <?php echo $item['role_name'];?>
                            <span hidden="" class="role_id"><?php echo $item['role_id']?></span>
                        </td>
                        <td class="privacy">
                            <?php echo $item['permission_name'];?>
                            <span hidden="" class="permission_id"><?php echo $item['permission_id']?></span>
                        </td>
                        <td>
                            <a href="javascript:rolepermissions_set_data(<?php echo $key?>);"><i class="fa fa-edit info" aria-hidden="true"></i></a>
                        </td>
                    </tr>
            <?php } }?>
        </tbody>
    </table>
</div>


