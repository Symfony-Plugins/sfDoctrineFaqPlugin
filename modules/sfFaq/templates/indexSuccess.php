
      <div id="tabs_sf_faq_categories">
        <?php foreach ($categoriesList as $key => $category): ?>
          <?php $class = ($selectedCategory && $selectedCategory->getId() == $category->getId()) ? 'active' : 'inactive'; ?>
          <a href="<?php echo url_for('@sf_faq_category?category_slug=' . $category->getSlug()); ?>" class="<?php echo $class; ?>"><?php echo $category->getName(); ?></a> |
        <?php endforeach ?>
      </div>

      <div class="question_separator"><hr /></div>
      

<?php if ($selectedCategory): ?>
  
  <?php foreach ($selectedCategory->getsfFaqFaqs() as $key => $faq): ?>
      <?php if ($selectedFaq && $selectedFaq->getId() == $faq->getId()): ?>
        <div id="answer">
          <p class="question-on">
           - <?php echo $faq->getQuestion() ?>
          </p>
          <p class="answer">
            <?php echo $faq->getAnswer() ?>
          </p>
        </div>
      <?php else: ?>
        <div class="question">
          + <a href="<?php echo url_for('@sf_faq_question?category_slug=' . $faq->getCategory()->getSlug().'&faq_slug=' . $faq->getSlug()); ?>"><?php echo $faq->getQuestion(); ?></a>
        </div>
      <?php endif ?>

      <div class="question_separator"><hr /></div>

  <?php endforeach ?>

<?php endif ?>

