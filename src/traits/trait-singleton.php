<?php

/**
 * Singleton trait which implements Singleton pattern in any class in which this trait is used.
 *
 * Using the singleton pattern in WordPress is an easy way to protect against
 * mistakes caused by creating multiple objects or multiple initialization
 * of classes which need to be initialized only once.
 *
 * With complex plugins, there are many cases where multiple copies of
 * the plugin would load, and action hooks would load (and trigger) multiple
 * times.
 */

namespace Reaction\Base\Traits;

trait Singleton
{

	/**
	 * Protected class constructor to prevent direct object creation
	 */
	protected function __construct()
	{
	}

	/**
	 * Prevent object cloning
	 */
	final protected function __clone()
	{
	}

	/**
	 * This method returns new or existing Singleton instance
	 * of the class for which it is called. This method is set
	 * as final intentionally, it is not meant to be overridden.
	 *
	 * @return object Singleton instance of the class.
	 */
	final public static function get_instance(): Self
	{

		/**
		 * Collection of instance.
		 *
		 * @var array
		 */
		static $instance = array();

		/**
		 * If this trait is implemented in a class which has multiple
		 * sub-classes then static::$_instance will be overwritten with the most recent
		 * sub-class instance. Thanks to late static binding
		 * we use get_called_class() to grab the called class name, and store
		 * a key=>value pair for each `classname => instance` in self::$_instance
		 * for each sub-class.
		 */
		$called_class = get_called_class();

		if (!isset($instance[$called_class])) {
			$instance[$called_class] = new $called_class();
		}

		return $instance[$called_class];
	}
}
