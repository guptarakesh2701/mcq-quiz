<div class="message">
    <div class="row">
        <div class="col-md-12">
            <p>Choose the correct answer</p>
        </div>
    </div>
</div>


<main>
    <div class="container exam">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">


                <?php echo form_open('home/result'); ?>

                <?php
                /*
                $i = 0;
                foreach ($mcq as $item):
                    $i += 1;
                    if ($i === 4) {
                        break;
                    }
                    ?>
                    <?php echo form_hidden('question' . $i, $item['question']); ?>
                    <h5><?php echo $i . ') ' . $item['question']; ?></h5>
                    <div class="radio">
                        <label>
                            <input name="answer<?php echo $i; ?>" type="radio"
                                   value="<?php echo $item['one']; ?>">
                            <?php echo $item['one']; ?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input name="answer<?php echo $i; ?>" type="radio"
                                   value="<?php echo $item['two']; ?>">
                            <?php echo $item['two']; ?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input name="answer<?php echo $i; ?>" type="radio"
                                   value="<?php echo $item['three']; ?>">
                            <?php echo $item['three']; ?>
                        </label>
                    </div>

                    <br>
                <?php endforeach;  */ ?>

                <?php
                		$i = 0;
                		foreach ($results as $key) {
                			$i += 1;
							$correct_answer = $key->correct_answer;
							$incorrect_answers = $key->incorrect_answers;
							array_push($incorrect_answers, $correct_answer);
							shuffle($incorrect_answers);
				?>		
						<h5><?php echo $i . ') ' . $key->question; ?></h5>
						<input type="hidden" name="canswer<?php echo $i; ?>" value="<?php echo $correct_answer ?>">
				<?php
							foreach ($incorrect_answers as $ia) { ?>
							  	<div class="radio">
			                        <label>
			                            <input name="answer<?php echo $i; ?>" type="radio" value="<?php echo $ia; ?>">
			                            <?php echo $ia; ?>
			                        </label>
			                    </div>
				<?php 		}  	?>
						<br>
				<?php	}	?>

                <br>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</main>


