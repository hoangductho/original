<table id="datatable" class="display float-left">
    <thead>
        <tr>
            <th class="col-md-1 col-sm-1">Avatar</th>
            <th class="col-md-5 col-sm-4">Name</th>
            <th class="col-md-1 col-sm-2">Category</th>
            <th class="col-md-2 col-sm-2">Time</th>
            <th class="col-md-1 col-sm1">Status</th>
            <th class="col-md-2 col-sm2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($articles)) {
            foreach($articles as $key => $item) {?>
                <tr id='<?php echo $item['id']?>'>
                    <td><img class="thumb-mini" src="<?php echo !empty($item['image']) ? $item['image'] : null?>"></td>
                    <td class="name"><?php echo $item['title'];?></td>
                    <td class="name"><?php echo !empty($categories[$item['category_id']]) ? $categories[$item['category_id']] : null;?></td>
                    <td class="name"><?php echo $item['created_date'];?></td>
                    <td class="status-box">
                        <span hidden="" class="status"><?php echo $item['status']?></span>
                        <?php switch ($item['status']) {
                            case 1:
                                echo '<i class="fa fa-check success" data-toggle="tooltip" title="Approved" aria-hidden="true"></i>';
                                break;
                            case 2:
                                echo '<i class="fa fa-lock error" data-toggle="tooltip" title="Locked" aria-hidden="true"></i>';
                                break;
                            case 3:
                                echo '<i class="fa fa-close error" data-toggle="tooltip" title="Canceled" aria-hidden="true"></i>';
                                break;
                            default:
                                echo '<i class="fa fa-edit success" data-toggle="tooltip" title="Editing" aria-hidden="true"></i>';
                                break;
                        }?>
                    </td>
                    <td>
                        <a href="/app/writing/preview/<?php echo $item['id']?>" data-toggle="tooltip" title="Preview Article"><i class="fa fa-eye info" aria-hidden="true"></i></a> 
                        &nbsp;
                        <a href="/app/articles/redact/<?php echo $item['id']?>" data-toggle="tooltip" title="Redact Article"><i class="fa fa-upload success" aria-hidden="true"></i></a>
                        &nbsp;
                        <a href="" data-toggle="tooltip" title="Approve"><i class="fa fa-globe success" aria-hidden="true"></i></a>
                        &nbsp;
                        <a href="" data-toggle="tooltip" title="Reject"><i class="fa fa-eye-slash error" aria-hidden="true"></i></a>
                        &nbsp;
                        <a href="" data-toggle="tooltip" title="Cancel"><i class="fa fa-trash error" aria-hidden="true"></i></a>
                    </td>
                </tr>
        <?php } }?>
    </tbody>
</table>