<div class="float-left frame-page" >
    <form class='float-left' id="permission">
        <div class="form-group">
            <h3>Edit</h3>
        </div>
        <div class="row form-group has-success">
            <div class="col-md-5 col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Permissions name" name="name">
                </div>
            </div>
            <div class="col-md-1 col-sm-4">
                <div class="form-group">
                    <label>Read </label>
                    <input type="checkbox" name="readable" value="1">
                </div>
            </div>
            <div class="col-md-1 col-sm-4">
                <div class="form-group">
                    <label>Write </label>
                    <input type="checkbox" name="writable" value="1">
                </div>
            </div>
            <div class="col-md-1 col-sm-4">
                <div class="form-group">
                    <label>Execute </label>
                    <input type="checkbox" name="executable" value="1">
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
                    <button class="btn btn-dangerous pull-right" type="reset">Clear</button>
                    <a class="btn btn-info pull-right mr-1" href="javascript:permissions_edit();">Submit</a>
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
                <th class="col-md-6 col-sm-4">Name</th>
                <th class="col-md-1 col-sm-1">Read</th>
                <th class="col-md-1 col-sm-1">Write</th>
                <th class="col-md-1 col-sm-1">Execute</th>
                <th class="col-md-1 col-sm-2">Status</th>
                <th class="col-md-1 col-sm-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($permissions)) {
                foreach($permissions as $key => $item) {?>
                    <tr id='<?php echo $item['id']?>'>
                        <td><?php echo $key + 1;?></td>
                        <td class="name"><?php echo $item['name'];?></td>
                        <td class="">
                            <span hidden="" class="readable"><?php echo $item['readable'];?></span>
                            <?php echo '<i class="fa '. ($item['readable'] == 1 ? 'fa-check' : null) .' success" aria-hidden="true"></i>';?>
                        </td>
                        <td class="">
                            <span hidden="" class="writable"><?php echo $item['writable'];?></span>
                            <?php echo '<i class="fa '. ($item['writable'] == 1 ? 'fa-check' : null) .' success" aria-hidden="true"></i>';?>
                        </td>
                        <td class="">
                            <span hidden="" class="executable"><?php echo $item['executable'];?></span>
                            <?php echo '<i class="fa '. ($item['executable'] == 1 ? 'fa-check' : null) .' success" aria-hidden="true"></i>';?>
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
                            <a href="javascript:permissions_set_data(<?php echo $item['id']?>);"><i class="fa fa-edit info" aria-hidden="true"></i></a>
                        </td>
                    </tr>
            <?php } }?>
        </tbody>
    </table>
</div>


