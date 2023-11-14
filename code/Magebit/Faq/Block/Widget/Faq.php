<?php

namespace Magebit\Faq\Block\Widget;

use Magento\Widget\Block\BlockInterface;

/** Block class for faq-list-widget.phtml template */
class Faq extends \Magebit\Faq\Block\Faq implements BlockInterface
{
    /** @var string template name where block is used */
    protected $_template = 'faq-list-widget.phtml';
}
