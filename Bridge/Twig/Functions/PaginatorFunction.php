<?php

namespace Zebba\Bundle\TwigExtensionBundle\Bridge\Twig\Functions;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PaginatorFunction extends \Twig_Extension
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
			new \Twig_SimpleFunction('paginator_pages', array($this, 'pagesFunction')),
		);
	}

	/**
	 *
	 * @param Paginator $paginator
	 * @param integer $limit
	 * @param array $attributes
	 */
	public function pagesFunction(Paginator $paginator, $limit)
	{
		return ($paginator->getCount() % limit) ? floor(paginator.count / limit) + 1 : floor(paginator.count / limit) + 1;
	}

	/**
	 * (non-PHPdoc)
	 * @see Twig_ExtensionInterface::getName()
	 */
	public function getName()
	{
		return 'zebba_paginator_function';
	}
}
