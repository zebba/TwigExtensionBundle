<?php

namespace Zebba\Bundle\TwigExtensionBundle\Bridge\Twig\Functions;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Intl\Intl;
use Symfony\Component\HttpFoundation\Request;

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
			new \Twig_SimpleFunction('country', array($this, 'countryFilter')),
		);

	}

	/**
	 *
	 * @param string $code
	 * @param Request $request
	 * @return Ambigous <unknown, string, NULL>
	 */
	public function countryFilter($code, Request $request)
	{
		$country = Intl::getRegionBundle()->getCountryName($code, $request->getLocale());

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
