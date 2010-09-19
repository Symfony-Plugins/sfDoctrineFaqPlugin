<?php

/**
 * Faq module
 *
 * just simple listing
 *
 * @package sfDoctrineFaqPlugin
 * @author Jonathan Démoutiez <jonathan@demoutiez.net>
 * @author Susan Lau <susan.lau@gmx.de> 
 */
class BasesfFaqActions extends sfActions
{
  public function preExecute()
  {
    $this->initList();
  }

  public function executeIndex() 
  {
    if ($this->hasRequestParameter('faq_slug'))
    {
      $this->selectedFaq = Doctrine::getTable('sfFaqFaq')->findOneBySlug($this->getRequestParameter('faq_slug'));
    }
    
    if (!isset($this->selectedFaq) && !$this->selectedFaq) 
    {
      if ($this->hasRequestParameter('category_slug'))
      {
	$this->selectedCategory = Doctrine::getTable('sfFaqCategory')->findOneBySlug($this->getRequestParameter('category_slug'));
	$this->defaultQuestionSelection();
      }
      else
      {
	$this->defaultSelection();
      }
    }
    else 
    {
      $this->selectedCategory = $this->selectedFaq->getCategory();
    }
  }

	
  /**
   * Private methods
   *
   * @author Jonathan Démoutiez
   */
  private function initList()
  {
    $this->categoriesList = Doctrine::getTable('sfFaqCategory')->retrieveAll();
  }
	
  private function defaultSelection()
  {
    $this->defaultCategorySelection();
    $this->defaultQuestionSelection();
  }
	
  private function defaultCategorySelection()
  {
    $this->selectedCategory = NULL;
    $this->selectedFaq      = NULL;

    if (sfConfig::get('app_sf_doctrine_faq_plugin_first_category_by_default', false) && !isset($this->selectedCategory) && !$this->selectedCategory)
    {
      $this->selectedCategory = Doctrine::getTable('sfFaqCategory')->retrieveFirst();
      $this->defaultQuestionSelection();
    }
  }
	
  private function defaultQuestionSelection()
  {
    $this->selectedFaq = NULL;

    if (sfConfig::get('app_sf_doctrine_faq_plugin_first_question_by_default', false) && $this->selectedCategory)
    {
      $selectedFaqs = $this->selectedCategory->getsfFaqFaqs();
      if (is_array($selectedFaqs)) 
      {
	$this->selectedFaq = array_shift($selectedFaqs);
      }
    }
  }
}
