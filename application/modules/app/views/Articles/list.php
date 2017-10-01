<div class="float-left frame-page" >
    <form class='float-left' id="article">
        <div class="form-group has-success">
            
            <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <select name="category" class="form-control">
                        <option value="" selected="">-- Select Category --</option>
                        <?php 
                        if(isset($categories)) { 
                            foreach ($categories as $key => $value) {
                                echo '<option value='.$key.'>'.$value.'</option>';
                            }
                        }
                        ?>
                    </select>  
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <select name="result" class="form-control">
                        <option value="" selected="">-- Select Result --</option>
                        <option value="0">Pending</option>
                        <option value="1">Approve</option>
                        <option value="2">Reject</option>
                        <option value="3">Cancel</option>
                    </select>  
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="" selected="">-- Select Status --</option>
                        <option value="0">Draft</option>
                        <option value="1">Completed</option>
                        <option value="2">Editing</option>
                        <option value="3">Cancel</option>
                    </select>  
                </div>
            </div>
            <!-- <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="">-- Select Privacy --</option>
                        <option value="0">Private</option>
                        <option value="1">Protected</option>
                        <option value="2">Public</option>
                    </select>  
                </div>
            </div> -->
            <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <input class="form-control datepicker" data-toggle="tooltip" placeholder="-- Start Date --" name="startdate" type="text">
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <input class="form-control datepicker" data-toggle="tooltip" placeholder="-- End Date --" name="enddate" type="text">
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <a class="btn btn-info" href="javascript:articles_filter();">Search</a>
                </div>
            </div>
        </div>
        <div class="form-group">
            <p id='message'></p>
        </div>
    </form>
</div>

<div class="float-left frame-page" id="list_articles">
    <?php $this->view('Articles/list_articles', array('articles' => $articles, 'categories' => $categories));?>
</div>
