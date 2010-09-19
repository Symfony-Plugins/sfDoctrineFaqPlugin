<?php

/**
 * PluginsfFaqCategory form.
 *
 * @package    sfDoctrineFaqPlugin
 * @subpackage form
 * @author     Susan Lau <susan.lau@gmx.de>
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginsfFaqCategoryForm extends BasesfFaqCategoryForm
{
  public function setup()
  {
    parent::setup();

    unset(
      $this['created_at'],
      $this['updated_at']
    );
  }
}
