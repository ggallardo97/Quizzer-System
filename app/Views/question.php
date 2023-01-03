<div class="alert alert-dark">
  Question <?php echo $idq;?> of <?php echo $totalq; ?>
</div>
<p class="font-weight-bolder"><?php echo $questions['question']; ?></p>

<?php 
        $randomchoices = array();
        $keys          = array_keys($choices);
        shuffle($keys);

        foreach($keys as $key){
          $randomchoices[$key] = $choices[$key];
        }
    foreach($randomchoices as $c){ ?>
  <form method="POST" action="process">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="question_id" value="<?php echo $c['idchoice'];?>" id="choice<?php echo $c['idchoice'];?>" required>
          <label class="form-check-label" for="choice<?php echo $c['idchoice'];?>"> <?php echo $c['choice']; ?>
          </label>
        </div>
    <?php } ?>
    <input type="hidden" name="next_question" value="<?php echo $idq;?>">
    <input type="hidden" name="idexam" value="<?php echo $idexam;?>">
    <input type="submit" value="Next" class="btn btn-primary mt-3">
  </form>
  <script>
    window.history.forward();
  </script>
