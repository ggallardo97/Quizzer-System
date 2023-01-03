<h2><?php echo $title;?></h2>
<p>Welcome <?php echo $_SESSION['user']['username']; ?>!</p>
<p>You have already finished this test!</p>

<ul>
  <li><strong>Type:</strong> Multiple choice</li>
  <li><strong>Your score: <?php echo $score; ?>/<?php echo $totalq; ?></strong></li>
  <li><strong>Percentage: <?php echo (($score/$totalq)*100); ?>%</strong></li>
</ul>

<a href="student" class="btn btn-outline-primary">Menu</a>