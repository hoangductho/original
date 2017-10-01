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