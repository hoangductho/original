<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Writing Article</div>
					<div class="panel-body">
						<div class="col-md-12 col-lg-12">
							<form id="article" role="form" class=" has-success">
								<div class="form-group">
									<label>Tiêu đề</label>
									<input class="form-control" placeholder="Tiêu đề bài viết" type="text" name='title'>
								</div>
								
								<div class="form-group">
									<div class="col-lg-6 col-sm-12 non-padding-left" style="border-right: 1px solid #ddd; ">
										<div class="form-group">
											<label>Mô tả</label>
											<textarea class="form-control" rows="3" name='description'></textarea>
										</div>
										
										<div class="form-group" >
											<label>Ảnh minh họa</label>
											<input id='avatar' class="form-control" placeholder="Link ảnh" type="url" name='image'>
											<br>
											<img id='avatar-show' src="" alt="" width="240" height="135" style="display: block;">
										</div>

									</div>
									<div class="col-lg-6 col-sm-12 non-padding-right">
										<div class="form-group">
											<label>Chủ đề</label>
											<select class="form-control" name='category'>
												<?php 
												if(isset($categories)) { 
													foreach ($categories as $key => $value) {
														echo '<option value='.$value['id'].'>'.$value['name'].'</option>';
													}
												}
												?>
											</select>
										</div>

										<div class="form-group">
											<label>Từ khóa</label>
											<input class="form-control" placeholder="Từ khóa trong bài viết" type="text" name='keyword'>
										</div>

										<div class="form-group">
											<label>Loạt bài viết</label>
											<input class="form-control" placeholder="Tên loạt bài viết" type="text" name='series' list="series">
											<datalist id='series'>
												<?php if(isset($series)) {
													foreach ($series as $key => $value) {
														echo '<option value="'.$value['name'].'">'.$value['name'].'</option>';
													}
												}
												?>
											</datalist>
										</div>

										<div class="form-group">
											<label>Quyền truy cập</label>
											<select name="privacy" class="form-control">
						                        <option value="0">Private</option>
						                        <option value="1" selected="">Public</option>
						                        <option value="2">Protected</option>
						                    </select>
										</div>
										
										<div class="form-group">
											<label>Trạng thái gửi </label>
											<select name="status" class="form-control"  value="<?php echo $article['status'];?>">
						                        <option value="0">Draft</option>
						                        <option value="1">Complete</option>
						                        <option value="2">Editing</option>
						                        <option value="3">Cancel</option>
						                    </select>
										</div>
									</div>
								</div>
								<br/>


								<div class="form-group">
									<div id="editormd">
									    <textarea style="display:none;" rows="15" name="content"></textarea>
									</div>
								</div>
								<div class="form-group">
									<button class="btn btn-dangerous pull-right" type="reset">Reset</button>
									<a class="btn btn-info pull-right ml-1 mr-1" href="javascript:articles_edit();">Submit</a>
								</div>
								<div class="form-group">
									<p id='message'></p>
								</div>
								
							</div>
							<!-- <div class="col-md-6">
							
								<div class="form-group">
									<label>Checkboxes</label>
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">Checkbox 1
										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">Checkbox 2
										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">Checkbox 3
										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">Checkbox 4
										</label>
									</div>
								</div>
								
								<div class="form-group">
									<label>Radio Buttons</label>
									<div class="radio">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>Radio Button 1
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Radio Button 2
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">Radio Button 3
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">Radio Button 4
										</label>
									</div>
								</div>
								
								<div class="form-group">
									<label>Selects</label>
									<select class="form-control">
										<option>Option 1</option>
										<option>Option 2</option>
										<option>Option 3</option>
										<option>Option 4</option>
									</select>
								</div>
								
								<div class="form-group">
									<label>Multiple Selects</label>
									<select multiple class="form-control">
										<option>Option 1</option>
										<option>Option 2</option>
										<option>Option 3</option>
										<option>Option 4</option>
									</select>
								</div>
								
								<button type="submit" class="btn btn-primary">Submit Button</button>
								<button type="reset" class="btn btn-default">Reset Button</button>
							</div> -->
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->