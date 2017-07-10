
<footer>
	<button class="for_but for_but_footer" href="about.php"><i class="fa fa-caret-left " aria-hidden="true" style="margin-right:20px;"></i>НАЗАД</button>
	<button class="for_but for_but_footer" href="about.php" style="float:right;"><i class="fa fa-home" aria-hidden="true" style="margin-right:20px;"></i>НА ГЛАВНУЮ</button>
</footer>
</div>

</div>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).on('ready', function() {
      $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
      $(".center").slick({
        dots: true,
        infinite: true,
        centerMode: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
      $(".variable").slick({
        dots: true,
        infinite: true,
        variableWidth: true
      });
      $(".lazy").slick({
        lazyLoad: 'ondemand', // ondemand progressive anticipated
        infinite: true
      });
    });
  </script>
</body>
</html>