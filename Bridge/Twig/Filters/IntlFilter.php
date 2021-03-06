<?php

namespace Zebba\Bundle\TwigExtensionBundle\Bridge\Twig\Filters;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Intl\Intl;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class IntlFilter extends \Twig_Extension
{
	/** @var ContainerInterface */
	private $container;

	/**
	 * Constructor
	 *
	 * @param ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	/* (non-PHPdoc)
	 * @see Twig_Extension::getFilters()
	 */
	public function getFilters()
	{
		return array(
			new \Twig_SimpleFilter('country', array($this, 'countryFilter')),
		);

	}

	/**
	 *
	 * @param string $code
	 * @return string
	 */
	public function countryFilter($code)
	{
		/* @var $stack RequestStack */
		$stack = $this->container->get('request_stack');
		/* @var $request Request */
		$request = $stack->getCurrentRequest();

		$country = Intl::getRegionBundle()->getCountryName(strtoupper($code) , $request->getLocale());

		return (! is_null($country)) ? $country : $code;
	}

	/**
	 * (non-PHPdoc)
	 * @see Twig_ExtensionInterface::getName()
	 */
	public function getName()
	{
		return 'zebba_intl_filter';
	}
}
