<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Component\Core\Model;

use Sylius\Component\Core\Pricing\Calculators;
use Sylius\Component\Product\Model\ProductVariant as BaseVariant;
use Sylius\Component\Taxation\Model\TaxCategoryInterface;
use Webmozart\Assert\Assert;

/**
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class ProductVariant extends BaseVariant implements ProductVariantInterface
{
    /**
     * @var string
     */
    protected $pricingCalculator = Calculators::STANDARD;

    /**
     * @var array
     */
    protected $pricingConfiguration = [];

    /**
     * @var int
     */
    protected $onHold = 0;

    /**
     * @var int
     */
    protected $onHand = 0;

    /**
     * @var bool
     */
    protected $tracked = false;

    /**
     * @var float
     */
    protected $weight;

    /**
     * @var float
     */
    protected $width;

    /**
     * @var float
     */
    protected $height;

    /**
     * @var float
     */
    protected $depth;

    /**
     * @var TaxCategoryInterface
     */
    protected $taxCategory;

    /**
     * @return string
     */
    public function __toString()
    {
        $string = $this->getProduct()->getName();

        if (!$this->getOptionValues()->isEmpty()) {
            $string .= '(';

            foreach ($this->getOptionValues() as $option) {
                $string .= $option->getOption()->getName().': '.$option->getValue().', ';
            }

            $string = substr($string, 0, -2).')';
        }

        return $string;
    }

    /**
     * {@inheritdoc}
     */
    public function getPricingCalculator()
    {
        return $this->pricingCalculator;
    }

    /**
     * {@inheritdoc}
     */
    public function setPricingCalculator($calculator)
    {
        $this->pricingCalculator = $calculator;
    }

    /**
     * {@inheritdoc}
     */
    public function getPricingConfiguration()
    {
        return $this->pricingConfiguration;
    }

    /**
     * {@inheritdoc}
     */
    public function setPricingConfiguration(array $configuration)
    {
        $this->pricingConfiguration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function isInStock()
    {
        return 0 < $this->onHand;
    }

    /**
     * {@inheritdoc}
     */
    public function getOnHold()
    {
        return $this->onHold;
    }

    /**
     * {@inheritdoc}
     */
    public function setOnHold($onHold)
    {
        $this->onHold = $onHold;
    }

    /**
     * {@inheritdoc}
     */
    public function getOnHand()
    {
        return $this->onHand;
    }

    /**
     * {@inheritdoc}
     */
    public function setOnHand($onHand)
    {
        $this->onHand = (0 > $onHand) ? 0 : $onHand;
    }

    /**
     * {@inheritdoc}
     */
    public function isTracked()
    {
        return $this->tracked;
    }

    /**
     * {@inheritdoc}
     */
    public function setTracked($tracked)
    {
        Assert::boolean($tracked);

        $this->tracked = $tracked;
    }

    /**
     * {@inheritdoc}
     */
    public function getInventoryName()
    {
        return $this->getProduct()->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingCategory()
    {
        return $this->getProduct()->getShippingCategory();
    }

    /**
     * {@inheritdoc}
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * {@inheritdoc}
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * {@inheritdoc}
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * {@inheritdoc}
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * {@inheritdoc}
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * {@inheritdoc}
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * {@inheritdoc}
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingWeight()
    {
        return $this->getWeight();
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingWidth()
    {
        return $this->getWidth();
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingHeight()
    {
        return $this->getHeight();
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingDepth()
    {
        return $this->getDepth();
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingVolume()
    {
        return $this->depth * $this->height * $this->width;
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxCategory()
    {
        return $this->taxCategory;
    }

    /**
     * {@inheritdoc}
     */
    public function setTaxCategory(TaxCategoryInterface $category = null)
    {
        $this->taxCategory = $category;
    }
}
