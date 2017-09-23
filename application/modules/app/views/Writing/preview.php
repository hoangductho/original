<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Preview Article: <?php echo !empty($article['title']) ? $article['title'] : null?></div>
			<div class="panel-body">
				<div class="col-md-12 col-lg-12">
					<div class="article" id=''>
						<div class="row col-md-12 padding-x article-description">
							<p><?php echo !empty($article['description']) ? $article['description'] : null?></p>
						</div>
						<pre class="row" id='md_content' hidden=""><?php echo !empty($article['content']) ? $article['content'] : null?></pre>
						<div class="row article-content  col-md-12" id='html_content'></div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.col-->
</div><!-- /.row -->