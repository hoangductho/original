<div class="float-left frame-page" >
    <form class='float-left' id="role">
        <div class="form-group">
            <h3>Edit</h3>
        </div>
        <div class="row form-group has-success">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Roles name" name="name">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <select id='group_id' class="form-control" name='group_id'>
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
                    <select name="status" class="form-control">
                        <option value="0">Disable</option>
                        <option value="1" selected="">Enable</option>
                        <option value="2">Closed</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <input type="text" name="id" value="0" hidden>
                    <a class="btn btn-info" href="javascript:roles_edit();">Submit</a>
                    <button class="btn btn-dangerous" type="reset">Clear</button>
                </div>
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
                <th class="col-md-4 col-sm-4">Name</th>
                <th class="col-md-4 col-sm-4">Group</th>
                <th class="col-md-1 col-sm-1">Status</th>
                <th class="col-md-2 col-sm-2"></th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($roles)) {
                foreach($roles as $key => $item) {?>
                    <tr id='<?php echo $item['id']?>'>
                        <td><?php echo $key + 1;?></td>
                        <td class="name"><?php echo $item['name'];?></td>
                        <td class="group_name">
                            <?php echo $item['group_name'];?>
                            <span hidden="" class="group_id"><?php echo $item['group_id'];?></span>
                        </td>
                        <td class="status-box">
                            <span hidden="" class="status"><?php echo $item['status']?></span>
                            <?php switch ($item['status']) {
                                case 0:
                                    echo '<i class="fa fa-close error" aria-hidden="true"></i>';
                                    break;
                                case 1:
                                    echo '<i class="fa fa-check success" aria-hidden="true"></i>';
                                    break;
                                case 2:
                                    echo '<i class="fa fa-lock error" aria-hidden="true"></i>';
                                    break;
                                
                                default:
                                    break;
                            }?>
                        </td>
                        <td>
                            <?php 
                            // switch ($item['status']) {
                            //     case 0:
                            //         echo '<a href=""><i class="fa fa-check success" aria-hidden="true"></i></a>';
                            //         break;
                            //     case 1:
                            //         echo '<a href=""><i class="fa fa-close error" aria-hidden="true"></i></a>';
                            //         break;
                            //     case 2:
                            //         echo '<a href=""><i class="fa fa-unlock success" aria-hidden="true"></i></a>';
                            //         break;
                                
                            //     default:
                            //         break;
                            // }
                            ?>
                            <a href="javascript:roles_set_data(<?php echo $item['id']?>);"><i class="fa fa-edit info" aria-hidden="true"></i></a>
                        </td>
                    </tr>
            <?php } }?>
        </tbody>
    </table>
</div>


