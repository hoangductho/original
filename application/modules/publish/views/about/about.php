<article class="hentry post">

    <h1 class="page-title">Giới thiệu</h1>

    <div class="entry-content">        

        <p>Thông tin là một nguồn tài nguyên, tài sản không giới hạn, không phân biệt biên giới, sắc tộc, tôn giáo. Tuy nhiên, thông tin chỉ có giá trị khi được xác thực, chọn lọc, đánh giá và đáng tin cậy.</p>
		
		<p>Viễn Vọng luôn cố gắng cung cấp, truyền tải tới bạn những thông tin hữu ích, chính xác, đáng tin cậy trong một thời đại internet với nhiều thông tin nhiễu, không đáng tin cậy.</p>
		
		<p>Trong quá trình hoạt động, không thể tránh khỏi có những thiếu xót, Viễn Vọng rất mong nhận được góp ý của các bạn để giúp chúng tôi hoàn thiện hoạt động.</p>

        <blockquote>Thông tin giúp làm tăng hiểu biết của con người, là nguồn gốc của nhận thức và là cơ sở của quyết định.</blockquote>

        <?php if(isset($team)) {
        	$this->view('about/members', array('team' => $team));
        }?>
    </div><!-- .entry-content -->

</article>     