<?php

namespace Zebba\TwigExtensionBundle\Bridge\Twig\Filter;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ListFilter extends \Twig_Extension
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
	 * @see Twig_Extension::getFilters()
	 */
	public function getFilters()
	{
		return array(
			new \Twig_SimpleFilter('ulist', array($this, 'ulistFilter'), array('is_safe' => array('html'))),
			new \Twig_SimpleFilter('olist', array($this, 'olistFilter'), array('is_safe' => array('html'))),
		);
	}
	
	/**
	 * 
	 * @param \IteratorAggregate $list
	 * @param array $attributes
	 */
	public function ulistFilter(\IteratorAggregate $list, array $attributes = array())
	{
		return $this->container->get('templating')->render('ZebbaTwigExtensionBundle:List:ulist.html.twig', array(
			'list' => $list
		));
	}
	
	/**
	 * 
	 * @param \IteratorAggregate $list
	 * @param array $attributes
	 */
	public function olistFilter(\IteratorAggregate $list, array $attributes = array())
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
		return 'zebba_list_filter';
	}
}