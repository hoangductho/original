<div class="float-left frame-page" >
    <form class='float-left' id="group">
        <div class="form-group">
            <h3>Edit</h3>
        </div>
        <div class="form-group has-success">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Group name" name="name">
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <textarea class="form-control" placeholder="Discription" name="description" rows="1"></textarea>
                </div>
            </div>
        </div>
        <div class="form-group has-success">
            
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <div class="col-md-4 non-padding-x">
                        <label>Type :</label>
                    </div>
                    <div class="col-md-8 non-padding-x">
                        <select name="type" class="form-control">
                            <option value="0" selected="">System</option>
                            <option value="1">User</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <div class="col-md-4 non-padding-x">
                        <label>Status :</label>
                    </div>
                    <div class="col-md-8 non-padding-x">
                        <select name="status" class="form-control">
                            <option value="0">Deactive</option>
                            <option value="1" selected="">Active</option>
                            <option value="2">Block</option>
                            <option value="2">Banned</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <div class="col-md-4 non-padding-x">
                        <label>Privacy :</label>
                    </div>
                    <div class="col-md-8 non-padding-x">
                        <select name="privacy" class="form-control">
                            <option value="0">Private</option>
                            <option value="1" selected="">Public</option>
                            <option value="2">Protected</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <div class="col-md-4 non-padding-x">
                        <label>Region :</label>
                    </div>
                    <div class="col-md-8 non-padding-x">
                        <select name="region" class="form-control">
                            <?php if(isset($regions)) {
                                foreach ($regions as $key => $value) {
                                    echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                }
                            }?>
                        </select>
                    </div>
                </div>
                <input type="text" name="id" value="0" hidden>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12 mt-1">
                <button class="btn btn-dangerous pull-right" type="reset">Clear</button>
                <a class="btn btn-info pull-right ml-1 mr-1" href="javascript:groups_edit();">Submit</a>
            </div>
            <p id='message'></p>
        </div>
    </form>
</div>
<div class="float-left frame-page">
    <table id="datatable" class="display float-left">
        <thead>
            <tr>
                <th class="col-md-1 col-sm-1">No.</th>
                <th class="col-md-6 col-sm-5">Name</th>
                <th class="col-md-1 col-sm-1">Type</th>
                <th class="col-md-1 col-sm-1">Privacy</th>
                <th class="col-md-1 col-sm-1">Region</th>
                <th class="col-md-1 col-sm-1">Status</th>
                <th class="col-md-1 col-sm-2"></th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($groups)) {
                foreach($groups as $key => $item) {?>
                    <tr id='<?php echo $item['id']?>'>
                        <td><?php echo $key + 1;?></td>
                        <td class="name">
                            <?php echo $item['name'];?>
                            <span hidden="" class="group-name"><?php echo $item['name']?></span>
                            <span hidden="" class="group-description"><?php echo $item['description']?></span>
                        </td>
                        <td class="type">
                            <?php echo $this->__DICT__['group_type'][$item['type']];?>
                            <span hidden="" class="group-type"><?php echo $item['type']?></span>
                        </td>
                        <td class="privacy">
                            <?php echo $this->__DICT__['privacy'][$item['privacy']];?>
                            <span hidden="" class="group-privacy"><?php echo $item['privacy']?></span>
                        </td>
                        <td class="region">
                            <?php echo isset($regions_list[$item['region']]) ? $regions_list[$item['region']] : 0;?>
                            <span hidden="" class="group-region"><?php echo $item['region']?></span>
                        </td>
                        <td class="status-box">
                            <span hidden="" class="group-status"><?php echo $item['status']?></span>
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
                            <a href="javascript:groups_set_data(<?php echo $item['id']?>);"><i class="fa fa-edit info" aria-hidden="true"></i></a>
                        </td>
                    </tr>
            <?php } }?>
        </tbody>
    </table>
</div>


