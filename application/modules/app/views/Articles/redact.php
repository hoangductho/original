<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Editing Article</div>
					<div class="panel-body">
						<div class="col-md-12 col-lg-12">
							<form id="article" role="form" class=" has-success">
								<div class="form-group">
									<label>Tiêu đề</label>
									<input class="form-control" placeholder="Tiêu đề bài viết" type="text" name='title' value="<?php echo $article['title'];?>">
								</div>
								
								<div class="form-group">
									<div class="col-lg-6 col-sm-12 non-padding-left" style="border-right: 1px solid #ddd; ">
										<div class="form-group">
											<label>Mô tả</label>
											<textarea class="form-control" rows="3" name='description'><?php echo $article['description'];?></textarea>
										</div>
										
										<div class="form-group" >
											<label>Ảnh minh họa</label>
											<input id='avatar' class="form-control" placeholder="Link ảnh" type="url" name='image' value="<?php echo $article['image'];?>">
											<br>
											<img id='avatar-show' src="<?php echo $article['image'];?>" alt="" width="240" height="135">
										</div>

									</div>
									<div class="col-lg-6 col-sm-12 non-padding-right">
										<div class="form-group">
											<label>Chủ đề</label>
											<select class="form-control" name='category' value="<?php echo $article['category_id'];?>">
												<?php 
												if(isset($categories)) { 
													foreach ($categories as $key => $value) {
														if($article['category_id'] == $key) {
															echo '<option value='.$key.' selected>'.$value.'</option>';
														}else {
															echo '<option value='.$key.'>'.$value.'</option>';
														}
													}
												}
												?>
											</select>
										</div>

										<div class="form-group">
											<label>Từ khóa</label>
											<input class="form-control" placeholder="Từ khóa trong bài viết" type="text" name='keyword'  value="<?php echo $article['keyword'];?>">
										</div>

										<div class="form-group">
											<label>Loạt bài viết</label>
											<input class="form-control" placeholder="Tên loạt bài viết" type="text" name='series' list="series"  value="<?php echo $article['series'];?>">
											<datalist id='series'>
												<?php if(isset($series)) {
													foreach ($series as $key => $value) {
														echo '<option value="'.$value['name'].'">'.$value['name'].'</option>';
													}
												}
												?>
											</datalist>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div id="editormd">
									    <textarea style="display:none;" rows="15" name="content"><?php echo $article['content'];?></textarea>
									</div>
								</div>

								<div class="form-group">
									<div class="col-lg-6 col-sm-12 non-padding-left" style="border-right: 1px solid #ddd; ">
										<div class="form-group" >
											<label>Publish Time</label>
											<input class="form-control datetimepicker" data-toggle="tooltip" placeholder="Publish time" name="actived_date" type="text" value="<?php echo !empty($article['actived_date']) ? $article['actived_date'] : null;?>">
										</div>
										<div class="form-group" >
											<label>Result</label>
											<select class="form-control" name='result' value="<?php echo !empty($article['result']) ? $article['result'] : null;?>">
												<option value="1" <?php echo $article['result'] == 0 ? 'selected' : null?>>Pending</option>
												<option value="1" <?php echo $article['result'] == 1 ? 'selected' : null?>>Approve</option>
						                        <option value="2" <?php echo $article['result'] == 2 ? 'selected' : null?>>Reject</option>
						                        <option value="3" <?php echo $article['result'] == 3 ? 'selected' : null?>>Cancel</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-sm-12 non-padding-right">
										<div class="form-group">
											<label>Popularity</label>
											<select class="form-control" name='popularity' value="<?php echo !empty($article['popularity']) ? $article['popularity'] : null;?>">
												<option value="1" <?php echo $article['popularity'] == 1 ? 'selected' : null?>>Normal</option>
						                        <option value="2" <?php echo $article['popularity'] == 2 ? 'selected' : null?>>Popular</option>
						                        <option value="3" <?php echo $article['popularity'] == 3 ? 'selected' : null?>>Trending</option>
											</select>
										</div>
									</div>
								</div>

								<div class="form-group">
									<input type="number" name="id" hidden="" value="<?php echo $article['id']?>">
									<button class="btn btn-dangerous pull-right" type="reset">Reset</button>
									<a class="btn btn-info pull-right ml-1 mr-1" href="javascript:articles_redact();">Submit</a>
								</div>
								<div class="form-group">
									<p id='message'></p>
								</div>
								
							</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->