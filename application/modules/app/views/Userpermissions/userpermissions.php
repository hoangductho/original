<div class="float-left frame-page" >
    <form class='float-left' id="userpermission">
        <div class="form-group">
            <h3>Edit</h3>
        </div>
        <div class="form-group has-success row">
            <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <!-- <input class="form-control" placeholder="Email" type="text" name='email' list="emails"> -->
                    <select id='email' class="form-control combobox" name="account_id">
                        <option value="">-- Select User --</option>
                        <?php if(isset($emails)) {
                            foreach ($emails as $key => $value) {
                                echo '<option value="'.$value['id'].'">'.$value['email'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <select id='group_id' class="form-control" name='group_id'>
                        <option value="">-- Select Group --</option>
                        <?php if(isset($groups)) {
                            foreach ($groups as $key => $value) {
                                echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <select id='role_id' class="form-control" name="role_id">
                        <option value="">-- Select Role --</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <select id='permission_id' class="form-control" name="permission_id">
                        <option value="">-- Select Permission --</option>
                        <?php if(isset($permissions)) {
                            foreach ($permissions as $key => $value) {
                                echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <select id='region_id' class="form-control" name="region_id">
                        <option value="">-- Select Region --</option>
                        <?php if(isset($regions)) {
                            foreach ($regions as $key => $value) {
                                echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <!-- <a class="btn btn-info pull-right ml-1 mr-1" href="javascript:groups_delete();">Delete</a> -->
                <button class="btn btn-dangerous pull-right" type="reset">Clear</button>
                <a class="btn btn-info pull-right ml-1 mr-1" href="javascript:userpermissions_filter();">Search</a>
            </div>
        </div>
        <div class="form-group">
            <p id='message'></p>
        </div>
    </form>
</div>
<div class="float-left frame-page"  id="list_userpermissions">
    <table id="datatable" class="display float-left">
        <thead>
            <tr>
                <th class="col-md-1 col-sm-1">No.</th>
                <th class="col-md-1 col-sm-5">User</th>
                <th class="col-md-1 col-sm-1">Group</th>
                <th class="col-md-1 col-sm-1">Role</th>
                <th class="col-md-1 col-sm-1">Permission</th>
                <th class="col-md-1 col-sm-1">Privacy</th>
                <th class="col-md-1 col-sm-1">Type</th>
                <th class="col-md-1 col-sm-1">Region</th>
                <th class="col-md-1 col-sm-1">Readable</th>
                <th class="col-md-1 col-sm-1">Writable</th>
                <th class="col-md-1 col-sm-1">Executable</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($userpermissions)) {
                foreach($userpermissions as $key => $item) {?>
                    <tr id='<?php echo $key;?>'>
                        <td><?php echo $key + 1;?></td>
                        <td class="">
                            <?php echo $item['email'];?>
                        </td>
                        <td class="">
                            <?php echo $item['group_name'];?>
                        </td>
                        <td class="">
                            <?php echo $item['role_name'];?>
                        </td>
                        <td class="">
                            <?php echo $item['permission_name'];?>
                        </td>
                        <td class="">
                            <?php echo $this->__DICT__['privacy'][$item['privacy']];?>
                        </td>
                        <td class="">
                            <?php echo $this->__DICT__['group_type'][$item['type']];?>
                        </td>
                        <td class="">
                            <?php echo $item['region_name'];?>
                        </td>
                        <td class="">
                            <?php echo '<i class="fa '. ($item['readable'] == 1 ? 'fa-check' : null) .' success" aria-hidden="true"></i>';?>
                        </td>
                        <td class="">
                            <?php echo '<i class="fa '. ($item['writable'] == 1 ? 'fa-check' : null) .' success" aria-hidden="true"></i>';?>
                        </td>
                        <td class="">
                            <?php echo '<i class="fa '. ($item['executable'] == 1 ? 'fa-check' : null) .' success" aria-hidden="true"></i>';?>
                        </td>
                    </tr>
            <?php } }?>
        </tbody>
    </table>
</div>


