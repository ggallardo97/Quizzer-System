<h2><?php echo $title;?></h2>
<p>Welcome <?php echo $_SESSION['user']['username']; ?></p>
<ul>
  <li><strong>Total questions: <?php echo $totalq;?></strong></li>
  <li><strong>Type:</strong> Multiple choice</li>
  <li><strong>Warning:</strong> For each question you CANNOT go back</li>
  <li><strong>Estimated time: <?php echo $totalq*2; ?> minutes</strong> (2 minutes per question)</li>
</ul>
<a href="question?idq=1&idexam=<?php echo $idexam; ?>" class="btn btn-outline-primary">Start</a>
<script>
    window.history.forward();
</script>
