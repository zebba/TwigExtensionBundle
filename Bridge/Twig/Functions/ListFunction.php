<?php

namespace Zebba\Bundle\TwigExtensionBundle\Bridge\Twig\Functions;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ListFunction extends \Twig_Extension
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

	/**
	 * (non-PHPdoc)
	 * @see Twig_Extension::getFunctions()
	 */
	public function getFunctions()
	{
		return array(
			new \Twig_SimpleFunction('ulist', array($this, 'ulistFunction'), array('is_safe' => array('html'))),
			new \Twig_SimpleFunction('olist', array($this, 'olistFunction'), array('is_safe' => array('html'))),
		);
	}

	/**
	 *
	 * @param mixed $list
	 * @param array $attributes
	 */
	public function ulistFunction($list, array $attributes = array())
	{
		return $this->container->get('templating')->render('ZebbaTwigExtensionBundle:List:ulist.html.twig', array(
			'list' => $list
		));
	}

	/**
	 *
	 * @param mixed $list
	 * @param array $attributes
	 */
	public function olistFunction($list, array $attributes = array())
	{
		return $this->container->get('templating')->render('ZebbaTwigExtensionBundle:List:olist.html.twig', array(
			'list' => $list
		));
	}

	/**
	 * (non-PHPdoc)
	 * @see Twig_ExtensionInterface::getName()
	 */
	public function getName()
	{
		return 'zebba_list_function';
	}
}
